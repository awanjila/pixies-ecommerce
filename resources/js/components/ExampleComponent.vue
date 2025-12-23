<template>
  <div class="product-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Electronics, Security & Smart Devices </h2>
        <p class="section-subtitle">Explore our comprehensive range of Electronics, Security & Smart Devices</p>
      </div>

      <div class="carousel-wrapper">
        <button class="nav-btn prev" @click="slide('prev')" :disabled="atStart" aria-label="Previous categories">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="carousel-container" ref="carousel">
          <div class="carousel-track" :style="{ transform: `translateX(-${currentSlide * slideWidth}px)` }">
            <a v-for="category in activeCategories"
               :key="category.id"
               :href="`/category/${category.slug}`"
               class="category-card"
            >
              <div class="card-inner">
                <div class="image-wrapper">
                  <div class="image-overlay"></div>
                  <img :src="getProductImage(category)" 
                       :alt="category.category_name"
                       class="category-image"
                       loading="lazy"
                  >
                </div>
                <div class="category-info">
                  <div class="icon-badge">
                    <i class="fas fa-microchip"></i>
                  </div>
                  <h3>{{ category.category_name }}</h3>
                  <div class="product-meta">
                    <span class="product-count">
                      <i class="fas fa-boxes"></i>
                      {{ category.products.length }} Products
                    </span>
                    <span class="view-more">View Collection →</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <button class="nav-btn next" @click="slide('next')" :disabled="atEnd" aria-label="Next categories">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <div class="carousel-dots">
        <button 
          v-for="(dot, index) in totalDots" 
          :key="index"
          @click="goToSlide(index)"
          :class="['dot', { active: index === currentDotIndex }]"
          :aria-label="`Go to slide ${index + 1}`"
        ></button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, onUnmounted } from 'vue';
import axios from 'axios';

const categories = ref([]);
const currentSlide = ref(0);
const carousel = ref(null);
const slideWidth = ref(0);
const cardsPerView = ref(4);

// Only get categories with products
const activeCategories = computed(() => {
  return categories.value
    .filter(category => 
      !(category.id === 1 && category.category_name.toLowerCase() === 'root') &&
      category.products?.length > 0
    )
    .sort(() => Math.random() - 0.5)
    .slice(0, 12);
});

const totalDots = computed(() => {
  return Math.ceil(activeCategories.value.length / cardsPerView.value);
});

const currentDotIndex = computed(() => {
  return Math.floor(currentSlide.value / cardsPerView.value);
});

const atStart = computed(() => currentSlide.value === 0);
const atEnd = computed(() => {
  return currentSlide.value >= activeCategories.value.length - cardsPerView.value;
});

const updateCardsPerView = () => {
  const width = window.innerWidth;
  if (width < 640) {
    cardsPerView.value = 1;
  } else if (width < 768) {
    cardsPerView.value = 2;
  } else if (width < 1024) {
    cardsPerView.value = 3;
  } else {
    cardsPerView.value = 4;
  }
  slideWidth.value = carousel.value ? carousel.value.offsetWidth / cardsPerView.value : 0;
};

const slide = (direction) => {
  if (direction === 'next' && !atEnd.value) {
    currentSlide.value = Math.min(
      currentSlide.value + cardsPerView.value,
      activeCategories.value.length - cardsPerView.value
    );
  } else if (direction === 'prev' && !atStart.value) {
    currentSlide.value = Math.max(0, currentSlide.value - cardsPerView.value);
  }
};

