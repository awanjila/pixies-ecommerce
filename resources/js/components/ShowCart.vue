<template>
  <!-- Cart Icon with Cart Length and Total Amount -->
  <div class="mini-cart-icon mini-cart-icon-2" @click.stop="toggleCartDrawer">
    <a class="ltn__utilize-toggle">
      <span class="mini-cart-icon">
        <i class="icon-shopping-cart"></i>
        <sup>{{ cart ? cart.length : 0 }}</sup>
      </span>
      <h6 class="hidden md:block">
        <span>Your Cart</span>
        <span class="ltn__secondary-color">Ksh {{ cartTotal }}.00</span>
      </h6>
    </a>
  </div>

  <!-- CartDrawer component -->
  <CartDrawer 
    v-if="isCartDrawerOpen"
    :cart="cart" 
    :cartTotal="cartTotal" 
    @close="closeCartDrawer"
    :class="{ 'ltn__utilize-open': isCartDrawerOpen }"
  />

  <!-- Overlay to detect clicks outside the cart drawer -->
  <div v-if="isCartDrawerOpen" class="cart-overlay" @click="closeCartDrawer"></div>
</template>


<script setup>
import { computed, ref, onMounted, onUnmounted, watch } from "vue";
import { useCartStore } from "../store/cart";
import CartDrawer from './CartDrawer.vue'; // Import the CartDrawer component

// Reactive references
const cartStore = useCartStore();
const cart = computed(() => cartStore.cart);
const isCartDrawerOpen = ref(false); // Controls whether the CartDrawer is open or closed

// Computed property to calculate total cart amount
const cartTotal = computed(() => {
  if (!cart.value || cart.value.length === 0) {
    return 0;
  }
  return cart.value.reduce((total, item) => {
    return total + item.selling_price * item.quantity;
  }, 0);
});

// Toggle function to show or hide the CartDrawer
const toggleCartDrawer = () => {
  isCartDrawerOpen.value = !isCartDrawerOpen.value;
  console.log('Cart drawer toggled:', isCartDrawerOpen.value); // Add this line for debugging
};

// Function to close the cart drawer
const closeCartDrawer = () => {
  isCartDrawerOpen.value = false;
};

// Close cart drawer on ESC key press
const handleEscKey = (event) => {
  if (event.key === 'Escape' && isCartDrawerOpen.value) {
    closeCartDrawer();
  }
};

onMounted(() => {
  console.log('ShowCart mounted');
  document.addEventListener('keydown', handleEscKey);
});

onUnmounted(() => {
  document.removeEventListener('keydown', handleEscKey);
});

watch(isCartDrawerOpen, (newValue) => {
  console.log('isCartDrawerOpen changed:', newValue);
});
</script>

<style scoped>
.cart-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9998;
}

@media (max-width: 767px) {
  .mini-cart-icon-2 h6 {
    display: none;
  }
}

.mini-cart-icon {
  cursor: pointer;
}

.mini-cart-icon-2 {
  position: relative;
  z-index: 1002; /* Ensure it's above other elements */
}

.ltn__utilize-open {
  display: block !important;
}
</style>
