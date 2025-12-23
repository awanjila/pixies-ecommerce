<template>
  <div class="font-[sans-serif]">
    <div class="mt-10 coupon-container">
      <h3 class="text-xl font-extrabold text-[#333] mb-6">Apply promo code</h3>
      <div class="flex border border-blue-600 overflow-hidden max-w-md rounded">
        <input :value="promoCode" @input="updatePromoCode" type="text" placeholder="Promo code" class="promo-input w-full outline-none bg-white text-gray-600 text-md px-4 py-2.5" />
        <button type="button" @click="applyCoupon" class="apply-button flex items-center justify-center bg-blue-600 hover:bg-blue-700 px-6 text-md text-white">
          Apply
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    promoCode: {
      type: String,
      required: true
    },
    cart: {
      type: Array,
      required: true
    }
  },
  setup(props, { emit }) {
    const promoCode = ref(props.promoCode);

    const updatePromoCode = (event) => {
      promoCode.value = event.target.value;
      emit('update:promoCode', event.target.value);
    };

    const applyCoupon = () => {
        if (this.promoCode === 'AMORE') {
        // Apply 20% discount if promo code is "AMORE"
        const discount = this.subtotal * 0.2;
        const discountedSubtotal = this.subtotal - discount;
        // Update the cart with the discounted subtotal
        useCartStore().applyDiscount(discountedSubtotal);
        // Show toastr message or any other notification
        // toastr.success('Promo code applied successfully');
        alert('Promo code applied successfully');
      } else {
        // Handle invalid promo code
        // toastr.error('Invalid promo code');
        alert('Invalid promo code');
      }
    };

    return {
      promoCode,
      updatePromoCode,
      applyCoupon
    };
  }
};
</script>

<style scoped>
/* Your styles here */
</style>
