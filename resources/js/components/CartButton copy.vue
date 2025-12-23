<template>
  <div>
    <button @click="addToCart" :class="classes">
      <span>
        <font-awesome-icon icon="fa-cart-plus" />
      </span>
      <span>{{ isInCart ? 'In Cart' : 'Add To Cart' }}</span>
    </button>
    <teleport to="body">
      <transition name="fade">
        <div class="cart-drawer-overlay" v-if="displayCartDrawer" @click="hideCartDrawer">
          <div class="cart-drawer-container">
            <button @click.stop="hideCartDrawer" class="cart-drawer-close-button">
              <font-awesome-icon icon="fa-times" />
            </button>
            <CartDrawer :cartItems="cartItems" @close="hideCartDrawer" />
          </div>
        </div>
      </transition>
    </teleport>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useCartStore } from '../store/cart.js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import CartDrawer from './CartDrawer.vue';

const store = ref(null);

const props = defineProps({
  product: Object,
  classes: String
});

const isInCart = computed(() => store.value && store.value.cart && store.value.cart.find(item => item.id === props.product.id));

function addToCart(){
  if (store.value && !isInCart.value) {
    store.value.addToCart({...props.product, quantity: 1});
    // Show Toastr notification
    toast(`${props.product.product_name} added to cart!`, {
      autoClose: 3000,
      closeButton: false,
      hideProgressBar: true,
    });
    showCartDrawer();
  }
}

function showCartDrawer() {
  displayCartDrawer.value = true;
}

function hideCartDrawerAfterDelay() {
  setTimeout(() => {
    hideCartDrawer();
  }, 3000); // Adjust the duration as needed (in milliseconds)
}

const displayCartDrawer = ref(false);

const cartItems = computed(() => store.value && store.value.cart ? store.value.cart : []);

onMounted(() => {
  store.value = useCartStore();
});
</script>

<style scoped>
/* Additional custom styles */
button {
  transition: background-color 0.3s, color 0.3s;
}

button:hover {
  filter: brightness(110%);
}

button:focus {
  outline: none;
}

.cart-drawer-overlay {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
}
.cart-drawer-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.cart-drawer-close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  background: transparent;
  border: none;
  cursor: pointer;
}
</style>