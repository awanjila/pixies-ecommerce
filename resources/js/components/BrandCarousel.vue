<template>
  <section class="brand-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Our Brands</h2>
      </div>

      <div v-if="loading" class="state-container">
        <p class="state-text">Loading brands...</p>
      </div>

      <div v-else-if="error" class="state-container">
        <p class="state-text">{{ error }}</p>
        <button @click="fetchBrands" class="retry-btn">Try Again</button>
      </div>

      <div v-else-if="brands.length > 0" class="carousel-wrapper">
        <button class="carousel-arrow prev-arrow" @click="scrollCarousel('prev')" aria-label="Previous">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        
        <div class="carousel-container" ref="carouselContainer">
          <div class="carousel-track">
            <div v-for="brand in brands" :key="brand.id" class="brand-card">
              <a :href="`/products?brand=${brand.id}`" class="brand-link">
                <div class="brand-image-wrapper">
                  <img 
                    :src="getBrandImageUrl(brand.brand_image)" 
                    :alt="brand.name"
                    @error="handleImageError"
                    class="brand-image"
                    loading="lazy"
                  />
                </div>
                <div class="brand-name" v-if="brand.name">
                  {{ brand.name }}
                </div>
              </a>
            </div>
          </div>
        </div>
        
        <button class="carousel-arrow next-arrow" @click="scrollCarousel('next')" aria-label="Next">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>

      <div v-else class="state-container">
        <p class="state-text">No brands available.</p>
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
            error: null
        };
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
                this.brands = response.data;
            } catch (error) {
                console.error('Error fetching brands:', error);
                this.error = 'Failed to load brands.';
            } finally {
                this.loading = false;
            }
        },
        getBrandImageUrl(imagePath) {
            return imagePath || '/front-assets/img/brand-logo/logo.png';
        },
        handleImageError(e) {
            e.target.src = '/front-assets/img/brand-logo/logo.png';
        },
        scrollCarousel(direction) {
            const container = this.$refs.carouselContainer;
            if (!container) return;
            
            const cardWidth = container.querySelector('.brand-card')?.offsetWidth || 200;
            const gap = 18;
            const scrollAmount = direction === 'next' 
                ? cardWidth + gap 
                : -(cardWidth + gap);
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
};
</script>

<style scoped>
.brand-section {
  padding: 3rem 0;
  background: #ffffff;
  width: 100%;
}

.container {
  max-width: 100%;
  margin: 0 auto;
  padding: 0 1rem;
}

.section-header {
  margin-bottom: 2rem;
}

.section-title {
  color: #171616;
  font-size: 1.5rem;
  font-weight: 600;
  margin: 0;
}

.carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.carousel-container {
  flex: 1;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  -ms-overflow-style: none;
  margin: 0 44px;
  padding: 4px 0;
}

.carousel-container::-webkit-scrollbar {
  display: none;
}

.carousel-track {
  display: flex;
  gap: 18px;
}

.brand-card {
  flex: 0 0 180px;
  scroll-snap-align: start;
  border: 1px solid #e5e5e5;
  background: #ffffff;
  border-radius: 8px;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.brand-card:hover {
  border-color: #95002a;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.brand-link {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  height: 100%;
}

.brand-image-wrapper {
  padding: 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100px;
}

.brand-image {
  max-width: 100%;
  max-height: 50px;
  object-fit: contain;
  filter: grayscale(100%);
  transition: filter 0.2s ease;
}

.brand-card:hover .brand-image {
  filter: grayscale(0%);
}

.brand-name {
  padding: 0.625rem;
  text-align: center;
  font-weight: 600;
  color: #171616;
  font-size: 0.8125rem;
  border-top: 1px solid #e5e5e5;
}

.brand-card:hover .brand-name {
  color: #95002a;
}

.carousel-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 36px;
  height: 36px;
  border: 1px solid #e5e5e5;
  background: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  transition: all 0.2s ease;
  color: #171616;
}

.carousel-arrow:hover {
  background: #95002a;
  border-color: #95002a;
  color: #fff;
}

.prev-arrow {
  left: 0;
}

.next-arrow {
  right: 0;
}

.state-container {
  min-height: 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.state-text {
  color: #666;
  margin: 0;
}

.retry-btn {
  padding: 0.5rem 1rem;
  border: 1px solid #e5e5e5;
  background: #ffffff;
  color: #171616;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.retry-btn:hover {
  background: #f5f5f5;
}

@media (max-width: 768px) {
  .carousel-container {
    margin: 0 36px;
  }
  
  .carousel-arrow {
    width: 32px;
    height: 32px;
  }
  
  .brand-card {
    flex: 0 0 150px;
  }
}
</style>