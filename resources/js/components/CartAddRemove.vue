<template>
  <div v-if="product" class="input-group plus-minus">
    <button 
      class="btn btn-outline-secondary minus-btn" 
      :class="{ 'loading': loading }" 
      @click="updateQuantity(-1)" 
      type="button" 
      id="button-decrement"
    >
      -
    </button>
    <input 
      type="number" 
      v-model="qty" 
      disabled 
      class="form-control form-control-sm input-number" 
      placeholder="" 
      aria-label="Example text with button addon" 
      aria-describedby="button-addon1"
    >
    <button 
      class="btn btn-outline-secondary plus-btn" 
      :class="{ 'loading': loading }" 
      @click="updateQuantity(1)" 
      type="button" 
      id="button-increment"
    >
      +
    </button>
  </div>
</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  name: 'CartAddRemove',
  props: {
    productId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      qty: 1,
      loading: false,
      product: null
    };
  },
  methods: {
    async updateQuantity(change) {
  this.loading = true;
  this.qty += change;
  if (this.qty < 1) {
    toast.warning('Quantity cannot be less than 1');
    this.qty = 1;
  } else if (this.qty > 10) {
    toast.warning('You reached the limit');
    this.qty = 10;
  } else {
    await this.updateCart();
    this.showToast(change > 0); // Pass true if adding, false if removing
  }
  this.loading = false;
},
showToast(isAdding) {
  if (isAdding) {
    toast.success('Item added to Cart!', { autoClose: 3000 });
  } else {
    toast.success('Item removed from Cart!', { autoClose: 3000 });
  }
},
    async updateCart() {
      const product = this.$store.getters.getProductById(this.productId);
      if (product) {
        product.qty = this.qty;
        await this.$store.commit('updateCart', { product });
      } else {
        toast.error('Product not found');
      }
    }
  },
  mounted() {
    this.product = this.$store.getters.getProductById(this.productId);
    this.qty = this.product.qty;
  }
};
</script>

<style scoped>
.input-group {
  display: flex; /* Use flexbox for horizontal alignment */
  align-items: center; /* Center items vertically */
}

.input-group button,
.input-group input {
  margin: 0; /* Remove default margins */
  height: 38px; /* Set button and input height */
}

.input-group .input-number {
  flex: 1; /* Allow input to grow to fill remaining space */
  text-align: center; /* Center text within input */
}

.minus-btn,
.plus-btn {
  width: 38px; /* Set button width */
}
</style>
