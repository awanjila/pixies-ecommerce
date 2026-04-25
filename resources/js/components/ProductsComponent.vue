<template>
  <section class="products-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Featured Products</h2>
        <div class="header-actions">
          <a href="/shop" class="view-all">View all</a>
          <button class="carousel-btn" type="button" @click="scrollPrev">Previous</button>
          <button class="carousel-btn" type="button" @click="scrollNext">Next</button>
        </div>
      </div>

      <div class="carousel-viewport" ref="carouselViewport">
        <article
          v-for="product in visibleProducts"
          :key="product.id"
          class="product-card"
        >
          <a :href="'/show/product/' + product.slug" class="product-link">
            <div class="product-image">
              <img :src="product.product_image" :alt="product.product_name" loading="lazy" />
            </div>
          </a>

          <div class="product-details">
            <h3 class="product-name">
              <a :href="'/show/product/' + product.slug">{{ product.product_name }}</a>
            </h3>
            <p class="product-price">
              <span class="current-price">Ksh {{ formatPrice(product.selling_price) }}</span>
            </p>
            <button class="add-cart-btn" @click.prevent="addToCart(product)">
              Add to cart
            </button>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import { useCartStore } from '../store/cart';

export default {
  data() {
    return {
      products: []
    };
  },
  computed: {
    visibleProducts() {
      return this.products.slice(0, 4);
    }
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('/api/wabegadgets/products');
        if (response.data.status === 200 && response.data.products.data) {
          this.products = response.data.products.data.slice(0, 12);
        }
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    formatPrice(price) {
      return parseFloat(price).toLocaleString('en-KE');
    },
    addToCart(product) {
      const cartStore = useCartStore();
      cartStore.addToCart({
        id: product.id,
        product_name: product.product_name,
        selling_price: product.selling_price,
        product_image: product.product_image,
        quantity: 1,
        slug: product.slug
      });
    },
    scrollPrev() {
      const el = this.$refs.carouselViewport;
      if (!el) return;
      el.scrollBy({ left: -(el.clientWidth * 0.9), behavior: 'smooth' });
    },
    scrollNext() {
      const el = this.$refs.carouselViewport;
      if (!el) return;
      el.scrollBy({ left: el.clientWidth * 0.9, behavior: 'smooth' });
    }
  },
  mounted() {
    this.fetchProducts();
  }
};
</script>

<style scoped>
.products-section {
  padding: 2.5rem 0;
  background: #fff;
  width: 100%;
}

.container {
  max-width: 100%;
  margin: 0 auto;
  padding: 0 1rem;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.section-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #171616;
  margin: 0;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 0.625rem;
}

.view-all {
  font-size: 0.875rem;
  color: #171616;
  text-decoration: none;
  font-weight: 600;
}

.view-all:hover {
  color: #95002a;
}

.carousel-btn {
  border: 1px solid #e5e5e5;
  background: #fff;
  color: #171616;
  border-radius: 4px;
  padding: 0.5rem 0.875rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
}

.carousel-btn:hover {
  background: #f5f5f5;
  border-color: #171616;
}

.carousel-viewport {
  display: grid;
  grid-auto-flow: column;
  grid-auto-columns: calc((100% - 18px * 3) / 4);
  gap: 18px;
  overflow-x: auto;
  padding-bottom: 0.625rem;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
}

.carousel-viewport::-webkit-scrollbar {
  height: 10px;
}

.carousel-viewport::-webkit-scrollbar-thumb {
  background: #e5e5e5;
  border-radius: 999px;
}

.product-card {
  display: flex;
  flex-direction: column;
  border: 1px solid #e5e5e5;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  scroll-snap-align: start;
  transition: box-shadow 0.2s ease, border-color 0.2s ease;
}

.product-card:hover {
  border-color: #95002a;
  box-shadow: 0 8px 20px rgba(23, 22, 22, 0.08);
}

.product-link {
  display: block;
  text-decoration: none;
}

.product-image {
  background: #f9fafb;
  height: 220px;
  padding: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-image img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.product-details {
  padding: 0.75rem;
  border-top: 1px solid #e5e5e5;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  flex: 1;
}

.product-name {
  font-size: 0.9375rem;
  font-weight: 500;
  color: #171616;
  margin: 0;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.8em;
}

.product-name a {
  color: inherit;
  text-decoration: none;
}

.product-name a:hover {
  color: #666;
}

.product-price {
  font-size: 1rem;
  font-weight: 700;
  color: #171616;
  margin: 0;
}

.add-cart-btn {
  margin-top: auto;
  width: 100%;
  padding: 0.625rem 1rem;
  background: #ffffff;
  color: #171616;
  border: 1px solid #171616;
  border-radius: 4px;
  font-size: 0.8125rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.add-cart-btn:hover {
  background: #171616;
  color: #ffffff;
}

@media (max-width: 1200px) {
  .carousel-viewport {
    grid-auto-columns: calc((100% - 18px * 2) / 3);
  }
}

@media (max-width: 992px) {
  .carousel-viewport {
    grid-auto-columns: calc((100% - 18px) / 2);
  }
}

@media (max-width: 768px) {
  .products-section {
    padding: 2rem 0;
  }

  .section-title {
    font-size: 1.45rem;
  }

  .carousel-viewport {
    grid-auto-columns: calc((100% - 18px) / 2);
  }

  .product-image {
    height: 200px;
  }
}

@media (max-width: 540px) {
  .container {
    padding: 0 0.875rem;
  }

  .section-header {
    margin-bottom: 1.125rem;
  }

  .header-actions {
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: flex-end;
  }

  .carousel-btn {
    display: none;
  }

  .carousel-viewport {
    grid-auto-columns: 100%;
  }
}
</style>