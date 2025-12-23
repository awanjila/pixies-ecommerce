<template>
  <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu" :class="{ 'ltn__utilize-open': true }">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
      <div class="ltn__utilize-menu-head">
        <span class="ltn__utilize-menu-title">Cart</span>
        <button class="ltn__utilize-close" @click="$emit('close')">×</button>
      </div>
      <div v-if="cart.length > 0" class="mini-cart-product-area ltn__scrollbar">
        <div class="mini-cart-item clearfix" v-for="item in cart" :key="item.id">
          <div class="mini-cart-img">
            <a href="#"><img :src="item.product_image || 'img/product/1.png'" alt="Image"></a>
            <span class="mini-cart-item-delete" @click="removeItem(item.id)"><i class="icon-cancel"></i></span>
          </div>
          <div class="mini-cart-info">
            <h6><a href="#">{{ capitalizeProductName(item.product_name) }}</a></h6>
            <span class="mini-cart-quantity">{{ item.quantity }} x Ksh {{ item.selling_price }}.00</span>
          </div>
        </div>
      </div>
      <div v-else class="empty-cart-message">
        <p>Your cart is empty. Start shopping now!</p>
      </div>
      <div class="mini-cart-footer">
        <div class="mini-cart-sub-total">
          <h5>Subtotal: <span>Ksh {{ cartTotal }}.00</span></h5>
        </div>
        <div class="btn-wrapper">
          <a href="/show/cart" class="theme-btn-1 btn btn-effect-1 btn-full" @click="closeDrawer">View Cart</a>
          <a href="/checkout" class="theme-btn-2 btn btn-effect-2 btn-full" @click="closeDrawer">Checkout</a>
        </div>
        <p>Free Shipping on All Orders Over Ksh 100!</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";
import { useCartStore } from '../store/cart';

// Accept props for cart items and total
const props = defineProps({
  cart: {
    type: Array,
    required: true,
  },
  cartTotal: {
    type: Number,
    required: true,
  },
});

// Declare the emits option to define the 'close' event
const emit = defineEmits(['close']);

const cartStore = useCartStore();

const removeItem = (id) => {
  cartStore.removeFromCart(id);
};

const capitalizeProductName = (name) => {
  return name.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
};

const closeDrawer = () => {
  emit('close');
};
</script>

<style scoped>
.ltn__utilize-cart-menu {
  position: fixed;
  right: -100%;
  top: 0;
  width: 400px; /* Increased width */
  height: 100%;
  background: #fff;
  z-index: 9999; /* Ensure it's on top of everything */
  transition: all 0.3s ease;
  box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
}

.ltn__utilize-cart-menu.ltn__utilize-open {
  right: 0;
}

.btn-full {
  width: 100%;
  margin-bottom: 10px;
  text-align: center;
}

.empty-cart-message {
  padding: 20px;
  text-align: center;
  font-size: 16px;
  color: #666;
}

.ltn__utilize-menu-inner {
  padding: 20px;
}

.mini-cart-product-area {
  max-height: calc(100vh - 250px);
  overflow-y: auto;
}

.mini-cart-footer {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 20px;
  background: #f7f7f7;
}
</style>
