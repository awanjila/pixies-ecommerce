<template>
  <section class="brand-section">
    <div class="container">
      <!-- Section Header -->
      <div class="section-header">
        <div class="header-content">
          <div class="title-block">
            <span class="header-badge">
              <i class="fas fa-shield-check"></i>
              Certified Partners
            </span>
            <h2 class="section-title">Trusted Technology Brands</h2>
            <p class="section-subtitle">World-class electronics manufacturers and partners we work with</p>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="state-container">
        <div class="loading-spinner">
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <p>Loading our partners...</p>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="state-container">
        <div class="error-state">
          <i class="fas fa-exclamation-circle"></i>
          <p>{{ error }}</p>
          <button @click="fetchBrands" class="retry-btn">Try Again</button>
        </div>
      </div>

      <!-- Brands Grid -->
      <div v-else-if="brands.length > 0" class="brands-container">
        <div class="brands-grid">
          <div 
            v-for="(brand, index) in visibleBrands" 
            :key="brand.id" 
            class="brand-card"
            :style="{ animationDelay: `${index * 0.05}s` }"
          >
            <a :href="`/products?brand=${brand.id}`" class="brand-link">
              <div class="brand-image-wrapper">
                <img 
                  :src="getBrandImageUrl(brand.brand_image)" 
                  :alt="brand.name"
                  @error="handleImageError"
                  class="brand-image"
                  loading="lazy"
                />
                <div class="brand-overlay">
                  <span class="view-products">
                    <i class="fas fa-arrow-right"></i>
                    View Products
                  </span>
                </div>
              </div>
              <div class="brand-name" v-if="brand.name">
                {{ brand.name }}
              </div>
            </a>
          </div>
        </div>

        <!-- Pagination Controls -->
        <div class="pagination-controls" v-if="totalPages > 1">
          <button 
            @click="prevPage" 
            :disabled="currentPage === 0" 
            class="pagination-btn"
            aria-label="Previous page"
          >
            <i class="fas fa-chevron-left"></i>
            Previous
          </button>
          
          <div class="page-indicators">
            <button
              v-for="page in displayPages"
              :key="page"
              @click="goToPage(page)"
              :class="['page-btn', { active: currentPage === page }]"
            >
              {{ page + 1 }}
            </button>
          </div>
          
          <button 
            @click="nextPage" 
            :disabled="currentPage >= totalPages - 1" 
            class="pagination-btn"
            aria-label="Next page"
          >
            Next
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="state-container">
        <div class="empty-state">
          <i class="fas fa-handshake"></i>
          <h3>No Partners Listed</h3>
          <p>We're continuously adding new healthcare partners and brands.</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'BrandCarousel',
    data() {
        return {
            brands: [],
            loading: true,
            error: null,
            currentPage: 0,
            itemsPerPage: 10
        };
    },
    computed: {
        visibleBrands() {
            const start = this.currentPage * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.brands.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.brands.length / this.itemsPerPage);
        },
        displayPages() {
            const pages = [];
            const maxVisible = 5;
            let start = Math.max(0, this.currentPage - Math.floor(maxVisible / 2));
            let end = Math.min(this.totalPages, start + maxVisible);
            
            if (end - start < maxVisible) {
                start = Math.max(0, end - maxVisible);
            }
            
            for (let i = start; i < end; i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    mounted() {
        this.fetchBrands();
    },
    methods: {
        async fetchBrands() {
            try {
                this.loading = true;
                this.error = null;
                const response = await axios.get('/api/brands');
                console.log('Brands API Response:', response.data);
                this.brands = response.data;
            } catch (error) {
                console.error('Error fetching brands:', error);
                this.error = 'Failed to load brands. Please try again.';
            } finally {
                this.loading = false;
            }
        },
        getBrandImageUrl(imagePath) {
            return imagePath || '/front-assets/img/brand-logo/logo.png';
        },
        handleImageError(e) {
            console.error('Image failed to load:', e.target.src);
            e.target.src = '/front-assets/img/brand-logo/logo.png';
        },
        prevPage() {
            if (this.currentPage > 0) {
                this.currentPage--;
                this.scrollToTop();
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages - 1) {
                this.currentPage++;
                this.scrollToTop();
            }
        },
        goToPage(page) {
            this.currentPage = page;
            this.scrollToTop();
        },
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
};
</script>

<style scoped>
.brand-section {
  padding: 80px 0;
  background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
  position: relative;
}

.brand-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, #0a609d, transparent);
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* Section Header */
.section-header {
  margin-bottom: 56px;
  text-align: center;
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
  flex-direction: column;
  align-items: center;
}

.title-block {
  max-width: 700px;
}

.header-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.1) 0%, rgba(6, 64, 43, 0.1) 100%);
  color: #0a609d;
  font-size: 0.875rem;
  font-weight: 600;
  border-radius: 20px;
  margin-bottom: 16px;
  border: 1px solid rgba(10, 154, 115, 0.2);
}

