<template>
  <!-- Cart Icon -->
  <div class="mini-cart-icon" @click.stop="toggleCartDrawer">
    <span class="cart-icon-wrap">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M6 2 6 6"></path>
        <path d="M6 8 17.92 8"></path>
        <path d="M20 8-2.74 6.67A2 2 0 0 0 5 10v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2"></path>
        <path d="M9 14h.01"></path>
        <path d="M15 14h.01"></path>
        <path d="M6 14a2 2 0 0 1 2-2h.5l-.5 4"></path>
      </svg>
    </span>
    <span v-if="cart && cart.length > 0" class="cart-num">{{ cart.length }}</span>
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
.mini-cart-icon {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #171616;
}

.cart-icon-wrap {
  display: flex;
  align-items: center;
  justify-content: center;
}

.cart-icon-wrap svg {
  width: 20px;
  height: 20px;
}

.cart-num {
  position: absolute;
  top: 0;
  right: 0;
  background: #95002a;
  color: #fff;
  font-size: 10px;
  font-weight: 600;
  min-width: 16px;
  height: 16px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cart-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9998;
}

.ltn__utilize-open {
  display: block !important;
}
</style>
