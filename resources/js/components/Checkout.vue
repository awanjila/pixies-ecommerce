<template>
  <div class="checkout-page">
    <div class="checkout-header">
      <h1 class="page-title">Checkout</h1>
    </div>

    <div class="container">
      <div v-if="cart.length === 0" class="empty-cart">
        <p>Your cart is empty</p>
        <a href="/" class="continue-shopping-btn">Continue Shopping</a>
      </div>

      <div v-else class="checkout-content">
        <div class="checkout-form-section">
          <div class="form-card">
            <h2>Customer Information</h2>
            
            <div class="form-group">
              <label for="name">Name</label>
              <input 
                type="text" 
                id="name" 
                v-model="formData.customer_name"
                placeholder="Enter your full name"
              />
              <p v-if="errors.name" class="error-text">{{ errors.name }}</p>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input 
                type="email" 
                id="email" 
                v-model="formData.customer_email"
                placeholder="Enter your email address"
              />
              <p v-if="errors.email" class="error-text">{{ errors.email }}</p>
            </div>

            <div class="form-group">
              <label for="phone">Phone</label>
              <input 
                type="tel" 
                id="phone" 
                v-model="formData.customer_phone"
                placeholder="Enter your phone number"
              />
              <p v-if="errors.phone" class="error-text">{{ errors.phone }}</p>
            </div>

            <div class="form-group">
              <label for="address">Delivery Address</label>
              <input 
                type="text" 
                id="address" 
                v-model="formData.customer_address"
                placeholder="Enter your delivery address"
              />
              <p v-if="errors.address" class="error-text">{{ errors.address }}</p>
            </div>
          </div>

          <div class="form-card">
            <h2>Special Instructions</h2>
            <div class="form-group">
              <textarea 
                id="instructions" 
                v-model="specialInstructions" 
                placeholder="Add any delivery instructions or notes"
              ></textarea>
            </div>
          </div>

          <div class="form-card">
            <h2>Payment Method</h2>
            <p class="payment-info">M-Pesa</p>
          </div>

          <button 
            @click="submitOrder" 
            :disabled="processing"
            class="submit-btn"
          >
            {{ processing ? 'Processing...' : 'Complete Order' }}
          </button>
        </div>

        <div class="order-summary-section">
          <div class="summary-card">
            <h2>Order Summary</h2>
            
            <div class="order-items">
              <div v-for="item in cart" :key="item.id" class="order-item">
                <img :src="getImageUrl(item.product_image)" :alt="item.product_name" class="item-image">
                <div class="item-details">
                  <h4>{{ item.product_name }}</h4>
                  <p>Ksh {{ formatPrice(item.selling_price) }} x {{ item.quantity }}</p>
                </div>
              </div>
            </div>

            <div class="summary-totals">
              <div class="summary-row">
                <span>Subtotal</span>
                <span>Ksh {{ formatPrice(cartTotal) }}</span>
              </div>
              <div class="summary-row total">
                <span>Total</span>
                <span>Ksh {{ formatPrice(cartTotal) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <OrderSuccessModal v-if="showSuccessModal" @close="showSuccessModal = false" />
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import { toast } from 'vue3-toastify';
import { storeToRefs } from 'pinia';
import { useCartStore } from '../store/cart';
import OrderSuccessModal from './OrderSuccessModal.vue';

const cartStore = useCartStore();
const { cart, cartTotal } = storeToRefs(cartStore);

const processing = ref(false);
const showSuccessModal = ref(false);
const specialInstructions = ref('');
const errors = ref({});

const formData = reactive({
  customer_name: '',
  customer_email: '',
  customer_phone: '',
  customer_address: '',
});

const formatPrice = (price) => {
  return new Intl.NumberFormat('en-KE').format(price);
};

const getImageUrl = (path) => {
  if (!path) return '/images/placeholder.jpg';
  return path.startsWith('/') ? path : '/' + path;
};

const validateForm = () => {
  errors.value = {};
  let isValid = true;

  if (!formData.customer_name.trim()) {
    errors.value.name = 'Name is required';
    isValid = false;
  }

  if (!formData.customer_email.trim()) {
    errors.value.email = 'Email is required';
    isValid = false;
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.customer_email)) {
    errors.value.email = 'Invalid email address';
    isValid = false;
  }

  if (!formData.customer_phone.trim()) {
    errors.value.phone = 'Phone number is required';
    isValid = false;
  }

  if (!formData.customer_address.trim()) {
    errors.value.address = 'Delivery address is required';
    isValid = false;
  }

  return isValid;
};

const submitOrder = async () => {
  if (!validateForm()) return;

  processing.value = true;

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const orderData = {
      ...formData,
      _token: csrfToken,
      special_instructions: specialInstructions.value,
      cart_contents: cart.value.map(item => ({
        id: item.id,
        name: item.product_name,
        price: item.selling_price,
        quantity: item.quantity
      })),
      total_products: cart.value.reduce((sum, item) => sum + item.quantity, 0),
      total_amount: cartTotal.value,
      sub_total: cartTotal.value,
      payment_status: 'mobile',
    };

    const response = await axios.post('/final-invoice', orderData);

    if (response.data.success) {
      localStorage.setItem('cart', JSON.stringify([]));
      localStorage.removeItem('couponApplied');
      localStorage.removeItem('couponCode');
      
      toast.success('Order placed successfully!', {
        duration: 5000,
      });
      
      showSuccessModal.value = true;
      
      setTimeout(() => {
        window.location.href = '/';
      }, 3000);
    }
  } catch (error) {
    toast.error('There was a problem with your order. Please try again.');
  } finally {
    processing.value = false;
  }
};
</script>