const goToSlide = (index) => {
  currentSlide.value = index * cardsPerView.value;
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/wabegadgets/categories');
    if (response.data.categories) {
      categories.value = response.data.categories;
    }
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const getProductImage = (category) => {
  if (category.products && category.products.length > 0) {
    const randomIndex = Math.floor(Math.random() * category.products.length);
    return category.products[randomIndex].product_image;
  }
  return '/path/to/default/image.jpg';
};

onMounted(async () => {
  await fetchCategories();
  updateCardsPerView();
  window.addEventListener('resize', updateCardsPerView);
});

onUnmounted(() => {
  window.removeEventListener('resize', updateCardsPerView);
});
</script>

<style scoped>
.product-section {
  padding: 64px 0;
  background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
  position: relative;
}

.product-section::before {
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

.section-header {
  text-align: center;
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
  font-weight: 400;
}

.carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  gap: 24px;
  margin-bottom: 32px;
}

.carousel-container {
  overflow: hidden;
  width: 100%;
  padding: 8px 0;
}

.carousel-track {
  display: flex;
  gap: 24px;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-card {
  flex: 0 0 calc(25% - 18px);
  text-decoration: none;
  display: block;
  animation: fadeIn 0.6s ease-out;
  animation-fill-mode: both;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }

.card-inner {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  background: white;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 
              0 2px 4px -1px rgba(0, 0, 0, 0.03);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  aspect-ratio: 3/4;
  border: 1px solid rgba(10, 154, 115, 0.08);
}

.category-card:hover .card-inner {
  transform: translateY(-8px);
  box-shadow: 0 20px 25px -5px rgba(10, 154, 115, 0.15), 
              0 10px 10px -5px rgba(10, 154, 115, 0.08);
  border-color: rgba(10, 154, 115, 0.2);
}

.image-wrapper {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.03) 0%, rgba(6, 64, 43, 0.05) 100%);
  overflow: hidden;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent 0%, rgba(6, 64, 43, 0.3) 100%);
  z-index: 1;
  transition: opacity 0.4s ease;
}

.category-card:hover .image-overlay {
  opacity: 0.7;
}

.category-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-card:hover .category-image {
  transform: scale(1.08);
}

.category-info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 24px;
  background: linear-gradient(to top, 
    rgba(8, 76, 116, 1) 0%, 
    rgba(8, 76, 116, 0.85) 50%,
    transparent 100%);
  color: white;
  z-index: 2;
  transition: all 0.4s ease;
}

.category-card:hover .category-info {
  padding-bottom: 28px;
}

.icon-badge {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  background: rgba(8, 54, 116, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
  backdrop-filter: blur(8px);
  transition: all 0.3s ease;
}

.category-card:hover .icon-badge {
  background: rgba(8, 96, 200, 1);
  transform: scale(1.1);
}

.icon-badge i {
  font-size: 1.125rem;
  color: white;
}

.category-info h3 {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 12px 0;
  line-height: 1.3;
  letter-spacing: -0.01em;
}

.product-meta {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.product-count {
  font-size: 0.875rem;
  opacity: 0.9;
  display: flex;
  align-items: center;
  gap: 6px;
}

.product-count i {
  font-size: 0.75rem;
}

.view-more {
  font-size: 0.875rem;
  font-weight: 500;
  color: #0a609d;
  background: white;
  padding: 6px 12px;
  border-radius: 6px;
  display: inline-block;
  opacity: 0;
  transform: translateY(8px);
  transition: all 0.3s ease;
}

.category-card:hover .view-more {
  opacity: 1;
  transform: translateY(0);
}

.nav-btn {
  flex: 0 0 48px;
  height: 48px;
  border-radius: 50%;
  border: 2px solid rgba(10, 154, 115, 0.2);
  background: white;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.12);
  color: #0a609d;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.125rem;
}

.nav-btn:hover:not(:disabled) {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border-color: transparent;
  transform: scale(1.05);
  box-shadow: 0 8px 16px #084c74;
}

.nav-btn:active:not(:disabled) {
  transform: scale(0.95);
}

.nav-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
  border-color: rgba(0, 0, 0, 0.1);
}

.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 24px;
}

.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  border: none;
  background: #d1d5db;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}

.dot:hover {
  background: #9ca3af;
  transform: scale(1.2);
}

.dot.active {
  width: 24px;
  border-radius: 4px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
}

@media (max-width: 1024px) {
  .category-card {
    flex: 0 0 calc(33.333% - 16px);
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 768px) {
  .product-section {
    padding: 48px 0;
  }
  
  .category-card {
    flex: 0 0 calc(50% - 12px);
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .section-subtitle {
    font-size: 1rem;
  }
  
  .carousel-wrapper {
    gap: 12px;
  }
  
  .nav-btn {
    flex: 0 0 40px;
    height: 40px;
  }
  
  .carousel-track {
    gap: 16px;
  }
}

@media (max-width: 640px) {
  .container {
    padding: 0 16px;
  }
  
  .category-card {
    flex: 0 0 100%;
  }
  
  .nav-btn {
    display: none;
  }
  
  .carousel-wrapper {
    gap: 0;
  }
  
  .carousel-track {
    gap: 16px;
  }
  
  .section-header {
    margin-bottom: 32px;
  }
}
</style>