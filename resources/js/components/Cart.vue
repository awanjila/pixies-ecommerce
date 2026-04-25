<template>
  <div class="cart-page">
    <div class="cart-header">
      <h1 class="page-title">Shopping Cart</h1>
    </div>

    <div class="container">
      <div v-if="cart.length === 0" class="empty-cart">
        <p>Your cart is empty</p>
        <a href="/" class="continue-shopping-btn">Continue Shopping</a>
      </div>

      <div v-else class="cart-content">
        <div class="cart-table-wrapper">
          <table class="cart-table">
            <thead>
              <tr>
                <th class="col-product">Product</th>
                <th class="col-price">Price</th>
                <th class="col-quantity">Quantity</th>
                <th class="col-subtotal">Subtotal</th>
                <th class="col-remove"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in cart" :key="item.id">
                <td class="col-product">
                  <div class="product-info">
                    <img :src="getImageUrl(item.product_image)" :alt="item.product_name" class="product-image">
                    <div class="product-details">
                      <h4>{{ item.product_name }}</h4>
                    </div>
                  </div>
                </td>
                <td class="col-price">Ksh {{ formatPrice(item.selling_price) }}</td>
                <td class="col-quantity">
                  <div class="quantity-controls">
                    <button @click="decrementQuantity(item.id)" class="qty-btn">-</button>
                    <span class="qty-value">{{ item.quantity }}</span>
                    <button @click="incrementQuantity(item.id)" class="qty-btn">+</button>
                  </div>
                </td>
                <td class="col-subtotal">Ksh {{ formatPrice(item.selling_price * item.quantity) }}</td>
                <td class="col-remove">
                  <button @click="removeFromCart(item.id)" class="remove-btn">&times;</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="cart-summary">
          <div class="summary-card">
            <h3>Cart Summary</h3>
            <div class="summary-row">
              <span>Subtotal</span>
              <span>Ksh {{ formatPrice(cartTotal) }}</span>
            </div>
            <div class="summary-row total">
              <span>Total</span>
              <span>Ksh {{ formatPrice(cartTotal) }}</span>
            </div>
            <a href="/checkout" class="checkout-btn">Proceed to Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useCartStore } from '../store/cart';

const cartStore = useCartStore();
const { cart, cartTotal } = storeToRefs(cartStore);

const formatPrice = (price) => {
  return new Intl.NumberFormat('en-KE').format(price);
};

const getImageUrl = (path) => {
  if (!path) return '/images/placeholder.jpg';
  return path.startsWith('/') ? path : '/' + path;
};

const incrementQuantity = (id) => {
  cartStore.incrementQuantityInCart(id);
};

const decrementQuantity = (id) => {
  cartStore.decrementQuantityInCart(id);
};

const removeFromCart = (id) => {
  cartStore.removeFromCart(id);
};
</script>

<style scoped>
.cart-page {
  min-height: 100vh;
}

.cart-header {
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

.cart-content {
  display: grid;
  grid-template-columns: 1fr 350px;
  gap: 2rem;
}

.cart-table {
  width: 100%;
  border-collapse: collapse;
}

.cart-table th,
.cart-table td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #e5e5e5;
}

.cart-table th {
  font-weight: 600;
  color: #666;
  font-size: 0.875rem;
  text-transform: uppercase;
}

.cart-table .col-remove {
  width: 50px;
  text-align: center;
}

.cart-table .col-price,
.cart-table .col-subtotal {
  text-align: right;
  font-weight: 600;
  color: #171616;
}

.product-info {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.product-image {
  width: 80px;
  height: 80px;
  object-fit: contain;
  background: #f9fafb;
  padding: 0.5rem;
  border-radius: 4px;
}

.product-details h4 {
  margin: 0;
  font-size: 0.9375rem;
  font-weight: 500;
  color: #171616;
}

.quantity-controls {
  display: flex;
  align-items: center;
  border: 1px solid #e5e5e5;
  border-radius: 4px;
}

.qty-btn {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  transition: all 0.2s ease;
}

.qty-btn:hover {
  background: #f5f5f5;
}

.qty-value {
  width: 40px;
  text-align: center;
  font-weight: 600;
  border-left: 1px solid #e5e5e5;
  border-right: 1px solid #e5e5e5;
  padding: 0.5rem 0;
}

.remove-btn {
  background: none;
  border: none;
  color: #999;
  font-size: 1.5rem;
  cursor: pointer;
  transition: color 0.2s ease;
}

.remove-btn:hover {
  color: #95002a;
}

.summary-card {
  background: #ffffff;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  padding: 1.5rem;
}

.summary-card h3 {
  margin: 0 0 1.5rem;
  font-size: 1.125rem;
  font-weight: 600;
  padding-bottom: 1rem;
  border-bottom: 1px solid #e5e5e5;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  padding: 0.75rem 0;
  color: #666;
}

.summary-row.total {
  border-top: 1px solid #e5e5e5;
  margin-top: 0.5rem;
  padding-top: 1rem;
  font-weight: 700;
  font-size: 1.125rem;
  color: #171616;
}

.checkout-btn {
  display: block;
  width: 100%;
  padding: 0.875rem 1rem;
  background: #95002a;
  color: #ffffff;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  font-weight: 600;
  margin-top: 1.5rem;
  transition: background 0.2s ease;
}

.checkout-btn:hover {
  background: #7a0022;
}

@media (max-width: 1024px) {
  .cart-content {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .cart-header {
    padding: 1.5rem 0;
  }

  .page-title {
    font-size: 1.5rem;
  }

  .cart-table thead {
    display: none;
  }

  .cart-table,
  .cart-table tbody,
  .cart-table tr,
  .cart-table td {
    display: block;
  }

  .cart-table tr {
    padding: 1rem 0;
    border-bottom: 1px solid #e5e5e5;
  }

  .cart-table td {
    padding: 0.5rem 0;
    border: none;
    text-align: left;
  }

  .cart-table .col-price,
  .cart-table .col-subtotal {
    text-align: left;
  }

  .product-info {
    flex-direction: column;
    align-items: flex-start;
  }

  .product-image {
    width: 100%;
    height: auto;
    max-height: 150px;
  }
}
</style>