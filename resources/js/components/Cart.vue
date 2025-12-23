<template>
  <!-- BREADCRUMB AREA START -->
  <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image" data-bs-bg="img/bg/14.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ltn__breadcrumb-inner">
            <h1 class="page-title">Cart</h1>
            <div class="ltn__breadcrumb-list">
              <ul>
                <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                <li>Cart</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- BREADCRUMB AREA END -->

  <!-- SHOPPING CART AREA START -->
  <div class="liton__shoping-cart-area mb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping-cart-inner">
            <div class="shoping-cart-table table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th class="cart-product-remove">Remove</th>
                    <th class="cart-product-image">Image</th>
                    <th class="cart-product-info">Product</th>
                    <th class="cart-product-price">Price</th>
                    <th class="cart-product-quantity">Quantity</th>
                    <th class="cart-product-subtotal">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in cart" :key="item.id">
                    <td class="cart-product-remove">
                      <a href="#" @click.prevent="removeFromCart(item.id)">x</a>
                    </td>
                    <td class="cart-product-image">
                      <a href="#">
                        <img :src="'/storage/' + item.product_image" :alt="item.product_name" @error="handleImageError">
                      </a>
                    </td>
                    <td class="cart-product-info">
                      <h4><a href="#">{{ item.product_name }}</a></h4>
                    </td>
                    <td class="cart-product-price">Ksh {{ item.selling_price }}.00</td>
                    <td class="cart-product-quantity">
                      <div class="custom-quantity-input">
                        <button 
                          type="button" 
                          class="qty-btn minus" 
                          @click="decrementQuantity(item.id)"
                        >-</button>
                        <input 
                          type="number" 
                          v-model.number="item.quantity" 
                          @input="updateQuantity(item.id, $event.target.value)"
                          min="1"
                          class="qty-input"
                        >
                        <button 
                          type="button" 
                          class="qty-btn plus" 
                          @click="incrementQuantity(item.id)"
                        >+</button>
                      </div>
                    </td>
                    <td class="cart-product-subtotal">Ksh {{ item.selling_price * item.quantity }}.00</td>
                  </tr>
                  <tr class="cart-coupon-row">
                    <td colspan="6">
                      <div class="cart-coupon">
                        <input type="text" v-model="couponCode" name="cart-coupon" placeholder="Coupon code">
                        <button type="submit" @click="applyCoupon" class="btn theme-btn-2 btn-effect-2">Apply Coupon</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="shoping-cart-total mt-50">
              <h4>Cart Totals</h4>
              <table class="table">
                <tbody>
                  <tr>
                    <td>Cart Subtotal</td>
                    <td>Ksh {{ cartTotal }}.00</td>
                  </tr>
                  
                  <tr>
                    <td><strong>Order Total</strong></td>
                    <td><strong>Ksh {{ orderTotal }}.00</strong></td>
                  </tr>
                </tbody>
              </table>
              <div class="btn-wrapper text-right">
                <a href="/checkout" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- SHOPPING CART AREA END -->
</template>

<script setup>
import { ref, computed } from 'vue';
import { useCartStore } from '../store/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart, cartTotal } = storeToRefs(cartStore);
const couponCode = ref('');
const shippingCost = ref(15);

// Update VAT calculation to use the original cartTotal
const calculateVAT = computed(() => {
  return Math.round(cartStore.cartTotal * 0.16);
});

// Update orderTotal to use the original cartTotal
const orderTotal = computed(() => {
  return cartStore.cartTotal ;
});

// Use the original store methods
const incrementQuantity = (id) => {
  cartStore.incrementQuantityInCart(id);
};

const decrementQuantity = (id) => {
  cartStore.decrementQuantityInCart(id);
};

const removeFromCart = (id) => {
  cartStore.removeFromCart(id);
};

const applyCoupon = () => {
  cartStore.applyCoupon(couponCode.value);
};

const updateQuantity = (id, value) => {
  // Convert input to number and ensure it's at least 1
  const newQuantity = Math.max(1, parseInt(value) || 1);
  cartStore.updateQuantity(id, newQuantity);
};

const handleImageError = (e) => {
  e.target.src = '/images/placeholder.jpg'; // Replace with your placeholder image path
};
</script>

<style scoped>
.cart-product-image img {
  max-width: 80px;
}

.cart-coupon {
  display: flex;
  gap: 10px;
}

.cart-coupon input {
  padding: 8px 15px;
  border: 1px solid #ddd;
  flex: 1;
}

.btn-wrapper {
  margin-top: 20px;
}

.theme-btn-1,
.theme-btn-2 {
  padding: 8px 20px;
  border: none;
  cursor: pointer;
}

.cart-product-remove a {
  color: #ff0000;
  font-size: 20px;
  font-weight: bold;
  text-decoration: none;
}

.shoping-cart-table th,
.shoping-cart-table td {
  vertical-align: middle;
  text-align: center;
}

.cart-product-info h4 {
  margin: 0;
}

.cart-product-info a {
  color: inherit;
  text-decoration: none;
}

.custom-quantity-input {
  position: relative;
  width: 120px;
  height: 40px;
  border: 1px solid #ddd;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  border-radius: 4px;
}

.qty-input {
  width: 40px;
  height: 100%;
  text-align: center;
  border: none;
  background: transparent;
  padding: 0;
  font-size: 16px;
  margin: 0;
  -moz-appearance: textfield;
}

.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.qty-btn {
  width: 40px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  background: none;
  border: none;
  font-size: 18px;
  color: #333;
  transition: all 0.3s ease;
}

.qty-btn.minus {
  border-right: 1px solid #ddd;
}

.qty-btn.plus {
  border-left: 1px solid #ddd;
}

.qty-btn:hover {
  background-color: #f5f5f5;
}
</style>
