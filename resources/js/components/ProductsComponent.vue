<template>
  <section class="products-section">
    <div class="container">
      <!-- Section Header -->
      <div class="section-header">
        <div class="header-content">
          <div class="title-block">
            <span class="header-badge">Latest Arrivals</span>
            <h2 class="section-title">Just In</h2>
            <p class="section-subtitle">Fresh electronics and smart devices</p>
          </div>
          <a href="/shop" class="view-all-btn">
            <span>View All Products</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="state-container">
        <div class="loading-spinner">
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <p>Loading products...</p>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="state-container">
        <div class="error-state">
          <i class="fas fa-exclamation-circle"></i>
          <p>{{ error }}</p>
          <button @click="fetchProducts" class="retry-btn">Try Again</button>
        </div>
      </div>

      <!-- Products Carousel -->
      <div v-else class="carousel-wrapper">
        <button 
          class="nav-arrow prev" 
          @click="slideLeft" 
          :disabled="isAtStart"
          aria-label="Previous products"
        >
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="products-carousel" ref="carousel">
          <div class="carousel-track" :style="{ transform: `translateX(-${scrollPosition}px)` }">
            <div 
              v-for="product in products" 
              :key="product.id" 
              class="product-card-wrapper"
            >
              <div class="product-card">
                <!-- Product Image -->
                <div class="product-image-container">
                  <a :href="'/show/product/' + product.slug" class="image-link">
                    <img 
                      :src="product.product_image" 
                      :alt="product.product_name" 
                      class="product-img"
                      loading="lazy"
                    />
                  </a>
                  <span class="status-badge">
                    <i class="fas fa-star"></i>
                    New
                  </span>
                  
                  <!-- Product Actions -->
                  <div class="product-actions">
                    <button 
                      @click.prevent="openQuickView(product)" 
                      class="action-btn"
                      title="Quick View"
                    >
                      <i class="far fa-eye"></i>
                    </button>
                    <button 
                      @click.prevent="handleAddToCart(product)" 
                      class="action-btn primary"
                      title="Add to Cart"
                    >
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                    <button class="action-btn" title="Add to Wishlist">
                      <i class="far fa-heart"></i>
                    </button>
                  </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                  <h3 class="product-title">
                    <a :href="'/show/product/' + product.slug">{{ product.product_name }}</a>
                  </h3>
                  <div class="product-footer">
                    <p class="product-price">
                      <span class="currency">Ksh</span>
                      <span class="amount">{{ formatPrice(product.selling_price) }}</span>
                    </p>
                    <button 
                      @click.prevent="handleAddToCart(product)" 
                      class="quick-add-btn"
                      title="Quick Add"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button 
          class="nav-arrow next" 
          @click="slideRight" 
          :disabled="isAtEnd"
          aria-label="Next products"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Empty State -->
      <div v-if="!loading && !error && products.length === 0" class="state-container">
        <div class="empty-state">
          <i class="fas fa-box-open"></i>
          <h3>No Products Available</h3>
          <p>Check back soon for new medical equipment and supplies.</p>
        </div>
      </div>

      <!-- Scroll Indicators -->
      <div v-if="products.length > 0 && !loading && !error" class="scroll-indicators">
        <div 
          v-for="(indicator, index) in totalPages" 
          :key="index"
          :class="['indicator', { active: currentPage === index }]"
          @click="goToPage(index)"
        ></div>
      </div>
    </div>

    <!-- Modals -->
    <ProductModal 
      v-if="selectedProduct" 
      :product="selectedProduct" 
      @close="closeQuickView" 
    />
    <AddToCartModal 
      v-if="showAddToCartModal && productToAddToCart" 
      :product="productToAddToCart" 
      @close="closeAddToCartModal" 
    />
  </section>
</template>

<script>
import axios from 'axios';
import { useCartStore } from '../store/cart';
import ProductModal from './shared/ProductModal.vue';
import AddToCartModal from './shared/AddToCartModal.vue';

