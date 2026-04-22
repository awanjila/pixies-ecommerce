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

      <div v-else-if="brands.length > 0" class="brands-grid">
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
        }
    }
};
</script>

<style scoped>
.brand-section {
  padding: 3rem 0;
  background: #ffffff;
}

.container {
  max-width: 1200px;
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

.brands-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 1px;
  background: #e5e5e5;
  border: 1px solid #e5e5e5;
}

.brand-card {
  background: #ffffff;
}

.brand-link {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  height: 100%;
}

.brand-image-wrapper {
  padding: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 120px;
}

.brand-image {
  max-width: 100%;
  max-height: 60px;
  object-fit: contain;
  filter: grayscale(100%);
  transition: filter 0.2s ease;
}

.brand-card:hover .brand-image {
  filter: grayscale(0%);
}

.brand-name {
  padding: 0.75rem;
  text-align: center;
  font-weight: 600;
  color: #171616;
  font-size: 0.875rem;
  border-top: 1px solid #e5e5e5;
}

.brand-card:hover .brand-name {
  color: #95002a;
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

@media (max-width: 1024px) {
  .brands-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 768px) {
  .brands-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 540px) {
  .brands-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>