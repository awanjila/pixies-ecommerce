<template>
  <!-- Add mobile header spacer -->
  <div class="mobile-header-spacer"></div>

  <div class="container mx-auto px-4 pt-16 main-container">
    <div class="flex flex-col lg:flex-row" v-if="cart.length > 0">
      <!-- Left Column: Checkout Form -->
      <div class="w-full lg:w-2/3 lg:pr-6">
        <div class="bg-white p-6 rounded-lg shadow-md checkout-form-container">
          <h2 class="text-2xl font-bold mb-6 sticky top-0 bg-white z-10 pb-4">Checkout</h2>
          
          <!-- Forms Container -->
          <div class="forms-content">
            <!-- Customer Information -->
            <section class="mb-8">
              <h3 class="text-xl font-bold mb-4">Customer Information</h3>
              <div class="space-y-4">
                <div class="form-row">
                  <label for="name" class="block mb-2">Name</label>
                  <input 
                    type="text" 
                    id="name" 
                    v-model="formData.customer_name" 
                    :class="[
                      'w-full px-3 py-2 border rounded-md focus:outline-none',
                      formErrors.includes('Name is required.') 
                        ? 'border-red-500 focus:ring-2 focus:ring-red-500' 
                        : 'border-gray-300 focus:ring-2 focus:ring-blue-500'
                    ]"
                    placeholder="Enter your full name"
                    required 
                  />
                  <p 
                    v-if="formErrors.includes('Name is required.')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Name is required.
                  </p>
                </div>
                <div class="form-row">
                  <label for="email" class="block mb-2">Email</label>
                  <input 
                    type="email" 
                    id="email" 
                    v-model="formData.customer_email" 
                    :class="[
                      'w-full px-3 py-2 border rounded-md focus:outline-none',
                      formErrors.some(error => error.includes('Email')) 
                        ? 'border-red-500 focus:ring-2 focus:ring-red-500' 
                        : 'border-gray-300 focus:ring-2 focus:ring-blue-500'
                    ]"
                    placeholder="Enter your email address"
                    required 
                  />
                  <p 
                    v-if="formErrors.includes('Email is required.')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Email is required.
                  </p>
                  <p 
                    v-if="formErrors.includes('Invalid email address.')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Invalid email address.
                  </p>
                </div>
                <div class="form-row">
                  <label for="phone" class="block mb-2">Phone</label>
                  <input 
                    type="tel" 
                    id="phone" 
                    v-model="formData.customer_phone" 
                    :class="[
                      'w-full px-3 py-2 border rounded-md focus:outline-none',
                      formErrors.some(error => error.includes('phone') || error.includes('Phone')) 
                        ? 'border-red-500 focus:ring-2 focus:ring-red-500' 
                        : 'border-gray-300 focus:ring-2 focus:ring-blue-500'
                    ]"
                    placeholder="Enter your phone number"
                    required 
                  />
                  <p 
                    v-if="formErrors.includes('Phone number is required.')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Phone number is required.
                  </p>
                  <p 
                    v-if="formErrors.includes('Invalid phone number. Please use the format 0******* or 254*******')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Invalid phone number. Please use the format 0******* or 254*******
                  </p>
                </div>
                <div class="form-row">
                  <label for="address" class="block mb-2">Delivery Address</label>
                  <input 
                    type="text" 
                    id="address" 
                    v-model="formData.customer_address" 
                    :class="[
                      'w-full px-3 py-2 border rounded-md focus:outline-none',
                      formErrors.some(error => error.includes('address') || error.includes('Address')) 
                        ? 'border-red-500 focus:ring-2 focus:ring-red-500' 
                        : 'border-gray-300 focus:ring-2 focus:ring-blue-500'
                    ]"
                    placeholder="Enter your delivery address"
                    required 
                  />
                  <p 
                    v-if="formErrors.includes('Delivery address is required.')" 
                    class="text-red-500 text-sm mt-1"
                  >
                    Delivery address is required.
                  </p>
                </div>
              </div>
            </section>

            <!-- Delivery Information -->
            <section class="mb-8">
              <h3 class="text-xl font-bold mb-4">Delivery Information</h3>
              <div class="space-y-4">
                <div class="form-row">
                  <label for="special-instructions">Special Instructions</label>
                  <textarea id="special-instructions" v-model="specialInstructions" placeholder="Add any delivery instructions or notes"></textarea>
                </div>
              </div>
            </section>

            <!-- Payment Method -->
            <section class="mb-8">
              <h3 class="text-xl font-bold mb-4">Payment Method</h3>
              <p class="text-gray-700">M-Pesa</p>
            </section>

            <!-- Submit Button -->
            <button 
              @click="submitOrder" 
              :disabled="processing"
              class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors"
            >
              {{ processing ? 'Processing Order...' : 'Complete Order' }}
            </button>
          </div>
        </div>
      </div>

      <!-- Right Column: Order Summary -->
      <div class="w-full lg:w-1/3 mt-6 lg:mt-0">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold mb-4 pb-4 border-b">Order Summary</h3>
          
          <!-- Products List -->
          <div class="order-items">
            <div v-for="item in cart" :key="item.id" class="flex gap-4 mb-4">
              <img :src="getImageUrl(item.product_image)" :alt="item.product_name" class="w-20 h-20 object-contain">
              <div>
                <p class="font-semibold">{{ item.product_name }}</p>
                <p class="text-gray-600">Ksh {{ item.selling_price }} x {{ item.quantity }}</p>
              </div>
            </div>
          </div>

          <!-- Price Summary -->
          <div class="border-t mt-4 pt-4 space-y-2">
            <div class="flex justify-between">
              <span>Subtotal</span>
              <span>Ksh {{ calculateSubTotal() }}</span>
            </div>
           
            <div class="flex justify-between font-bold text-lg">
              <span>Total</span>
              <span>Ksh {{ calculateTotal() }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Empty Cart Message -->
    <div v-else class="text-center py-16">
      <h2 class="text-2xl font-bold mb-4">Your cart is empty</h2>
      <button @click="redirectToShop" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
        Return to Shop
      </button>
    </div>
  </div>
</template>

<style scoped>
.mobile-header-spacer {
  display: none;
}

.main-container {
  min-height: calc(100vh - 160px);
  padding-bottom: 40px;
}

.checkout-form-container {
  max-height: none;
}

.forms-content {
  max-height: none;
  overflow-y: visible;
}

.order-items {
  max-height: 300px;
  overflow-y: auto;
}

@media (max-width: 768px) {
  .mobile-header-spacer {
    display: block;
    height: 80px;
  }

  .main-container {
    padding-top: 1rem;
  }

  .flex {
    flex-direction: column;
  }
}

@media (max-width: 480px) {
  .mobile-header-spacer {
    height: 100px;
  }
}
</style>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import OrderSuccessModal from '../components/OrderSuccessModal.vue';
// import DeliveryAreas from '../components/DeliveryAreas.vue';

export default {
  components: {
    OrderSuccessModal,
    // DeliveryAreas,
  },
  data() {
    return {
      orderId: null,
      orderPlaced: false,
      formErrors: [],
    
      formData: {
        customer_name: '',
        customer_email: '',
        // customer_address: '',
        customer_phone: '',
        payment_status: 'mobile', // Set the default payment method to 'mobile'
        cart_contents: [],
      },
      cart: [],
      processing: false,
      orderSuccessModalVisible: false,
      specialInstructions: '',
    };
  },
  created() {
    const storedCart = JSON.parse(localStorage.getItem('cart'));
    const couponApplied = localStorage.getItem('couponApplied');
    const couponCode = localStorage.getItem('couponCode');
    
    if (couponApplied === 'true') {
      console.log('Coupon applied:', couponCode);
      this.formData.coupon_code = couponCode;
    } else {
      console.log('No coupon applied');
    }

    if (storedCart) {
      this.cart = storedCart;
      console.log('Cart Data:', this.cart);
    }
  },
  methods: {
    clearCartAndReload() {
      // Clear the cart by setting it to an empty array
      this.cart = [];
      // Update the local storage to reflect the cleared cart
      localStorage.setItem('cart', JSON.stringify([]));
      // Clear coupon code from local storage
      localStorage.removeItem('couponApplied');
      localStorage.removeItem('couponCode');
      // Reload to the main page
      window.location.href = '/';
    },

    async submitOrder() {
      this.formErrors = []; // Reset form errors

      if (!this.validateForm()) {
        // Scroll to the first error
        this.$nextTick(() => {
          const firstErrorElement = document.querySelector('.border-red-500');
          if (firstErrorElement) {
            firstErrorElement.scrollIntoView({ 
              behavior: 'smooth', 
              block: 'center' 
            });
          }
        });
        return;
      }
      
      try {
        // Fetch CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Include CSRF token in form data
        this.formData._token = csrfToken;
        // Directly assign cart contents to formData
        this.formData.cart_contents = this.cart.map(item => {
          return {
            id: item.id,
            name: item.product_name,
            price: item.selling_price,
            quantity: item.quantity
          };
        });
        // Include payment method data when submitting the order
        this.formData.total_products = this.calculateCartCount(); // Add cart count to formData
        this.formData.total_amount = this.calculateTotal(); // Add total amount to formData
        this.formData.sub_total = this.calculateSubTotal(); // Add Sub total amount to formData
        // Change button text to "Processing Order..."
        this.processing = true;
        // Send POST request to backend with CSRF token included
        const response = await axios.post('/final-invoice', this.formData);
        if (response.data.success) {
          // Clear the cart after a successful order and reload to the main page
          this.clearCartAndReload();
          // Show a success toast
          toast.success('Order placed successfully! Your Order has been Successfully Placed. Kindly wait for a call from our customer Agent.', {
            duration: 5000,
            dangerouslyUseHTMLString: true, // Enable HTML rendering
            transition: 'Vue-Toastification__bounce',
            className: 'custom-toast',
            draggable: true,
          });
          // Show the order success modal
          this.orderSuccessModalVisible = true;
        } else {
          // Show an error message if the order was not placed successfully
          toast.error(response.data.message);
          this.orderPlaced = true; // Set orderPlaced to true to show the modal
        }
      } catch (error) {
        // Show an error message if there was a problem with the server request
        toast.error('There was a problem with your order. Please try again later.');
      } finally {
        // Reset button text to "Place Order" after processing
        this.processing = false;
      }
    },

    validateForm() {
      let isValid = true;
      
      // Clear previous errors
      this.formErrors = [];
      
      // Name validation
      if (!this.formData.customer_name.trim()) {
        this.formErrors.push('Name is required.');
        isValid = false;
      }
      
      // Email validation
      if (!this.formData.customer_email.trim()) {
        this.formErrors.push('Email is required.');
        isValid = false;
      } else if (!this.isValidEmail(this.formData.customer_email.trim())) {
        this.formErrors.push('Invalid email address.');
        isValid = false;
      }
      
      // Phone validation
      const phoneInput = this.formData.customer_phone.trim();
      console.log('Phone Input:', phoneInput); // Log the raw input

      if (!phoneInput) {
        this.formErrors.push('Phone number is required.');
        isValid = false;
      } else {
        const cleanedPhone = phoneInput.replace(/[\s-]/g, '');
        console.log('Cleaned Phone:', cleanedPhone); // Log the cleaned input

        // Detailed phone validation logging
        if (!/^(0|254)\d{9}$/.test(cleanedPhone)) {
          console.log('Phone Validation Failed');
          console.log('Regex Test Result:', /^(0|254)\d{9}$/.test(cleanedPhone));
          console.log('Starts with 0 or 254:', /^(0|254)/.test(cleanedPhone));
          console.log('Has 9 digits after prefix:', /\d{9}$/.test(cleanedPhone));
          
          this.formErrors.push('Invalid phone number. Please use the format 0******* or 254*******');
          isValid = false;
        }
      }

      // Log all errors for debugging
      console.log('Form Errors:', this.formErrors);

      return isValid;
    },

    isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },

    isValidPhoneNumber(phone) {
      // More verbose validation for debugging
      const cleanedPhone = phone.replace(/[\s-]/g, '');
      const isValid = /^(0|254)\d{9}$/.test(cleanedPhone);
      
      console.log('Phone Validation Details:');
      console.log('Original Phone:', phone);
      console.log('Cleaned Phone:', cleanedPhone);
      console.log('Is Valid:', isValid);
      
      return isValid;
    },

    // isValidCustomerAddress(address) {
    //   return true;
    // },

    calculateTotal() {
      const productTotal = this.cart.reduce((total, item) => total + (item.selling_price * item.quantity), 0);
      return productTotal;
    },

    calculateSubTotal() {
      const productTotal = this.cart.reduce((total, item) => total + (item.selling_price * item.quantity), 0);
      return productTotal;
    },

    calculateCartCount() {
      return this.cart.reduce((count, item) => count + item.quantity, 0);
    },

    // updateAddress(address) {
    //   this.formData.customer_address = address;
    // },
    redirectToShop() {
    window.location.href = '/'; // Modify the path to your shop page
  },
  getImageUrl(path) {
    if (!path) return '/front-assets/img/brand-logo/logo.png';
    return path.startsWith('/') ? path : '/' + path;
  },
  handleImageError(e) {
    // Replace broken image with a default one
    e.target.src = '/front-assets/img/brand-logo/logo.png';
  },
  }
};
</script>
