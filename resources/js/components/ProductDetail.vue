<template>
  <main v-if="product" class="product-detail">
    <!-- Breadcrumb -->
    <div class="breadcrumb-area">
      <div class="container">
        <div class="breadcrumb-content">
          <div class="breadcrumb-header">
            <span class="product-badge">
              <i class="fas fa-heartbeat"></i>
              Electronics, Security & Smart Devices
            </span>
            <h1 class="page-title">{{ product.product_name }}</h1>
          </div>
          <nav class="breadcrumb-nav">
            <a href="/" class="home-link">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <i class="fas fa-chevron-right separator"></i>
            <a href="/shop" class="nav-link">Shop</a>
            <i class="fas fa-chevron-right separator"></i>
            <span class="current">{{ getCategoryName }}</span>
          </nav>
        </div>
      </div>
    </div>

    <!-- Product Details Area -->
    <div class="product-details-area">
      <div class="container">
        <div class="product-details-grid">
          <!-- Product Images -->
          <div class="product-images">
            
            <div class="main-image" @click="openImageModal">
              <img 
                :src="getImageUrl(currentMainImage)" 
                :alt="product.product_name" 
                class="primary-image"
              >
              <div class="zoom-hint">
                <i class="fas fa-search-plus"></i>
                Click to enlarge
              </div>
            </div>
            <div class="thumbnail-images" v-if="allProductImages.length > 1">
              <img 
                v-for="(image, index) in allProductImages" 
                :key="index"
                :src="getImageUrl(image.filename)" 
                :alt="`${product.product_name} - Image ${index + 1}`" 
                class="thumbnail"
                :class="{ active: index === currentImageIndex }"
                @click="setMainImage(index)"
              >
            </div>
          </div>

          <!-- Product Info -->
          <div class="product-info">
            <div class="product-header">
              <h2 class="product-title">{{ product.product_name }}</h2>
              
              <div class="product-meta-row">
                <div class="product-rating">
                  <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <span class="rating-text">4.5 (128 reviews)</span>
                </div>
                
                <div class="product-category" v-if="product.category">
                  <i class="fas fa-tag"></i>
                  <a :href="`/category/${product.category.slug}`" class="category-link">
                    {{ product.category.category_name }}
                  </a>
                </div>
              </div>
            </div>

            <div class="product-price-section">
              <div class="price-main">
                <span class="currency">Ksh</span>
                <span class="amount">{{ formatPrice(product.selling_price) }}</span>
              </div>
              <div class="price-note">
                <i class="fas fa-info-circle"></i>
                Free shipping on orders over Ksh 10,000
              </div>
            </div>

            <div class="product-highlights">
              <div class="highlight-item">
                <i class="fas fa-check-circle"></i>
                <span>ISO Certified</span>
              </div>
              <div class="highlight-item">
                <i class="fas fa-shield-alt"></i>
                <span>1 Year Warranty</span>
              </div>
              <div class="highlight-item">
                <i class="fas fa-truck"></i>
                <span>Fast Delivery</span>
              </div>
              <div class="highlight-item">
                <i class="fas fa-headset"></i>
                <span>24/7 Support</span>
              </div>
            </div>

            <div class="product-actions">
              <CheckOutButton 
                :product-id="product.id"
                :product-name="product.product_name" 
                :selling-price="product.selling_price"
              />
            
            </div>

            <div class="product-contact">
              <div class="contact-info">
                <i class="fas fa-phone"></i>
                <div class="contact-details">
                  <span class="contact-label">Need Help?</span>
                  <a href="tel:+254710909198" class="contact-value">+254 710 909 198</a>
                </div>
              </div>
              <div class="contact-info">
                <i class="fas fa-envelope"></i>
                <div class="contact-details">
                  <span class="contact-label">Email Us</span>
                  <a href="mailto:info@wabegadgets.co.ke" class="contact-value">info@wabegadgets.co.ke</a>
                </div>
              </div>
            </div>

            <div class="product-share">
              <span class="share-label">
                <i class="fas fa-share-alt"></i>
                Share Product:
              </span>
              <div class="social-links">
                <a href="#" class="social-link facebook" title="Share on Facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link twitter" title="Share on Twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link linkedin" title="Share on LinkedIn">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="social-link whatsapp" title="Share on WhatsApp">
                  <i class="fab fa-whatsapp"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-tabs">
          <div class="tabs-navigation">
            <button 
              @click="activeTab = 'description'"
              :class="['tab-button', { active: activeTab === 'description' }]"
            >
              <i class="fas fa-file-alt"></i>
              Description
            </button>
            <button 
              @click="activeTab = 'features'"
              :class="['tab-button', { active: activeTab === 'features' }]"
            >
              <i class="fas fa-list-ul"></i>
              Features & Specs
            </button>
            <button 
              @click="activeTab = 'shipping'"
              :class="['tab-button', { active: activeTab === 'shipping' }]"
            >
              <i class="fas fa-shipping-fast"></i>
              Shipping Info
            </button>
          </div>

          <div class="tabs-content">
            <div v-show="activeTab === 'description'" class="tab-panel">
              <div class="content-header">
                <h3>Product Description</h3>
              </div>
              <div v-html="product.product_description || 'No description available'" class="content"></div>
            </div>
            
            <div v-show="activeTab === 'features'" class="tab-panel">
              <div class="content-header">
                <h3>Features & Specifications</h3>
              </div>
              <div v-html="product.product_features || 'No features listed'" class="content"></div>
            </div>
            
            <div v-show="activeTab === 'shipping'" class="tab-panel">
              <div class="content-header">
                <h3>Shipping & Delivery</h3>
              </div>
              <div class="shipping-info">
                <div class="shipping-item">
                  <i class="fas fa-map-marker-alt"></i>
                  <div>
                    <strong>Delivery Areas</strong>
                    <p>Nairobi (1-2 days), Kenya nationwide (2-5 days), East Africa (5-10 days)</p>
                  </div>
                </div>
                <div class="shipping-item">
                  <i class="fas fa-box"></i>
                  <div>
                    <strong>Packaging</strong>
                    <p>Secure medical-grade packaging with protective materials</p>
                  </div>
                </div>
                <div class="shipping-item">
                  <i class="fas fa-shield-check"></i>
                  <div>
                    <strong>Handling</strong>
                    <p>Special care for medical equipment, temperature-controlled when required</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Related Products -->
        <div class="related-products" v-if="hotProducts.length">
          <div class="section-header">
            <h3 class="section-title">
              <i class="fas fa-star"></i>
              You May Also Like
            </h3>
            <p class="section-subtitle">Similar medical equipment and supplies</p>
          </div>
          
          <div class="carousel-container">
            <div class="products-grid" :style="{ transform: `translateX(-${currentPage * 100}%)` }">
              <div v-for="product in hotProducts" :key="product.id" class="product-card">
                <div class="card-badge">New</div>
                <div class="product-image">
                  <a :href="'/show/product/' + product.slug">
                    <img :src="getImageUrl(product.product_image)" :alt="product.product_name">
                  </a>
                </div>
                <div class="product-content">
                  <h4 class="product-name">
                    <a :href="'/show/product/' + product.slug">{{ product.product_name }}</a>
                  </h4>
                  <div class="product-price">
                    <span class="price-label">Ksh</span>
                    <span class="price-value">{{ formatPrice(product.selling_price) }}</span>
                  </div>
                  <a :href="'/show/product/' + product.slug" class="view-product">
                    View Details
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <button 
              @click="prevPage" 
              class="nav-btn prev" 
              :disabled="currentPage === 0"
              aria-label="Previous"
            >
              <i class="fas fa-chevron-left"></i>
            </button>
            
            <button 
              @click="nextPage" 
              class="nav-btn next" 
              :disabled="currentPage >= maxPages"
              aria-label="Next"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Image Modal -->
    <div v-if="showImageModal" class="image-modal" @click="closeImageModal">
      <div class="modal-content" @click.stop>
        <button class="close-modal" @click="closeImageModal">
          <i class="fas fa-times"></i>
        </button>
        <div class="modal-image-container">
          <img :src="getImageUrl(currentMainImage)" :alt="product.product_name" class="modal-image">
        </div>
        <div class="modal-thumbnails" v-if="allProductImages.length > 1">
          <img 
            v-for="(image, index) in allProductImages" 
            :key="index"
            :src="getImageUrl(image.filename)" 
            :alt="`${product.product_name} - Image ${index + 1}`" 
            class="modal-thumbnail"
            :class="{ active: index === currentImageIndex }"
            @click="setMainImage(index)"
          >
        </div>
      </div>
    </div>
  </main>
  
  <div v-else class="loading-container">
    <div class="loading-spinner">
      <div class="spinner-ring"></div>
      <div class="spinner-ring"></div>
      <div class="spinner-ring"></div>
      <p>Loading product details...</p>
    </div>
  </div>
