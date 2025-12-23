<template>
  <div class="slider-section">
    <div class="container">
      <div class="slider-layout">
        <!-- Category Menu -->
        <div class="category-section">
          <div class="category-header">
            <h2>Categories</h2>
          </div>
          <ProductCategory />
        </div>

        <!-- Main Slider -->
        <div class="slider-container">
          <div class="swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="(image, index) in [1,2,3]" :key="index">
                <div class="slide-content">
                  <img 
                    :src="`/front-assets/img/banner/wabegadgets-cover-${image}.png`"
                    :alt="`Banner ${image}`"
                    class="slide-image"
                    @click="goToShop"
                  >
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Swiper } from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default {
  mounted() {
    new Swiper('.swiper', {
      modules: [Navigation, Pagination, Autoplay],
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
    });
  },
  methods: {
    goToShop() {
      window.location.href = '/shop';
    }
  }
};
</script>

<style scoped>
.slider-section {
  padding: 24px 0 32px;
  background: #f8f9fa;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 16px;
}

.slider-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 24px;
  min-height: 400px;
}

/* Category Section */
.category-section {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.category-header {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  padding: 16px 20px;
}

.category-header h2 {
  color: white;
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0;
  text-transform: capitalize;
}

/* Slider Styling */
.slider-container {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.swiper {
  width: 100%;
  height: 100%;
}

.slide-content {
  width: 100%;
  height: 100%;
  position: relative;
}

.slide-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.slide-image:hover {
  transform: scale(1.02);
}

/* Swiper Navigation */
.swiper-button-next,
.swiper-button-prev {
  background: white;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  color: #0a609d;
  transition: all 0.3s ease;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
}

.swiper-button-next::after,
.swiper-button-prev::after {
  font-size: 18px;
}

/* Pagination */
.swiper-pagination-bullet {
  width: 8px;
  height: 8px;
  background: #0a609d;
  opacity: 0.5;
}

.swiper-pagination-bullet-active {
  opacity: 1;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .slider-layout {
    grid-template-columns: 240px 1fr;
  }
}

@media (max-width: 768px) {
  .slider-layout {
    grid-template-columns: 1fr;
  }

  .category-section {
    display: none;
  }
}
</style>
