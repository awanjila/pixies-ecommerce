<template>
  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-8 w-96">
      <h2 class="text-2xl font-bold text-center text-green-600 mb-4">Thank You For Shopping With Us</h2>
      <p class="text-lg text-center mb-8">Your Order has been Successfully Placed. Kindly wait for a call from our customer Agent.</p>
      <a href="/" class="mt-6 text-md px-6 py-2.5 w-full bg-blue-600 hover:bg-blue-700 text-white rounded inline-block text-center font-semibold">Back To Shop</a>
    </div>
  </div>
</template>

<script>
import { useCartStore } from "../store/cart"; // Import the cart store
import { useRoute } from 'vue-router'; // Import useRoute from vue-router

export default {
  props: {
    showModal: {
      type: Boolean,
      required: true
    },
    orderId: {
      type: String,
      default: ''
    },
    totalAmount: {
      type: Number,
      default: 0
    },
    paymentMethod: {
      type: String,
      default: ''
    }
  },
  methods: {
    closeModal() {
      this.$emit('close');
    }
  },
  setup() {
    const route = useRoute();
    
    return { route };
  },
  watch: {
    showModal(newValue) {
      if (newValue) {
        // Call the clearCart method from the cart store when the modal is shown
        const cartStore = useCartStore();
        cartStore.clearCart();
      }
    }
  }
};
</script>

<style scoped>
/* Your CSS styles go here */
.font-bold {
  font-family: 'Montserrat', sans-serif;
}

.text-green-600 {
  color: #1B5E20;
}

a {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
  transition: background-color 0.3s ease;
}

a:hover {
  background-color: #45a049;
}
</style>