<style scoped>
.checkout-page {
  min-height: 100vh;
}

.checkout-header {
  background: #171616;
  padding: 2.5rem 0;
}

.page-title {
  color: #ffffff;
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.empty-cart {
  text-align: center;
  padding: 4rem 0;
}

.empty-cart p {
  font-size: 1.25rem;
  color: #666;
  margin-bottom: 1.5rem;
}

.continue-shopping-btn {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background: #171616;
  color: #ffffff;
  text-decoration: none;
  border-radius: 4px;
  font-weight: 500;
  transition: all 0.2s ease;
}

.continue-shopping-btn:hover {
  background: #95002a;
}

.checkout-content {
  display: grid;
  grid-template-columns: 1fr 400px;
  gap: 2rem;
}

.form-card {
  background: #ffffff;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.form-card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #e5e5e5;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  font-weight: 500;
  margin-bottom: 0.5rem;
  color: #333;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #e5e5e5;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #95002a;
}

.form-group textarea {
  min-height: 100px;
  resize: vertical;
}

.error-text {
  color: #dc2626;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

.payment-info {
  margin: 0;
  color: #666;
}

.submit-btn {
  width: 100%;
  padding: 1rem;
  background: #95002a;
  color: #ffffff;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s ease;
}

.submit-btn:hover:not(:disabled) {
  background: #7a0022;
}

.submit-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.summary-card {
  background: #ffffff;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  padding: 1.5rem;
  position: sticky;
  top: 2rem;
}

.summary-card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #e5e5e5;
}

.order-items {
  max-height: 300px;
  overflow-y: auto;
}

.order-item {
  display: flex;
  gap: 1rem;
  padding: 0.75rem 0;
  border-bottom: 1px solid #f3f4f6;
}

.order-item:last-child {
  border-bottom: none;
}

.item-image {
  width: 60px;
  height: 60px;
  object-fit: contain;
  background: #f9fafb;
  border-radius: 4px;
}

.item-details h4 {
  margin: 0 0 0.25rem;
  font-size: 0.9375rem;
  font-weight: 500;
}

.item-details p {
  margin: 0;
  color: #666;
  font-size: 0.875rem;
}

.summary-totals {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #e5e5e5;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 0.5rem 0;
  color: #666;
}

.summary-row.total {
  font-weight: 700;
  font-size: 1.125rem;
  color: #171616;
  padding-top: 0.75rem;
  margin-top: 0.5rem;
  border-top: 1px solid #e5e5e5;
}

@media (max-width: 1024px) {
  .checkout-content {
    grid-template-columns: 1fr;
  }

  .summary-card {
    position: static;
  }
}

@media (max-width: 768px) {
  .checkout-header {
    padding: 1.5rem 0;
  }

  .page-title {
    font-size: 1.5rem;
  }
}
</style>