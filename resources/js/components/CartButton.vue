<template>
  <div>
    <button type="button" @click="addToCart()"
            :class="[isInCart ? 'bg-gray-300 text-gray-700 cursor-not-allowed' : 'tp-product-add-cart-btn-large', 'flex items-center justify-center rounded-none px-4 py-2 h-10 transition-colors duration-300']"
            :disabled="isInCart">
      <span class="mr-2">
        <font-awesome-icon :icon="isInCart ? 'fa-check' : 'fa-cart-plus'" />
      </span>
      <span>{{ isInCart ? 'In Cart' : 'Add To Cart' }}</span>
    </button>

   
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useCartStore } from '../store/cart.js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    product: Object,
    classes: String
})

const store = ref(null)

const isInCart = computed(()=>{
    if (store.value && store.value.cart) {
        return store.value.cart.find(item => item.id === props.product.id)
    }
    return false;
})

function addToCart(){
    if (store.value && !isInCart.value) {
        store.value.addToCart({...props.product, quantity: 1});
        // Show Toastr notification
        toast.success(`${props.product.product_name} added to cart!`);
    }
}

onMounted(()=> {
    store.value = useCartStore()
})
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
</style>
