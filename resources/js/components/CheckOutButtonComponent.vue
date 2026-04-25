<template>
  <div class="checkout-buttons">
    <button 
      @click="addToCart()"
      :class="['cart-button', { 'disabled': isInCart }]"
      :disabled="isInCart"
    >
      <span class="icon">
        <font-awesome-icon :icon="isInCart ? 'fa-check' : 'fa-cart-plus'" />
      </span>
      <span>{{ isInCart ? 'In Cart' : 'Add To Cart' }}</span>
    </button>
  
    <button 
      @click="shareOnWhatsapp()"
      class="whatsapp-button"
    >
      <span class="icon">
        <i class="bi bi-whatsapp"></i>
      </span>
      <span>Order On Whatsapp</span>
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useCartStore } from '../store/cart.js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    productId: Number,
    productName: String,
    sellingPrice: Number
});

const store = useCartStore(); // Assign the store directly

const isInCart = computed(() => {
    return store.cart.some(item => item.id === props.productId);
});

function addToCart() {
    if (!isInCart.value) {
        store.addToCart({
            id: props.productId,
            product_name: props.productName,
            selling_price: props.sellingPrice,
            quantity: 1
        });
        toast.success(`${props.productName} added to cart!`);
    }
}

function shareOnWhatsapp() {
    const message = `Hi, I would like to order the ${props.productName}. Here is the link to the product: ${window.location.href}`;
    const whatsappLink = `https://wa.me/+254798742543?text=${encodeURIComponent(message)}`;
    window.open(whatsappLink, '_blank');
}
</script>

<style scoped>
.checkout-buttons {
  display: flex;
  gap: 1rem;
  width: 100%;
}

.cart-button,
.whatsapp-button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border-radius: 0.375rem;
  font-weight: 500;
  transition: all 0.3s ease;
  flex: 1;
}

.cart-button {
  background-color: #0a609d;
  color: white;
  border: none;
}

.cart-button:hover:not(.disabled) {
  background-color: #b91c1c;
}

.cart-button.disabled {
  background-color: #e5e7eb;
  color: #6b7280;
  cursor: not-allowed;
}

.whatsapp-button {
  background-color: #25D366;
  color: white;
  border: none;
}

.whatsapp-button:hover {
  background-color: #128C7E;
}

.icon {
  font-size: 1.25rem;
}

@media (max-width: 768px) {
  .checkout-buttons {
    flex-direction: column;
  }
}
</style>
