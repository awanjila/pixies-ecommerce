<template>
  <div class="category-page">
    <!-- Category Header -->
    <div class="category-header">
      <div class="container">
        <h1 class="category-title">{{ categoryName }}</h1>
        <div class="category-description" v-html="categoryDescription"></div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="loading-state">
      <div class="loading-spinner"></div>
      <p>Loading products...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="!productsData?.length" class="empty-state">
      <p>No products found in this category</p>
    </div>

    <!-- Products Grid -->
    <div v-else class="container">
      <div class="products-grid">
        <div v-for="product in productsData" :key="product.id" class="product-card">
          <div class="product-image">
            <a :href="`/show/product/${product.slug}`">
              <img :src="getImagePath(product.product_image)" :alt="product.product_name">
            </a>
            <div class="product-badges" v-if="product.is_featured">
              <span class="badge featured">Featured</span>
            </div>
          </div>
          <div class="product-info">
            <h3 class="product-title">
              <a :href="`/show/product/${product.slug}`">{{ product.product_name }}</a>
            </h3>
            <div class="product-price">
              <span class="price-amount">Ksh {{ product.selling_price }}.00</span>
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

const props = defineProps({
  categorySlug: {
    type: String,
    required: true
  }
});

const cartStore = useCartStore();
const productsData = ref([]);
const loading = ref(true);
const categoryName = ref('');
const categoryDescription = ref('');
const currentPage = ref(1);
const lastPage = ref(1);

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

const fetchCategoryProducts = async (page = 1) => {
  loading.value = true;
  try {
    const response = await axios.get(`/api/category/${props.categorySlug}/products?page=${page}`);
    if (response.data.success) {
      productsData.value = response.data.products.data;
      categoryName.value = response.data.category.category_name;
      categoryDescription.value = response.data.category.category_description || 'No description available';
      currentPage.value = response.data.products.current_page;
      lastPage.value = response.data.products.last_page;
    }
  } catch (error) {
    console.error('Error fetching category products:', error);
  } finally {
    loading.value = false;
  }
};

const changePage = (page) => {
  if (page !== currentPage.value) {
    window.scrollTo(0, 0);
    fetchCategoryProducts(page);
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

onMounted(() => {
  fetchCategoryProducts();
});
</script>

<style scoped>
.section-padding {
  padding: 4rem 0;
  background-color: #f8fafc;
}

.category-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 2rem;
}

.category-sidebar {
  background: white;
  padding: 1.5rem;
  border-radius: 0.5rem;
  border: 1px solid #e5e5e5;
  height: fit-content;
}

.widget-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #171616;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid #95002a;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1px;
  background: #e5e5e5;
  border: 1px solid #e5e5e5;
}

.product-card {
  background: white;
  border-radius: 0;
  overflow: hidden;
  transition: all 0.2s ease;
}

.product-card:hover {
  border-color: #95002a;
}

.product-image {
  position: relative;
  height: 220px;
  background: #f5f5f5;
  padding: 1rem;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.product-badges {
  position: absolute;
  top: 0.75rem;
  left: 0.75rem;
}

.badge {
  padding: 0.25rem 0.5rem;
  border-radius: 0.25rem;
  font-size: 0.75rem;
  font-weight: 600;
  background: #95002a;
  color: white;
}

.product-actions {
  position: absolute;
  right: 1rem;
  top: 1rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  opacity: 0;
  transform: translateX(1rem);
  transition: all 0.3s ease;
}

.product-card:hover .product-actions {
  opacity: 1;
  transform: translateX(0);
}

.action-btn {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  background: white;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #374151;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

.action-btn:hover {
  background: #95002a;
  color: white;
}

.product-info {
  padding: 1rem;
  border-top: 1px solid #e5e5e5;
}

.product-title {
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 0.5rem;
  line-height: 1.4;
}

.product-title a {
  color: #171616;
  text-decoration: none;
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
}

.page-btn {
  min-width: 2.5rem;
  height: 2.5rem;
  border-radius: 0.375rem;
  background: white;
  border: 1px solid #e5e7eb;
  color: #374151;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.page-btn:hover:not(:disabled),
.page-btn.active {
  background: #95002a;
  color: white;
  border-color: #95002a;
}

.page-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.loading-state,
.empty-state {
  text-align: center;
  padding: 3rem;
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
  .category-grid {
    grid-template-columns: 1fr;
  }
  
  .category-sidebar {
    margin-bottom: 2rem;
  }
}

@media (max-width: 1024px) {
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .product-image {
    height: 180px;
  }
}
</style>