</template>

<script>
import CheckOutButton from './CheckOutButtonComponent.vue'

export default {
  name: 'ProductDetail',
  components: {
    CheckOutButton
  },
  props: {
    product: {
      type: Object,
      required: true,
      default: () => ({})
    },
    hotProducts: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      activeTab: 'description',
      currentPage: 0,
      showImageModal: false,
      currentMainImage: '',
      currentImageIndex: 0,
      allProductImages: []
    }
  },
  computed: {
    getCategoryName() {
      if (this.product && this.product.category && this.product.category.category_name) {
        return this.product.category.category_name;
      }
      return 'Uncategorized';
    },
    maxPages() {
      return Math.ceil(this.hotProducts.length / 4) - 1;
    }
  },
  methods: {
    getImageUrl(path) {
      if (path && (path.startsWith('http://') || path.startsWith('https://'))) {
        return path;
      }
      if (!path) {
        return '/front-assets/img/brand-logo/logo.png';
      }
      
      const cleanPath = path.startsWith('/') ? path.substring(1) : path;
      
      if (cleanPath.includes('.jpg') || cleanPath.includes('.jpeg') || cleanPath.includes('.png') || cleanPath.includes('.gif')) {
        if (!cleanPath.includes('/')) {
          return `/upload/product/${cleanPath}`;
        }
        return `/${cleanPath}`;
      }
      
      return `/${cleanPath}`;
    },
    formatPrice(price) {
      return parseFloat(price).toLocaleString('en-KE', { 
        minimumFractionDigits: 2,
        maximumFractionDigits: 2 
      });
    },
    prevPage() {
      if (this.currentPage > 0) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.maxPages) {
        this.currentPage++;
      }
    },
    startAutoplay() {
      this.autoplayInterval = setInterval(() => {
        if (this.currentPage < this.maxPages) {
          this.currentPage++;
        } else {
          this.currentPage = 0;
        }
      }, 5000);
    },
    openImageModal() {
      this.showImageModal = true;
    },
    closeImageModal() {
      this.showImageModal = false;
    },
    setMainImage(index) {
      if (index >= 0 && this.allProductImages[index]) {
        this.currentMainImage = this.getImageUrl(this.allProductImages[index].filename);
        this.currentImageIndex = index;
      }
    },
    initializeProductImages() {
      this.allProductImages = this.product.images || [];
      
      if (this.product.product_image) {
        this.currentMainImage = this.getImageUrl(this.product.product_image);
        this.currentImageIndex = -1;
      } else {
        this.currentMainImage = '/front-assets/img/brand-logo/logo.png';
        this.currentImageIndex = -1;
      }
    }
  },
  mounted() {
    this.initializeProductImages();
    this.startAutoplay();
  },
  watch: {
    product: {
      handler() {
        this.initializeProductImages();
      },
      deep: true,
      immediate: true
    }
  },
  beforeUnmount() {
    if (this.autoplayInterval) {
      clearInterval(this.autoplayInterval);
    }
  }
}
</script>