.header-badge i {
  font-size: 1rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #084c74;
  margin: 0 0 12px 0;
  letter-spacing: -0.02em;
}

.section-subtitle {
  color: #6b7280;
  font-size: 1.125rem;
  margin: 0;
}

/* Brands Container */
.brands-container {
  animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.brands-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 24px;
  margin-bottom: 48px;
}

.brand-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(10, 154, 115, 0.08);
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

.brand-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(10, 154, 115, 0.12);
  border-color: rgba(10, 154, 115, 0.2);
}

.brand-link {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  height: 100%;
}

.brand-image-wrapper {
  position: relative;
  padding: 32px;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.02) 0%, rgba(6, 64, 43, 0.03) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 160px;
  overflow: hidden;
}

.brand-image {
  width: 100%;
  height: 100px;
  object-fit: contain;
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  filter: grayscale(100%);
}

.brand-card:hover .brand-image {
  transform: scale(1.1);
  filter: grayscale(0%);
}

.brand-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.95) 0%, rgba(6, 64, 43, 0.95) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.4s ease;
}

.brand-card:hover .brand-overlay {
  opacity: 1;
}

.view-products {
  display: flex;
  align-items: center;
  gap: 8px;
  color: white;
  font-weight: 600;
  font-size: 0.9375rem;
  transform: translateY(10px);
  transition: transform 0.4s ease;
}

.brand-card:hover .view-products {
  transform: translateY(0);
}

.view-products i {
  transition: transform 0.3s ease;
}

.brand-card:hover .view-products i {
  transform: translateX(4px);
}

.brand-name {
  padding: 16px;
  text-align: center;
  font-weight: 600;
  color: #374151;
  font-size: 0.9375rem;
  border-top: 1px solid #f3f4f6;
  transition: color 0.3s ease;
}

.brand-card:hover .brand-name {
  color: #0a609d;
}

/* Pagination */
.pagination-controls {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 16px;
  margin-top: 48px;
}

.pagination-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: white;
  color: #0a609d;
  font-weight: 600;
  border: 2px solid #0a609d;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(10, 154, 115, 0.1);
}

.pagination-btn:hover:not(:disabled) {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(10, 154, 115, 0.2);
}

.pagination-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
  border-color: #d1d5db;
  color: #9ca3af;
}

.page-indicators {
  display: flex;
  gap: 8px;
}

.page-btn {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: white;
  border: 1px solid #e5e7eb;
  color: #6b7280;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.page-btn:hover {
  border-color: #0a609d;
  color: #0a609d;
}

.page-btn.active {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border-color: transparent;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
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

.error-state i {
  font-size: 4rem;
  color: #ef4444;
  margin-bottom: 20px;
}

.empty-state i {
  font-size: 4rem;
  color: #9ca3af;
  margin-bottom: 20px;
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
@media (max-width: 1280px) {
  .brands-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 1024px) {
  .brands-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 768px) {
  .brand-section {
    padding: 60px 0;
  }
  
  .brands-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .section-subtitle {
    font-size: 1rem;
  }
  
  .brand-image-wrapper {
    padding: 24px;
    min-height: 140px;
  }
  
  .brand-image {
    height: 80px;
  }
  
  .pagination-btn span {
    display: none;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 16px;
  }
  
  .brands-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
  
  .brand-image-wrapper {
    padding: 20px;
    min-height: 120px;
  }
  
  .brand-image {
    height: 70px;
  }
  
  .section-header {
    margin-bottom: 40px;
  }
  
  .page-indicators {
    gap: 4px;
  }
  
  .page-btn {
    width: 36px;
    height: 36px;
  }
}
</style>