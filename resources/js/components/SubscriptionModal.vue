<template>
  <div v-if="isVisible" class="modal-overlay">
    <div class="modal-container">
      <!-- Close button -->
      <button @click="closeModal" class="close-btn" aria-label="Close modal">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M18 6L6 18M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>

      <div class="modal-content">
        <!-- Left side - Image -->
        <div class="modal-image">
          <img :src="'/front-assets/img/brand-logo/logo.png'" alt="Special Offer" class="brand-logo">
          <div class="overlay-text">
            <span class="discount-badge">10% OFF</span>
            <h3>First Order</h3>
          </div>
        </div>

        <!-- Right side - Form -->
        <div class="modal-form">
          <div class="form-header">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to get special offers, free giveaways, and amazing deals.</p>
          </div>

          <form @submit.prevent="handleSubmit" class="subscribe-form">
            <div v-if="errorMessage" class="error-alert" role="alert">
              {{ errorMessage }}
            </div>

            <div class="form-group">
              <input 
                type="email" 
                v-model="email" 
                placeholder="Your email address"
                required
                class="form-input"
              >
            </div>

            <div class="form-group">
              <input 
                type="tel" 
                v-model="phone" 
                placeholder="Your phone number (optional)"
                class="form-input"
              >
            </div>

            <button type="submit" class="submit-btn">
              Get My 10% Off
            </button>

            <button type="button" @click="closeModal" class="skip-btn">
              No thanks, I'll pay full price
            </button>
          </form>

          <p class="privacy-text">
            By subscribing, you agree to our <a href="/privacy">Privacy Policy</a> and consent to receive updates from our company.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  name: 'SubscriptionModal',
  data() {
    return {
      isVisible: false,
      email: '',
      phone: '',
      errorMessage: ''
    }
  },
  mounted() {
    setTimeout(() => {
      this.isVisible = true;
    }, 30000);
  },
  methods: {
    closeModal() {
      this.isVisible = false;
      this.errorMessage = '';
    },
    async handleSubmit() {
      try {
        this.errorMessage = ''; // Clear any existing error
        const response = await axios.post('/api/subscribe', {
          email: this.email,
          phone: this.phone
        });

        if (response.data.success) {
          toast.success('Subscription made successfully!', {
            position: toast.POSITION.TOP_LEFT
          });
          this.closeModal();
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          // Handle validation errors
          if (error.response.data.errors && error.response.data.errors.email) {
            this.errorMessage = 'You are already subscribed!';
          } else {
            this.errorMessage = 'Please enter a valid email address.';
          }
        } else {
          toast.error('Something went wrong. Please try again.', {
            position: toast.POSITION.TOP_LEFT
          });
        }
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
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  padding: 1rem;
}

.modal-container {
  background: white;
  border-radius: 16px;
  width: 90%;
  max-width: 600px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  display: flex;
  flex-direction: column;
}

.close-btn {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: transparent;
  border: none;
  color: #4B5563;
  cursor: pointer;
  z-index: 10;
  padding: 0.5rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.close-btn:hover {
  background: rgba(0, 0, 0, 0.05);
  color: #1F2937;
}

.modal-content {
  display: flex;
  height: auto;
}

.modal-image {
  flex: 0.8;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 1.5rem;
  position: relative;
  color: white;
  overflow: hidden;
  min-height: 180px;
}

.modal-image::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('/front-assets/img/pattern.png') repeat;
  opacity: 0.1;
}

.brand-logo {
  width: 80px;
  height: auto;
  margin-bottom: 0.75rem;
}

.overlay-text {
  text-align: center;
  position: relative;
  z-index: 1;
}

.overlay-text h3 {
  font-size: 1.5rem;
  margin-top: 1rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.discount-badge {
  background: white;
  color: #0a609d;
  padding: 0.5rem 1rem;
  border-radius: 999px;
  font-weight: bold;
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
  display: inline-block;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transform: rotate(-3deg);
}

.modal-form {
  flex: 1.2;
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
}

.form-header {
  text-align: center;
  margin-bottom: 1rem;
}

.form-header h2 {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.25rem;
}

.form-header p {
  font-size: 0.875rem;
  line-height: 1.3;
  color: #6B7280;
}

.subscribe-form {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.form-group {
  position: relative;
}

.form-input {
  width: 100%;
  padding: 0.625rem 0.875rem;
  border: 1px solid #E5E7EB;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  background: #F9FAFB;
}

.form-input:focus {
  outline: none;
  border-color: #0a609d;
  background: white;
  box-shadow: 0 0 0 3px rgba(255, 75, 31, 0.1);
}

.error-alert {
  background: #FEE2E2;
  color: #0a609d;
  padding: 1rem;
  border-radius: 0.75rem;
  font-size: 0.875rem;
  margin-bottom: 1rem;
  border: 1px solid #FCA5A5;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.submit-btn {
  background: #0a609d;
  color: white;
  padding: 0.625rem 1rem;
  border: none;
  border-radius: 0.5rem;
  font-weight: 600;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.2s;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.submit-btn:hover {
  background: #e63900;
  transform: translateY(-1px);
}

.skip-btn {
  background: transparent;
  border: none;
  color: #6B7280;
  padding: 0.5rem;
  font-size: 0.75rem;
  cursor: pointer;
  margin-top: 0.25rem;
}

.privacy-text {
  font-size: 0.675rem;
  color: #6B7280;
  margin-top: 0.75rem;
  text-align: center;
}

.privacy-text a {
  color: #0a609d;
  text-decoration: none;
}

.privacy-text a:hover {
  text-decoration: underline;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
  .modal-container {
    width: 85%;
    margin: 1rem auto;
  }

  .modal-content {
    flex-direction: column;
  }

  .modal-image {
    min-height: 140px;
    padding: 1rem;
  }

  .brand-logo {
    width: 60px;
  }

  .modal-form {
    padding: 1rem;
  }
}

@media (max-width: 480px) {
  .modal-container {
    width: 90%;
    margin: 0.5rem auto;
  }

  .modal-image {
    min-height: 120px;
    padding: 0.75rem;
  }

  .form-header h2 {
    font-size: 1.125rem;
  }

  .form-header p {
    font-size: 0.75rem;
  }
}
</style> 