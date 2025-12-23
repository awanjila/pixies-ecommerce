<template>
  <div class="add-to-cart-modal" v-if="product">
    <div class="modal-overlay" @click="$emit('close')"></div>
    <div class="modal-content">
      <button class="close-button" @click="$emit('close')" aria-label="Close Modal">&times;</button>
      <div class="modal-body">
        <div class="ltn__quick-view-modal-inner">
          <div class="modal-product-item">
            <div class="modal-product-content">
              <div class="modal-product-img">
                <img :src="product.product_image || '/img/default-product.png'" :alt="product.product_name">
              </div>
              <div class="modal-product-info">
                <h5><a href="#">{{ product.product_name }}</a></h5>
                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully added to your Cart</p>
                <div class="btn-wrapper">
                  <a href="/show/cart" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                  <a href="/checkout" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                </div>
              </div>
            </div>
            <div class="additional-info" v-if="showDiscountInfo">
              <p>We want to give you <b>10% discount</b> for your first order, <br> Use discount code at checkout</p>
              <div class="payment-method">
                <img src="/img/icons/payment.png" alt="Payment methods">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
      required: true
    },
    showDiscountInfo: {
      type: Boolean,
      default: false
    }
  },
  mounted() {
    if (!this.product) {
      console.error('Product is null or undefined in AddToCartModal');
      this.$emit('close');
    } else {
      console.log('AddToCartModal mounted with product:', this.product);
    }
    this.disableBodyScroll();
    window.addEventListener('keyup', this.handleKeyUp);
  },
  beforeUnmount() {
    this.enableBodyScroll();
    window.removeEventListener('keyup', this.handleKeyUp);
  },
  methods: {
    handleKeyUp(event) {
      if (event.key === 'Escape') {
        this.$emit('close');
      }
    },
    disableBodyScroll() {
      document.body.style.overflow = 'hidden';
    },
    enableBodyScroll() {
      document.body.style.overflow = '';
    }
  }
}
</script>


<style scoped>
.add-to-cart-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  display: flex !important;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  width: 90%;
  max-width: 400px;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  z-index: 1001;
}

.modal-product-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.modal-product-img {
  width: 120px;
  height: 120px;
  margin-bottom: 15px;
}

.modal-product-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 5px;
}

.modal-product-info {
  width: 100%;
}

.btn-wrapper {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: 15px;
}

.theme-btn-1, .theme-btn-2 {
  padding: 12px 15px;
  border-radius: 5px;
  text-decoration: none;
  color: white;
  font-weight: bold;
  text-align: center;
  width: 100%;
}

.theme-btn-1 {
  background-color: #007bff;
}

.theme-btn-2 {
  background-color: #28a745;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  background: none;
  border: none;
  cursor: pointer;
  color: #333;
}

.additional-info {
  margin-top: 20px;
  text-align: center;
}

.payment-method img {
  max-width: 100%;
  height: auto;
  margin-top: 10px;
}

@media (min-width: 768px) {
  .modal-content {
    max-width: 500px;
  }

  .modal-product-content {
    flex-direction: row;
    text-align: left;
  }

  .modal-product-img {
    margin-right: 20px;
    margin-bottom: 0;
  }

  .btn-wrapper {
    flex-direction: row;
  }

  .theme-btn-1, .theme-btn-2 {
    width: auto;
  }
}
</style>
