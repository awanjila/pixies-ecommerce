<template>
    <div>
      <span class="count">{{ cartCount }}</span>
    </div>
  </template>
  
<script>

  import CartService from '../services/cartService';
  
  export default {
    data() {
      return {
        cartCount: 0,
      };
    },
    mounted() {
      this.updateCartCount();
    },
    methods: {
      async updateCartCount() {
        try {
          // Call the CartService to get the updated count
          const response = await CartService.getCartItems();
          
          // Assuming the response contains a property like 'cartCount'
          this.cartCount = response.data.cartCount;
        } catch (error) {
          console.error('Error updating cart count:', error);
        }
      },
    },
  };
  </script>