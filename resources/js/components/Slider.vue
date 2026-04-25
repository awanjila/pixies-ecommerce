<template>
  <div class="hero-section">
    <div class="hero-slider">
      <div class="swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="(image, index) in sliderImages" :key="index">
            <div class="slide-content">
              <img 
                :src="`/front-assets/img/slider/${image}`"
                :alt="`Banner ${index + 1}`"
                class="slide-image"
                @click="goToShop"
              >
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { Swiper } from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

export default {
  setup() {
    const sliderImages = ref([
      'ColorVu-PRO-Wide.webp',
      'TCS-APP-Wide-NR.webp',
      'TURBO-HD-8-0-Wide-T.webp',
      'UNV-OWL-View-Wide-NR.webp'
    ]);

    onMounted(() => {
      new Swiper('.hero-slider .swiper', {
        modules: [Pagination, Autoplay],
        loop: true,
        pagination: {
          el: '.hero-slider .swiper-pagination',
          clickable: true,
        },
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
      });
    });

    const goToShop = () => {
      window.location.href = '/shop';
    };

    return { sliderImages, goToShop };
  }
};
</script>

<style scoped>
.hero-section {
  width: 100%;
  overflow: hidden;
}

.hero-slider {
  width: 100%;
  height: 500px;
}

.hero-slider .swiper {
  width: 100%;
  height: 100%;
}

.slide-content {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f9fafb;
}

.slide-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.hero-slider .swiper-pagination {
  bottom: 12px;
}

.hero-slider .swiper-pagination-bullet {
  width: 8px;
  height: 8px;
  background: #171616;
  opacity: 0.4;
  margin: 0 4px;
}

.hero-slider .swiper-pagination-bullet-active {
  opacity: 1;
  background: #95002a;
}

@media (max-width: 768px) {
  .hero-slider {
    height: 220px;
  }
  
  .slide-image {
    object-fit: cover;
  }
}

@media (max-width: 480px) {
  .hero-slider {
    height: 180px;
  }
}
</style>