<style scoped>
.product-detail {
  background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
  min-height: 100vh;
}

/* Breadcrumb */
.breadcrumb-area {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  padding: 32px 0;
  margin-bottom: 48px;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

.breadcrumb-content {
  color: white;
}

.breadcrumb-header {
  margin-bottom: 16px;
}

.product-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 16px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 12px;
}

.page-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0;
  letter-spacing: -0.02em;
}

.breadcrumb-nav {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 0.9375rem;
}

.home-link,
.nav-link {
  color: rgba(255, 255, 255, 0.9);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color 0.3s ease;
}

.home-link:hover,
.nav-link:hover {
  color: white;
}

.separator {
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.75rem;
}

.current {
  color: white;
  font-weight: 600;
}

/* Product Details */
.product-details-area {
  padding: 0 0 80px;
}

.product-details-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  margin-bottom: 64px;
}

/* Product Images */
.product-images {
  background: white;
  padding: 32px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  position: relative;
}

.image-badge {
  position: absolute;
  top: 24px;
  left: 24px;
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  z-index: 2;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.3);
}

.main-image {
  width: 100%;
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 20px;
  position: relative;
  cursor: zoom-in;
  transition: all 0.3s ease;
}

.main-image:hover {
  transform: scale(1.02);
}

.main-image:hover .zoom-hint {
  opacity: 1;
}