export default {
  components: {
    ProductModal,
    AddToCartModal
  },
  data() {
    return {
      products: [],
      selectedProduct: null,
      productToAddToCart: null,
      showAddToCartModal: false,
      loading: true,
      error: null,
      scrollPosition: 0,
      cardWidth: 300,
      gap: 24,
      cardsPerView: 4
    };
  },
  computed: {
    isAtStart() {
      return this.scrollPosition <= 0;
    },
    isAtEnd() {
      const maxScroll = (this.products.length - this.cardsPerView) * (this.cardWidth + this.gap);
      return this.scrollPosition >= maxScroll;
    },
    totalPages() {
      return Math.ceil(this.products.length / this.cardsPerView);
    },
    currentPage() {
      return Math.floor(this.scrollPosition / ((this.cardWidth + this.gap) * this.cardsPerView));
    }
  },
  methods: {
    async fetchProducts() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('/api/wabegadgets/products');
        if (response.data.status === 200 && response.data.products.data) {
          this.products = this.shuffleArray(response.data.products.data);
        } else {
          this.error = 'Invalid data structure received from server';
        }
      } catch (error) {
        this.error = 'Failed to load products. Please try again later.';
        console.error('Error fetching products:', error);
      } finally {
        this.loading = false;
      }
    },
    shuffleArray(array) {
      return array.sort(() => Math.random() - 0.5);
    },
    updateCardsPerView() {
      const width = window.innerWidth;
      if (width < 640) {
        this.cardsPerView = 1;
        this.cardWidth = 280;
      } else if (width < 768) {
        this.cardsPerView = 2;
        this.cardWidth = 280;
      } else if (width < 1024) {
        this.cardsPerView = 3;
        this.cardWidth = 280;
      } else {
        this.cardsPerView = 4;
        this.cardWidth = 300;
      }
    },
    slideLeft() {
      const slideAmount = (this.cardWidth + this.gap) * this.cardsPerView;
      this.scrollPosition = Math.max(0, this.scrollPosition - slideAmount);
    },
    slideRight() {
      const slideAmount = (this.cardWidth + this.gap) * this.cardsPerView;
      const maxScroll = (this.products.length - this.cardsPerView) * (this.cardWidth + this.gap);
      this.scrollPosition = Math.min(maxScroll, this.scrollPosition + slideAmount);
    },
    goToPage(pageIndex) {
      this.scrollPosition = pageIndex * (this.cardWidth + this.gap) * this.cardsPerView;
    },
    formatPrice(price) {
      return parseFloat(price).toLocaleString('en-KE', { 
        minimumFractionDigits: 2,
        maximumFractionDigits: 2 
      });
    },
    openQuickView(product) {
      if (product) {
        this.selectedProduct = product;
        this.showAddToCartModal = false;
      }
    },
    closeQuickView() {
      this.selectedProduct = null;
    },
    handleAddToCart(product) {
      if (product) {
        const cartStore = useCartStore();
        const cartItem = {
          id: product.id,
          product_name: product.product_name,
          selling_price: product.selling_price,
          product_image: product.product_image,
          quantity: 1,
          slug: product.slug
        };
        cartStore.addToCart(cartItem);
        this.productToAddToCart = product;
        this.showAddToCartModal = true;
        this.closeQuickView();
      }
    },
    closeAddToCartModal() {
      this.showAddToCartModal = false;
      this.productToAddToCart = null;
    }
  },
  mounted() {
    this.updateCardsPerView();
    this.fetchProducts();
    window.addEventListener('resize', this.updateCardsPerView);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateCardsPerView);
  }
};
</script>

<style scoped>
.products-section {
  padding: 80px 0;
  background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
  position: relative;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* Section Header */
.section-header {
  margin-bottom: 48px;
  animation: fadeInDown 0.6s ease-out;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 24px;
}

.title-block {
  flex: 1;
}

.header-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 16px;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.1) 0%, rgba(6, 64, 43, 0.1) 100%);
  color: #0a609d;
  font-size: 0.875rem;
  font-weight: 600;
  border-radius: 20px;
  margin-bottom: 12px;
  border: 1px solid rgba(10, 154, 115, 0.2);
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #084c74;
  margin: 0 0 8px 0;
  letter-spacing: -0.02em;
}

.section-subtitle {
  color: #6b7280;
  font-size: 1.125rem;
  margin: 0;
}

.view-all-btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 14px 28px;
  background: white;
  color: #0a609d;
  font-weight: 600;
  border: 2px solid #0a609d;
  border-radius: 12px;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 8px rgba(10, 154, 115, 0.1);
}

.view-all-btn:hover {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(10, 154, 115, 0.2);
}

.view-all-btn i {
  transition: transform 0.3s ease;
}

.view-all-btn:hover i {
  transform: translateX(4px);
}

/* Carousel */
.carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  gap: 24px;
}

.products-carousel {
  overflow: hidden;
  width: 100%;
}

.carousel-track {
  display: flex;
  gap: 24px;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card-wrapper {
  flex: 0 0 300px;
  animation: fadeInUp 0.6s ease-out;
  animation-fill-mode: both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.product-card-wrapper:nth-child(1) { animation-delay: 0.1s; }
.product-card-wrapper:nth-child(2) { animation-delay: 0.2s; }
.product-card-wrapper:nth-child(3) { animation-delay: 0.3s; }
.product-card-wrapper:nth-child(4) { animation-delay: 0.4s; }

.product-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(10, 154, 115, 0.08);
  height: 100%;
  display: flex;
  flex-direction: column;
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 25px rgba(10, 154, 115, 0.15);
  border-color: rgba(10, 154, 115, 0.2);
}

/* Product Image */
.product-image-container {
  position: relative;
  height: 280px;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.02) 0%, rgba(6, 64, 43, 0.03) 100%);
  overflow: hidden;
}

