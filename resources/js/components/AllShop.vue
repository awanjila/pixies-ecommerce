<template>
  <div class="shop-page">
    <!-- Shop Header -->
    <div class="shop-header">
      <div class="container">
        <h1 class="shop-title">Shop All Products</h1>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="loading-state">
      <div class="loading-spinner"></div>
      <p>Loading products...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="!products.length" class="empty-state">
      <p>No products found</p>
    </div>

    <!-- Products Grid -->
    <div v-else class="container">
      <!-- Categories Filter -->
      <div class="category-filter">
        <button 
          @click="filterByCategory(null)"
          :class="{ 'active': selectedCategory === null }"
          class="filter-btn"
        >
          All
        </button>
        <button 
          v-for="category in categories" 
          :key="category.id"
          @click="filterByCategory(category.id)"
          :class="{ 'active': selectedCategory === category.id }"
          class="filter-btn"
        >
          {{ category.category_name }}
        </button>
      </div>

      <!-- Products Grid -->
      <div class="products-grid">
        <div v-for="product in products" :key="product.id" class="product-card">
          <div class="product-image">
            <a :href="`/show/product/${product.slug}`">
              <img :src="getImagePath(product.product_image)" :alt="product.product_name">
            </a>
          </div>
          <div class="product-info">
            <h3 class="product-title">
              <a :href="`/show/product/${product.slug}`">{{ product.product_name }}</a>
            </h3>
            <div class="product-price">
              Ksh {{ formatPrice(product.selling_price) }}
            </div>
            <button @click="addToCart(product)" class="add-to-cart-btn">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination" v-if="lastPage > 1">
        <button 
          class="page-btn prev" 
          :disabled="currentPage === 1"
          @click="changePage(currentPage - 1)"
        >
          Previous
        </button>
        <div class="page-numbers">
          <button 
            v-for="page in displayedPages" 
            :key="page"
            @click="changePage(page)"
            :class="['page-btn', { active: currentPage === page }]"
          >
            {{ page }}
          </button>
        </div>
        <button 
          class="page-btn next" 
          :disabled="currentPage === lastPage"
          @click="changePage(currentPage + 1)"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useCartStore } from '../store/cart';

const cartStore = useCartStore();
const products = ref([]);
const categories = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);
const selectedCategory = ref(null);
const loading = ref(true);

const formatPrice = (price) => {
  return new Intl.NumberFormat('en-KE').format(price);
};

// Computed property for pagination display
const displayedPages = computed(() => {
  const pages = [];
  const totalPages = lastPage.value;
  const current = currentPage.value;

  // Always show first page
  if (totalPages > 0) pages.push(1);

  // Show pages around current page
  for (let i = Math.max(2, current - 1); i <= Math.min(totalPages - 1, current + 1); i++) {
    pages.push(i);
  }

  // Always show last page
  if (totalPages > 1) pages.push(totalPages);

  return pages;
});

const fetchProducts = async (page = 1, categoryId = null) => {
  loading.value = true;
  try {
    let url = `/api/wabegadgets/products?page=${page}`;
    if (categoryId) {
      url += `&category_id=${categoryId}`;
    }
    const response = await axios.get(url);
    if (response.data.status === 200) {
      products.value = response.data.products.data;
      currentPage.value = response.data.products.current_page;
      lastPage.value = response.data.products.last_page;
    }
  } catch (error) {
    console.error('Error fetching products:', error);
  } finally {
    loading.value = false;
  }
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/wabegadgets/categories');
    categories.value = response.data.categories;
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const filterByCategory = async (categoryId) => {
  selectedCategory.value = categoryId;
  currentPage.value = 1;
  await fetchProducts(1, categoryId);
};

const changePage = (page) => {
  if (page !== currentPage.value) {
    window.scrollTo(0, 0);
    fetchProducts(page, selectedCategory.value);
  }
};

const getImagePath = (imagePath) => {
  const cleanPath = imagePath.replace(/^\/+/, '');
  return `/${cleanPath}`;
};

const addToCart = (product) => {
  const cartItem = {
    id: product.id,
    product_name: product.product_name,
    selling_price: product.selling_price,
    product_image: product.product_image,
    quantity: 1,
    slug: product.slug
  };
  cartStore.addToCart(cartItem);
};

onMounted(async () => {
  await Promise.all([
    fetchCategories(),
    fetchProducts()
  ]);
});
</script>

<style scoped>
.shop-page {
  min-height: 100vh;
}

.shop-header {
  background: #171616;
  padding: 2.5rem 0;
}

.shop-title {
  color: #ffffff;
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.category-filter {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  padding: 1.5rem 0;
}

.filter-btn {
  padding: 0.5rem 1rem;
  background: #ffffff;
  border: 1px solid #e5e5e5;
  border-radius: 4px;
  font-size: 0.8125rem;
  font-weight: 500;
  color: #666;
  cursor: pointer;
  transition: all 0.2s ease;
}

.filter-btn:hover {
  border-color: #171616;
  color: #171616;
}

.filter-btn.active {
  background: #171616;
  border-color: #171616;
  color: #ffffff;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.5rem;
  padding-bottom: 2rem;
}

.product-card {
  background: white;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  overflow: hidden;
  transition: box-shadow 0.2s ease, border-color 0.2s ease;
}

.product-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border-color: #95002a;
}

.product-image {
  height: 180px;
  background: #f9fafb;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-image a {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-image img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.product-info {
  padding: 1rem;
  border-top: 1px solid #e5e5e5;
  display: flex;
  flex-direction: column;
  flex: 1;
}

.product-title {
  font-size: 0.875rem;
  font-weight: 500;
  margin-bottom: 0.5rem;
  line-height: 1.4;
  min-height: 2.5em;
}

.product-title a {
  color: #171616;
  text-decoration: none;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.product-price {
  color: #171616;
  font-weight: 700;
  font-size: 1rem;
  margin-bottom: 0.75rem;
}

.add-to-cart-btn {
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
  margin-top: auto;
}

.add-to-cart-btn:hover {
  background: #171616;
  color: #ffffff;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  margin-top: 2rem;
  padding-bottom: 3rem;
}

.page-numbers {
  display: flex;
  gap: 0.5rem;
}

.page-btn {
  min-width: 2.5rem;
  height: 2.5rem;
  border-radius: 4px;
  background: white;
  border: 1px solid #e5e5e5;
  color: #666;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.page-btn:hover:not(:disabled),
.page-btn.active {
  background: #95002a;
  border-color: #95002a;
  color: white;
}

.page-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.loading-state, .empty-state {
  text-align: center;
  padding: 4rem;
}

.loading-spinner {
  width: 3rem;
  height: 3rem;
  border: 3px solid #e5e5e5;
  border-top: 3px solid #95002a;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin: 0 auto 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@media (max-width: 1024px) {
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
  }
}

@media (max-width: 768px) {
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .shop-header {
    padding: 1.5rem 0;
  }
  
  .shop-title {
    font-size: 1.5rem;
  }
  
  .category-filter {
    padding: 1rem 0;
  }
  
  .product-image {
    height: 150px;
    padding: 1rem;
  }
  
  .product-info {
    padding: 0.875rem;
  }
  
  .product-title {
    font-size: 0.8125rem;
  }
}
</style>















