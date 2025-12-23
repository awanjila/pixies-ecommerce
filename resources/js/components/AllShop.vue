<template>
  <div class="shop-container">
    <div class="container">
      <div class="row">
        <!-- Loading State -->
        <div v-if="loading" class="loading-state">
          <div class="spinner"></div>
          <p>Loading products...</p>
        </div>

        <!-- Error State -->
        <div v-else-if="!products.length" class="empty-state">
          <p>No products found</p>
        </div>

        <!-- Content -->
        <template v-else>
          <!-- Categories Sidebar -->
          <div class="sidebar-container">
            <aside class="shop-sidebar">
              <div class="category-widget">
                <h4 class="widget-title">Product Categories</h4>
                <ul class="category-list">
                  <li>
                    <button 
                      @click="filterByCategory(null)"
                      :class="{ 'active': selectedCategory === null }"
                      class="category-btn"
                    >
                      All Products
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </li>
                  <li v-for="category in categories" :key="category.id">
                    <button 
                      @click="filterByCategory(category.id)"
                      :class="{ 'active': selectedCategory === category.id }"
                      class="category-btn"
                    >
                      {{ category.category_name }}
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </li>
                </ul>
              </div>
            </aside>
          </div>

          <!-- Products Grid -->
          <div class="products-container">
            <div class="products-grid">
              <div v-for="product in products" :key="product.id" class="product-card">
                <div class="product-image">
                  <a :href="`/show/product/${product.slug}`">
                    <img :src="getImagePath(product.product_image)" :alt="product.product_name">
                  </a>
                  <span class="badge">New</span>
                  <div class="product-actions">
                    <a :href="`/show/product/${product.slug}`" class="action-btn" title="Quick View">
                      <i class="far fa-eye"></i>
                    </a>
                    <button @click="addToCart(product)" class="action-btn" title="Add to Cart">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                    <button class="action-btn" title="Wishlist">
                      <i class="far fa-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-details">
                  <h2 class="product-title">
                    <a :href="`/show/product/${product.slug}`">{{ product.product_name }}</a>
                  </h2>
                  <div class="product-price">
                    KES {{ product.selling_price }}.00
                  </div>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <div v-if="lastPage > 1" class="pagination">
              <button 
                v-if="currentPage > 1" 
                @click="changePage(currentPage - 1)" 
                class="page-btn prev"
              >
                <i class="fas fa-arrow-left"></i>
              </button>

              <button 
                v-for="page in displayedPages" 
                :key="page"
                @click="changePage(page)"
                :class="['page-btn', { active: currentPage === page }]"
              >
                {{ page }}
              </button>

              <button 
                v-if="currentPage < lastPage" 
                @click="changePage(currentPage + 1)" 
                class="page-btn next"
              >
                <i class="fas fa-arrow-right"></i>
              </button>
            </div>
          </div>
        </template>
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
.shop-container {
  padding: 40px 0;
  background: #f8f9fa;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 16px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

/* Loading & Empty States */
.loading-state, .empty-state {
  width: 100%;
  text-align: center;
  padding: 40px;
}

.spinner {
  border: 3px solid #f3f3f3;
  border-top: 3px solid #0a609d;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
  margin: 0 auto 20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Sidebar */
.sidebar-container {
  width: 100%;
  max-width: 280px;
}

.shop-sidebar {
  background: white;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.widget-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid #f3f4f6;
  color: #1f2937;
}

.category-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.category-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  background: none;
  border: none;
  border-radius: 8px;
  color: #4b5563;
  font-size: 0.938rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.category-btn:hover, .category-btn.active {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
}

/* Products Grid */
.products-container {
  flex: 1;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 24px;
}

.product-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.product-image {
  position: relative;
  padding-top: 100%;
}

.product-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.badge {
  position: absolute;
  top: 12px;
  left: 12px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
}

.product-actions {
  position: absolute;
  bottom: 12px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  opacity: 0;
  transition: opacity 0.2s ease;
}

.product-card:hover .product-actions {
  opacity: 1;
}

.action-btn {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border: none;
  border-radius: 50%;
  color: #4b5563;
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.action-btn:hover {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  transform: translateY(-2px);
}

.product-details {
  padding: 16px;
}

.product-title {
  font-size: 1rem;
  font-weight: 500;
  margin-bottom: 8px;
}

.product-title a {
  color: #1f2937;
  text-decoration: none;
}

.product-price {
  color: #0a609d;
  font-weight: 600;
  font-size: 1.125rem;
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 40px;
}

.page-btn {
  min-width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  color: #4b5563;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.page-btn:hover, .page-btn.active {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  border-color: transparent;
  color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .sidebar-container {
    max-width: 240px;
  }
}

@media (max-width: 768px) {
  .row {
    flex-direction: column;
  }

  .sidebar-container {
    max-width: 100%;
  }

  .products-grid {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  }
}
</style>














