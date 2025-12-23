<template>
  <div class="product-modal">
    <div class="modal-overlay" @click="$emit('close')"></div>
    <div class="modal-content">
      <button class="close-button" @click="$emit('close')">&times;</button>
      <div class="product-details">
        <div class="product-image">
          <img :src="product.product_image" :alt="product.product_name" />
        </div>
        <div class="product-info">
          <h2>{{ product.product_name }}</h2>
          <div class="product-price">
            <span>Ksh {{ product.buying_price }}</span>
            <del v-if="product.selling_price">Ksh {{ product.selling_price }}</del>
          </div>
          <div class="product-description" v-if="product.description">
            <h3>Description:</h3>
            <p>{{ product.description }}</p>
          </div>
          <div class="product-actions">
            <button class="add-to-cart">Add to Cart</button>
            <button class="add-to-wishlist">Add to Wishlist</button>
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
      required: true,
    },
  },
};
</script>

<style scoped>
.product-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  max-width: 800px;
  width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  z-index: 1001;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  background: none;
  border: none;
  cursor: pointer;
}

.product-details {
  display: flex;
  gap: 20px;
}

.product-image {
  flex: 1;
}

.product-image img {
  max-width: 100%;
  height: auto;
}

.product-info {
  flex: 1;
}

.product-actions {
  margin-top: 20px;
}

.product-actions button {
  margin-right: 10px;
  padding: 10px 15px;
  cursor: pointer;
}
</style>
