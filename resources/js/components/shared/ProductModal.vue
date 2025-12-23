<template>
  <div class="product-modal">
    <div class="modal-overlay" @click="closeModal"></div>
    <div class="modal-content">
      <button class="close-button" @click="closeModal">&times;</button>
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
            <p>{{ product.product_description }}</p>
          </div>
          <div class="product-actions">
            <button @click="addToCart" class="action-btn add-to-cart-btn">
              Add to Cart
            </button>
            <a :href="whatsappLink" target="_blank" class="action-btn whatsapp-btn">
              <i class="fab fa-whatsapp"></i> Buy on WhatsApp
            </a>
          </div>
          <div class="share-section">
            <span class="share-label">Share:</span>
            <div class="social-media-links">
              <a href="https://facebook.com" target="_blank" class="social-btn facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://twitter.com" target="_blank" class="social-btn twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://instagram.com" target="_blank" class="social-btn instagram">
                <i class="fab fa-instagram"></i>
              </a>
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
      required: true,
    },
  },
  computed: {
    whatsappLink() {
      const message = `Hi, I'm interested in buying ${this.product.product_name}`;
      return `https://wa.me/254710909198?text=${encodeURIComponent(message)}`;
    },
  },
  methods: {
    closeModal() {
      document.body.style.overflow = 'auto'; // Re-enable scrolling
      this.$emit('close');
    },
  },
  mounted() {
    document.body.style.overflow = 'hidden'; // Disable scrolling when modal opens
  },
  beforeDestroy() {
    document.body.style.overflow = 'auto'; // Re-enable scrolling when component is destroyed
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
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.action-btn {
  flex: 1;
  padding: 10px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s ease;
  border: none;
  color: white;
  white-space: nowrap;
  min-height: 40px;
}

.add-to-cart-btn {
  background-color: #4CAF50;
}

.add-to-cart-btn:hover {
  background-color: #45a049;
}

.add-to-cart-btn:active {
  background-color: #3e8e41;
}

.whatsapp-btn {
  background-color: #25D366;
}

.whatsapp-btn:hover {
  background-color: #128C7E;
}

.whatsapp-btn i {
  margin-right: 5px;
}

.share-section {
  margin-top: 20px;
  display: flex;
  align-items: center;
}

.share-label {
  margin-right: 10px;
  font-weight: bold;
}

.social-media-links {
  display: flex;
}

.social-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
  color: white;
  text-decoration: none;
  transition: opacity 0.3s ease;
}

.facebook {
  background-color: #3b5998;
}

.twitter {
  background-color: #1da1f2;
}

.instagram {
  background-color: #e1306c;
}

.social-btn:hover {
  opacity: 0.8;
}

/* Responsive styles for mobile devices */
@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    max-height: 95vh;
  }

  .product-actions {
    flex-direction: column;
  }

  .action-btn {
    width: 100%;
  }
}
</style>