.primary-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 24px;
}

.zoom-hint {
  position: absolute;
  bottom: 16px;
  right: 16px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border-radius: 20px;
  font-size: 0.875rem;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.thumbnail-images {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  padding: 8px 0;
}

.thumbnail {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 12px;
  cursor: pointer;
  border: 3px solid transparent;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.thumbnail:hover {
  border-color: #0a609d;
  transform: scale(1.05);
}

.thumbnail.active {
  border-color: #0a609d;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.3);
}

/* Product Info */
.product-info {
  background: white;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
}

.product-header {
  margin-bottom: 32px;
  padding-bottom: 24px;
  border-bottom: 2px solid #f3f4f6;
}

.product-title {
  font-size: 2rem;
  font-weight: 700;
  color: #111827;
  margin: 0 0 20px 0;
  line-height: 1.3;
}

.product-meta-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
}

.product-rating {
  display: flex;
  align-items: center;
  gap: 12px;
}

.stars {
  color: #fbbf24;
  font-size: 1.125rem;
}

.rating-text {
  color: #6b7280;
  font-size: 0.875rem;
}

.product-category {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #6b7280;
  font-size: 0.875rem;
}

.product-category i {
  color: #0a609d;
}

.category-link {
  color: #0a609d;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.category-link:hover {
  color: #084c74;
}

.product-price-section {
  margin-bottom: 32px;
  padding: 24px;
  background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
  border-radius: 16px;
  border: 2px solid #87CEFA;
}

.price-main {
  display: flex;
  align-items: baseline;
  gap: 8px;
  margin-bottom: 8px;
}

.currency {
  font-size: 1.25rem;
  color: #2ea5dd;
  font-weight: 600;
}

.amount {
  font-size: 2.5rem;
  font-weight: 700;
  color: #0a609d;
}

.price-note {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #0b4d70;
  font-size: 0.875rem;
}

.price-note i {
  color: #10b981;
}

.product-highlights {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-bottom: 32px;
}

.highlight-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px;
  background: #f9fafb;
  border-radius: 10px;
  font-size: 0.875rem;
  font-weight: 500;
  color: #374151;
}

.highlight-item i {
  color: #0a609d;
  font-size: 1.125rem;
}

.product-actions {
  display: flex;
  gap: 16px;
  margin-bottom: 32px;
}

.secondary-button {
  flex: 1;
  padding: 16px 24px;
  background: white;
  color: #374151;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.secondary-button:hover {
  border-color: #0a609d;
  color: #0a609d;
  background: #f0fdf4;
}

.product-contact {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-bottom: 32px;
  padding: 20px;
  background: #eff6ff;
  border-radius: 12px;
}

.contact-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.contact-info i {
  font-size: 1.5rem;
  color: #3b82f6;
}

.contact-details {
  display: flex;
  flex-direction: column;
}

.contact-label {
  font-size: 0.75rem;
  color: #6b7280;
  margin-bottom: 2px;
}

.contact-value {
  font-weight: 600;
  color: #1e40af;
  text-decoration: none;
}

.contact-value:hover {
  text-decoration: underline;
}

.product-share {
  display: flex;
  align-items: center;
  gap: 16px;
  padding-top: 24px;
  border-top: 2px solid #f3f4f6;
}

.share-label {
  color: #6b7280;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
}

.social-links {
  display: flex;
  gap: 12px;
}

.social-link {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  color: white;
  transition: all 0.3s ease;
  text-decoration: none;
}

.social-link:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.social-link.facebook {
  background: #1877f2;
}

.social-link.twitter {
  background: #1da1f2;
}

.social-link.linkedin {
  background: #0077b5;
}

.social-link.whatsapp {
  background: #25d366;
}

/* Product Tabs */
.product-tabs {
  background: white;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  margin-bottom: 64px;
  overflow: hidden;
}

