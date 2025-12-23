<template>
  <div class="contact-section">
    <div class="container">
      <div class="row">
        <!-- Contact Information -->
        <div class="col-md-5">
          <div class="contact-info">
            <h3>Our Location</h3>
            <div class="info-item">
              <strong>Address:</strong>
              <address>
                Muthaiga Square<br>
                Nairobi, Kenya
              </address>
            </div>

            <div class="info-item">
              <strong>Email:</strong>
              <p><a href="mailto:support@wabegadgets.com">info@wabegadgets.co.ke</a></p>
            </div>

            <div class="info-item">
              <strong>Phone:</strong>
              <p><a href="tel:+254710909198">+254 710 909 198</a></p>
            </div>

            <div class="info-item">
              <strong>Opening Times:</strong>
              <p>7.30 AM to 6:00 PM (Monday to Saturday)</p>
            </div>

            

            <div class="about-section mt-4">
              <strong>About Us</strong>
              <p>
                WabeGadgets is your premier destination for top-tier security solutions. We specialize in CCTV systems, cloud storage solutions, professional installations, and cutting-edge smart home technology. Our commitment to security excellence makes us your trusted partner in protecting what matters most.
              </p>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-7">
          <div class="contact-form">
            <h3>Contact Form</h3>
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="name">Your Name <span class="required">*</span></label>
                <input 
                  type="text" 
                  id="name"
                  v-model="formData.name"
                  class="form-control" 
                  required
                >
              </div>

              <div class="form-group">
                <label for="phone">Phone Number <span class="required">*</span></label>
                <input 
                  type="tel" 
                  id="phone"
                  v-model="formData.phone"
                  class="form-control" 
                  required
                >
              </div>

              <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input 
                  type="email" 
                  id="email"
                  v-model="formData.email"
                  class="form-control" 
                  required
                >
              </div>

              <div class="form-group">
                <label for="message">Message <span class="required">*</span></label>
                <textarea 
                  id="message"
                  v-model="formData.message"
                  class="form-control" 
                  rows="5"
                  required
                ></textarea>
              </div>

              <button type="submit" class="btn theme-btn-1 btn-effect-1">
                {{ isSubmitting ? 'Sending...' : 'Send Message' }}
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Google Map -->
      <div class="row mt-5">
        <div class="col-12">
          <div class="google-map">
           <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d31910.443638396573!2d36.896768!3d-1.2910591999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x182f134f6924b939%3A0x9497581070a52098!2sParklands%203rd%20Avenue!3m2!1d-1.2571326999999999!2d36.811707!5e0!3m2!1sen!2ske!4v1766526632541!5m2!1sen!2ske" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';

export default {
  name: 'ContactForm',
  data() {
    return {
      formData: {
        name: '',
        email: '',
        phone: '',
        message: ''
      },
      isSubmitting: false
    }
  },
  methods: {
    async handleSubmit() {
      try {
        this.isSubmitting = true;
        const response = await axios.post('/api/contact', this.formData);
        
        if (response.data.success) {
          toast.success('Message sent successfully!');
          this.resetForm();
        }
      } catch (error) {
        toast.error('Failed to send message. Please try again.');
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.formData = {
        name: '',
        email: '',
        phone: '',
        message: ''
      };
    }
  }
}
</script>

<style scoped>
.contact-section {
  padding: 80px 0;
}

.contact-info {
  background: #f8f9fa;
  padding: 30px;
  border-radius: 8px;
}

.info-item {
  margin-bottom: 20px;
}

.info-item strong {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

.info-item p {
  margin: 0;
  color: #666;
}

.info-item a {
  color: #666;
  text-decoration: none;
}

.map-btn {
  margin: 20px 0;
}

.contact-form {
  background: #fff;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

.required {
  color: #dc3545;
}

.google-map {
  border-radius: 8px;
  overflow: hidden;
}

.about-section {
  padding-top: 20px;
  border-top: 1px solid #ddd;
}

.about-section strong {
  display: block;
  margin-bottom: 10px;
}
</style> 