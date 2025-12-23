<template>
  <transition name="fade">
    <div v-if="visible" class="floating-results">
      <div class="results-container">
        <!-- Close Button -->
        <button @click="$emit('close')" class="close-btn" aria-label="Close search results">X</button>

        <!-- Display results -->
        <div v-if="formattedProducts.length">
          <div class="results-grid">
            <div v-for="product in formattedProducts" :key="product.product_code" class="result-card">
              <a :href="'/show/product/' + product.slug" class="result-link">
                <img :src="product.product_image" :alt="product.product_name" class="result-image" />
                <div class="result-details">
                  <div class="product-name">{{ product.product_name }}</div>
                  <div class="product-price">KES {{ product.selling_price }}.00</div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <!-- If no products found -->
        <div v-else class="no-results">
          <p>{{ results.message }}</p>
          <a :href="results.whatsappLink" class="whatsapp-link">Contact us on WhatsApp</a>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    results: Object,
    visible: Boolean
  },
  computed: {
    baseUrl() {
      return `${window.location.origin}/`; // Construct base URL
    },
    formattedProducts() {
      return this.results.products.map(product => {
        return {
          ...product,
          product_image: product.product_image.startsWith('http') 
            ? product.product_image 
            : this.baseUrl + product.product_image
        };
      });
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

.floating-results {
  font-family: 'Lato', sans-serif;
  position: fixed;
  top: 100px; /* Increased the top position to push it further below the search bar */
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  max-width: 900px;
  z-index: 1000;
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 20px;
  max-height: 80vh;
  overflow-y: auto;
}

@media (max-width: 768px) {
  .floating-results {
    top: 120px; /* Increased the top margin for mobile to ensure it stays below the search bar and keyboard */
    left: 0;
    right: 0;
    width: 100%;
    transform: none;
  }
}


.results-container {
  max-width: 900px;
  margin: 0 auto;
  padding-top: 20px;
}

/* Close Button Styling */
.close-btn {
  background: none;
  border: none;
  font-size: 18px;
  font-weight: bold;
  color: #e60023;
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  transition: color 0.2s;
}

.close-btn:hover {
  color: #000;
}

/* Fade transition */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

.results-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (min-width: 768px) {
  .results-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

.result-card {
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.result-card:hover {
  transform: scale(1.05);
}

.result-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.result-details {
  padding: 10px;
  text-align: center;
}

.product-name {
  font-weight: bold;
  font-size: 14px;
}

.product-price {
  color: #e60023;
  font-weight: bold;
}

.no-results {
  text-align: center;
  padding: 20px;
}

.whatsapp-link {
  color: #007bff;
  text-decoration: none;
  font-weight: bold;
  display: inline-block;
  margin-top: 10px;
  padding: 8px 16px;
  background-color: #25d366;
  color: white;
  border-radius: 5px;
}
</style>