.tabs-navigation {
  display: flex;
  gap: 0;
  background: #f9fafb;
  border-bottom: 2px solid #e5e7eb;
}

.tab-button {
  flex: 1;
  padding: 20px 24px;
  background: transparent;
  border: none;
  color: #6b7280;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  position: relative;
}

.tab-button::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 3px;
  background: transparent;
  transition: background 0.3s ease;
}

.tab-button:hover {
  color: #0a609d;
  background: rgba(10, 154, 115, 0.05);
}

.tab-button.active {
  color: #0a609d;
  background: white;
}

.tab-button.active::after {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
}

.tab-panel {
  padding: 40px;
}

.content-header {
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 2px solid #f3f4f6;
}

.content-header h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #111827;
  margin: 0;
}

.content {
  color: #4b5563;
  line-height: 1.8;
}

.shipping-info {
display: flex;
flex-direction: column;
gap: 20px;
}
.shipping-item {
display: flex;
gap: 16px;
padding: 20px;
background: #f9fafb;
border-radius: 12px;
}
.shipping-item i {
font-size: 1.5rem;
color: #0a609d;
flex-shrink: 0;
margin-top: 4px;
}
.shipping-item strong {
display: block;
color: #111827;
margin-bottom: 6px;
font-size: 1.0625rem;
}
.shipping-item p {
color: #6b7280;
margin: 0;
line-height: 1.6;
}
/* Related Products */
.related-products {
padding: 64px 0;
background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
border-radius: 20px;
margin: -32px -24px 0;
padding: 64px 24px;
}
.section-header {
text-align: center;
margin-bottom: 40px;
}
.section-title {
font-size: 2rem;
font-weight: 700;
color: #111827;
margin: 0 0 8px 0;
display: flex;
align-items: center;
justify-content: center;
gap: 12px;
}
.section-title i {
color: #fbbf24;
}
.section-subtitle {
color: #6b7280;
font-size: 1rem;
margin: 0;
}
.carousel-container {
position: relative;
overflow: hidden;
padding: 20px 0;
}
.products-grid {
display: flex;
transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
gap: 24px;
}
.product-card {
flex: 0 0 calc(25% - 18px);
max-width: calc(25% - 18px);
background: white;
border-radius: 16px;
overflow: hidden;
transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
border: 1px solid #e5e7eb;
position: relative;
}
.product-card:hover {
transform: translateY(-8px);
box-shadow: 0 12px 24px rgba(10, 154, 115, 0.15);
border-color: #0a609d;
}
.card-badge {
position: absolute;
top: 12px;
left: 12px;
padding: 6px 12px;
background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
color: white;
border-radius: 20px;
font-size: 0.75rem;
font-weight: 600;
z-index: 2;
}
.product-image {
height: 200px;
background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
display: flex;
align-items: center;
justify-content: center;
overflow: hidden;
}
.product-image a {
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
}
.product-image img {
width: 100%;
height: 100%;
object-fit: contain;
padding: 16px;
transition: transform 0.6s ease;
}
.product-card:hover .product-image img {
transform: scale(1.1);
}
.product-content {
padding: 20px;
}
.product-name {
margin: 0 0 12px 0;
font-size: 0.9375rem;
font-weight: 600;
line-height: 1.4;
}
.product-name a {
color: #111827;
text-decoration: none;
display: -webkit-box;
-webkit-line-clamp: 2;
-webkit-box-orient: vertical;
overflow: hidden;
transition: color 0.3s ease;
}
.product-name a:hover {
color: #0a609d;
}
.product-price {
display: flex;
align-items: baseline;
gap: 4px;
margin-bottom: 12px;
}
.price-label {
font-size: 0.875rem;
color: #6b7280;
font-weight: 500;
}
.price-value {
font-size: 1.25rem;
font-weight: 700;
color: #0a609d;
}
.view-product {
display: inline-flex;
align-items: center;
gap: 6px;
padding: 8px 16px;
background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
color: #0a609d;
border-radius: 8px;
text-decoration: none;
font-size: 0.875rem;
font-weight: 600;
transition: all 0.3s ease;
}
.view-product:hover {
background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
color: white;
transform: translateX(4px);
}
.nav-btn {
position: absolute;
top: 50%;
transform: translateY(-50%);
width: 48px;
height: 48px;
border-radius: 50%;
background: white;
border: 2px solid #0a609d;
color: #0a609d;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
transition: all 0.3s ease;
box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
z-index: 2;
}
.nav-btn.prev {
left: -24px;
}
.nav-btn.next {
right: -24px;
}
.nav-btn:hover:not(:disabled) {
background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
color: white;
transform: translateY(-50%) scale(1.1);
}
.nav-btn:disabled {
opacity: 0.3;
cursor: not-allowed;
border-color: #e5e7eb;
color: #9ca3af;
}
/* Image Modal */
.image-modal {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.9);
display: flex;
justify-content: center;
align-items: center;
z-index: 1000;
padding: 20px;
animation: fadeIn 0.3s ease;
}
@keyframes fadeIn {
from { opacity: 0; }
to { opacity: 1; }
}
.modal-content {
background: white;
border-radius: 20px;
box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
position: relative;
max-width: 90vw;
max-height: 90vh;
display: flex;
flex-direction: column;
animation: slideUp 0.4s ease;
}
@keyframes slideUp {
from {
opacity: 0;
transform: translateY(30px);
}
to {
opacity: 1;
transform: translateY(0);
}
}
.close-modal {
position: absolute;
top: 16px;
right: 16px;
width: 40px;
height: 40px;
background: rgba(0, 0, 0, 0.5);
border: none;
border-radius: 50%;
color: white;
font-size: 1.5rem;
cursor: pointer;
transition: all 0.3s ease;
z-index: 3;
display: flex;
align-items: center;
justify-content: center;
}
.close-modal:hover {
background: #ef4444;
transform: rotate(90deg);
}
.modal-image-container {
width: 100%;
height: 70vh;
display: flex;
align-items: center;
justify-content: center;
background: #f9fafb;
border-radius: 20px 20px 0 0;
padding: 32px;
}
.modal-image {
max-width: 100%;
max-height: 100%;
object-fit: contain;
}
.modal-thumbnails {
display: flex;
justify-content: center;
gap: 12px;
padding: 20px;
background: white;
border-radius: 0 0 20px 20px;
border-top: 2px solid #f3f4f6;
overflow-x: auto;
}
.modal-thumbnail {
width: 80px;
height: 80px;
object-fit: cover;
border-radius: 12px;
cursor: pointer;
border: 3px solid transparent;
transition: all 0.3s ease;
flex-shrink: 0;
}
.modal-thumbnail:hover {
border-color: #0a609d;
transform: scale(1.05);
}
.modal-thumbnail.active {
border-color: #0a609d;
box-shadow: 0 4px 12px rgba(10, 154, 115, 0.3);
}
/* Loading State */
.loading-container {
display: flex;
justify-content: center;
align-items: center;
min-height: 100vh;
background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
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
/* Responsive */
@media (max-width: 1024px) {
.product-details-grid {
grid-template-columns: 1fr;
gap: 32px;
}
.product-card {
flex: 0 0 calc(33.333% - 16px);
max-width: calc(33.333% - 16px);
}
.product-highlights {
grid-template-columns: 1fr;
}
.product-contact {
grid-template-columns: 1fr;
}
}
@media (max-width: 768px) {
.page-title {
font-size: 1.75rem;
}
.breadcrumb-nav {
font-size: 0.875rem;
}
.product-title {
font-size: 1.5rem;
}
.amount {
font-size: 2rem;
}
.product-actions {
flex-direction: column;
}
.tabs-navigation {
flex-direction: column;
}
.product-card {
flex: 0 0 calc(50% - 12px);
max-width: calc(50% - 12px);
}
.nav-btn.prev {
left: 8px;
}
.nav-btn.next {
right: 8px;
}
.modal-image-container {
height: 50vh;
}
.modal-thumbnail {
width: 60px;
height: 60px;
}
}
@media (max-width: 480px) {
.container {
padding: 0 16px;
}
.product-images,
.product-info {
padding: 20px;
}
.main-image {
height: 300px;
}
.thumbnail {
width: 70px;
height: 70px;
}
.product-card {
flex: 0 0 100%;
max-width: 100%;
}
.product-meta-row {
flex-direction: column;
align-items: flex-start;
}
}


</style>