.image-link {
  display: block;
  width: 100%;
  height: 100%;
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 24px;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover .product-img {
  transform: scale(1.05);
}

.status-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.3);
  z-index: 2;
}

.status-badge i {
  font-size: 0.625rem;
}

/* Product Actions */
.product-actions {
  position: absolute;
  right: 16px;
  top: 16px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  opacity: 0;
  transform: translateX(20px);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 2;
}

.product-card:hover .product-actions {
  opacity: 1;
  transform: translateX(0);
}

.action-btn {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: white;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #374151;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

.action-btn:hover {
  background: #f3f4f6;
  transform: scale(1.1);
}

.action-btn.primary:hover {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
}

/* Product Info */
.product-info {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex: 1;
}

.product-title {
  font-size: 1.0625rem;
  font-weight: 600;
  color: #1f2937;
  margin: 0;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.8em;
}

.product-title a {
  color: inherit;
  text-decoration: none;
  transition: color 0.3s ease;
}

.product-title a:hover {
  color: #0a609d;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
  padding-top: 12px;
  border-top: 1px solid #f3f4f6;
}

.product-price {
  display: flex;
  align-items: baseline;
  gap: 4px;
  margin: 0;
}

.currency {
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
}

.amount {
  font-size: 1.5rem;
  font-weight: 700;
  color: #0a609d;
}

.quick-add-btn {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
}

.quick-add-btn:hover {
  transform: scale(1.1) rotate(90deg);
  box-shadow: 0 6px 16px rgba(10, 154, 115, 0.3);
}

/* Navigation Arrows */
.nav-arrow {
  flex: 0 0 52px;
  height: 52px;
  border-radius: 50%;
  border: 2px solid rgba(10, 154, 115, 0.2);
  background: white;
  color: #0a609d;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.1);
}

.nav-arrow:hover:not(:disabled) {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border-color: transparent;
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(10, 154, 115, 0.25);
}

.nav-arrow:active:not(:disabled) {
  transform: scale(0.95);
}

.nav-arrow:disabled {
  opacity: 0.3;
  cursor: not-allowed;
  border-color: rgba(0, 0, 0, 0.1);
}

/* Scroll Indicators */
.scroll-indicators {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 40px;
}

.indicator {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #d1d5db;
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator:hover {
  background: #9ca3af;
  transform: scale(1.3);
}

.indicator.active {
  width: 32px;
  border-radius: 4px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
}

/* States */
.state-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 400px;
  padding: 60px 20px;
}

.loading-spinner {
  text-align: center;
}

.spinner-ring {
  width: 60px;
  height: 60px;
  margin: 0 auto 20px;
  border: 4px solid rgba(10, 154, 115, 0.1);
  border-top-color: #0a609d;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.spinner-ring:nth-child(2) {
  width: 50px;
  height: 50px;
  margin-top: -55px;
  border-top-color: #084c74;
  animation-delay: -0.3s;
}

.spinner-ring:nth-child(3) {
  width: 40px;
  height: 40px;
  margin-top: -50px;
  border-top-color: #0a609d;
  animation-delay: -0.6s;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.loading-spinner p {
  color: #6b7280;
  font-size: 1rem;
  margin-top: 20px;
}

.error-state,
.empty-state {
  text-align: center;
  max-width: 400px;
}

.error-state i,
.empty-state i {
  font-size: 4rem;
  color: #ef4444;
  margin-bottom: 20px;
}

.empty-state i {
  color: #9ca3af;
}

.error-state p,
.empty-state p {
  color: #6b7280;
  font-size: 1.125rem;
  margin: 12px 0;
}

.empty-state h3 {
  color: #374151;
  font-size: 1.5rem;
  margin: 0 0 12px 0;
}

.retry-btn {
  margin-top: 20px;
  padding: 12px 24px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.retry-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(10, 154, 115, 0.3);
}

/* Responsive */
@media (max-width: 1024px) {
  .section-title {
    font-size: 2rem;
  }
  
  .product-card-wrapper {
    flex: 0 0 280px;
  }
}

@media (max-width: 768px) {
  .products-section {
    padding: 60px 0;
  }
  
  .header-content {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .section-subtitle {
    font-size: 1rem;
  }
  
  .view-all-btn {
    width: 100%;
    justify-content: center;
  }
  
  .carousel-wrapper {
    gap: 12px;
  }
  
  .nav-arrow {
    flex: 0 0 44px;
    height: 44px;
    font-size: 1rem;
  }
}

@media (max-width: 640px) {
  .container {
    padding: 0 16px;
  }
  
  .nav-arrow {
    display: none;
  }
  
  .carousel-wrapper {
    gap: 0;
  }
  
  .section-header {
    margin-bottom: 32px;
  }
}
</style>