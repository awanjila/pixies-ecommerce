<template>
    <div class="cart-btn-container">
      <button type="button" class="cart-btn" @click="addOrRemove">
        <i :class="toAdd ? 'bi bi-cart' : 'bi bi-cart-check'"></i> <!-- Keep the icon size consistent -->
      </button> 
      <!-- Place the CartAddRemove component next to the button -->
      <CartAddRemove v-if="!toAdd" :productId="item.id" />
    </div>
  </template>

<script>
import CartAddRemove from './CartAddRemove.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    props: ['product'],
    components: { CartAddRemove },
    data() {
        return {
            toAdd: true,
            item: null
        }
    },
    methods: {
        async addOrRemove() {
            if (!this.item) {
                this.item = { ...this.product, qty: 1 };
            }
            this.$store.commit('addRemoveCart', { product: this.item, toAdd: this.toAdd });
            const toastMSG = this.toAdd ? 'Added to Cart' : 'Removed from Cart';

            toast(toastMSG, {
                autoClose: 1000,
            });

            this.toAdd = !this.toAdd;
        },
    },
    mounted() {
    if (this.product) {
        this.item = this.$store.getters.getProductById(this.product.id);
        if (this.item) {
            this.toAdd = false;
        }
    }
}
}
</script>

<style scoped>
.cart-btn-container {
  display: flex; /* Use flexbox */
  align-items: center; /* Align items vertically */
}

.cart-btn {
  /* Set a fixed width for the button */
  width: 40px; /* Adjust as needed */
  /* Ensure the button maintains consistent appearance */
  padding: 0; /* Remove padding */
  font-size: inherit; /* Inherit font size */
  line-height: inherit; /* Inherit line height */
  /* Add additional styling as needed */
}
</style>
