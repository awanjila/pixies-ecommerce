<template>
  <div class="contact-page">
    <div class="page-header">
      <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with Pixies Technologies</p>
      </div>
    </div>
    
    <div class="container">
      <div class="contact-content">
        <div class="contact-info">
          <div class="info-card">
            <h2>Phone</h2>
            <p><a href="tel:+254798742543">+254 798 742 543</a></p>
          </div>
          
          <div class="info-card">
            <h2>Email</h2>
            <p><a href="mailto:info@pixies.co.ke">info@pixies.co.ke</a></p>
          </div>
          
          <div class="info-card">
            <h2>Location</h2>
            <p>Nairobi, Kenya</p>
          </div>
        </div>
        
        <div class="contact-form">
          <h2>Send a Message</h2>
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label>Name</label>
              <input type="text" v-model="form.name" required>
            </div>
            
            <div class="form-group">
              <label>Email</label>
              <input type="email" v-model="form.email" required>
            </div>
            
            <div class="form-group">
              <label>Message</label>
              <textarea v-model="form.message" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn" :disabled="loading">
              {{ loading ? 'Sending...' : 'Send Message' }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';

const loading = ref(false);
const form = reactive({
  name: '',
  email: '',
  message: ''
});

const submitForm = async () => {
  loading.value = true;
  try {
    await axios.post('/sendmail', form);
    alert('Message sent successfully!');
    form.name = '';
    form.email = '';
    form.message = '';
  } catch (error) {
    alert('Failed to send message. Please try again.');
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.contact-page {
  min-height: 100vh;
  background: #f9fafb;
}

.page-header {
  background: #171616;
  padding: 3rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

h1 {
  color: #ffffff;
  margin: 0 0 0.5rem;
  font-size: 2rem;
  font-weight: 700;
}

.page-header p {
  color: #999;
  margin: 0;
}

.contact-content {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 2rem;
}

.contact-info {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.info-card {
  background: #ffffff;
  padding: 1.5rem;
  border-radius: 8px;
  border: 1px solid #e5e5e5;
}

.info-card h2 {
  margin: 0 0 0.5rem;
  font-size: 1rem;
  font-weight: 600;
  color: #171616;
}

.info-card p {
  margin: 0;
  color: #666;
}

.info-card a {
  color: #95002a;
  text-decoration: none;
}

.info-card a:hover {
  text-decoration: underline;
}

.contact-form {
  background: #ffffff;
  padding: 1.5rem;
  border-radius: 8px;
  border: 1px solid #e5e5e5;
}

.contact-form h2 {
  margin: 0 0 1.5rem;
  font-size: 1.25rem;
  font-weight: 600;
  color: #171616;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #333;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #e5e5e5;
  border-radius: 4px;
  font-size: 1rem;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #95002a;
}

.submit-btn {
  padding: 0.75rem 1.5rem;
  background: #95002a;
  color: #ffffff;
  border: none;
  border-radius: 4px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.submit-btn:hover:not(:disabled) {
  background: #7a0022;
}

.submit-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

@media (max-width: 768px) {
  .contact-content {
    grid-template-columns: 1fr;
  }
}
</style>