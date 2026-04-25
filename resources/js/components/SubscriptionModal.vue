<template>
  <div v-if="isVisible" class="modal-overlay" @click.self="closeModal">
    <div class="modal-container">
      <button @click="closeModal" class="close-btn" aria-label="Close">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>

      <div class="modal-content">
        <div class="modal-text">
          <h2>Subscribe to Our Newsletter</h2>
          <p>Get the latest updates on CCTV systems, security solutions, and special offers.</p>
        </div>

        <form @submit.prevent="handleSubmit" class="subscribe-form">
          <input 
            type="email" 
            v-model="email" 
            placeholder="Enter your email"
            required
            class="form-input"
          >
          <button type="submit" class="submit-btn">
            Subscribe
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';

export default {
  name: 'SubscriptionModal',
  data() {
    return {
      isVisible: false,
      email: ''
    }
  },
  mounted() {
    const hasSeenModal = localStorage.getItem('newsletter_seen');
    if (!hasSeenModal) {
      setTimeout(() => {
        this.isVisible = true;
      }, 15000);
    }
  },
  methods: {
    closeModal() {
      this.isVisible = false;
      localStorage.setItem('newsletter_seen', 'true');
    },
    async handleSubmit() {
      try {
        await axios.post('/api/subscribe', {
          email: this.email
        });
        toast.success('Thanks for subscribing!', { position: 'top-right' });
        this.closeModal();
      } catch (error) {
        toast.error('Something went wrong. Please try again.', { position: 'top-right' });
      }
    }
  }
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  padding: 1rem;
}

.modal-container {
  background: #171616;
  border-radius: 8px;
  width: 100%;
  max-width: 420px;
  position: relative;
  overflow: hidden;
}

.close-btn {
  position: absolute;
  top: 12px;
  right: 12px;
  background: transparent;
  border: none;
  color: #999;
  cursor: pointer;
  padding: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: color 0.2s;
  z-index: 10;
}

.close-btn:hover {
  color: #fff;
}

.modal-content {
  padding: 2rem;
  text-align: center;
}

.modal-text {
  margin-bottom: 1.5rem;
}

.modal-text h2 {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 0.5rem;
}

.modal-text p {
  color: #999;
  font-size: 0.875rem;
  margin: 0;
  line-height: 1.5;
}

.subscribe-form {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.form-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #333;
  border-radius: 4px;
  background: #222;
  color: #fff;
  font-size: 0.9375rem;
}

.form-input::placeholder {
  color: #666;
}

.form-input:focus {
  outline: none;
  border-color: #95002a;
}

.submit-btn {
  padding: 0.75rem 1rem;
  background: #95002a;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 0.9375rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.submit-btn:hover {
  background: #7a0022;
}

@media (max-width: 480px) {
  .modal-content {
    padding: 1.5rem;
  }
  
  .modal-text h2 {
    font-size: 1.125rem;
  }
}
</style>