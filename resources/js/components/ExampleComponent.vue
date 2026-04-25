<template>
  <div class="shop-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Check Our Collection</h2>
      </div>

      <div class="category-grid">
        <a 
          v-for="category in activeCategories" 
          :key="category.id"
          :href="`/category/${category.slug}`"
          class="category-item"
        >
          <span class="category-name">{{ category.category_name }}</span>
          <span class="category-count">{{ category.products?.length || 0 }} products</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const categories = ref([]);

const activeCategories = computed(() => {
  return categories.value
    .filter(category => 
      category.category_name.toLowerCase() !== 'root' &&
      category.products?.length > 0
    )
    .slice(0, 8);
});

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

onMounted(() => {
  fetchCategories();
});
</script>

<style scoped>
.shop-section {
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
  margin-bottom: 1.5rem;
}

.section-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: #171616;
  margin: 0;
}

.category-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  overflow: hidden;
}

.category-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem 1.25rem;
  background: #fff;
  text-decoration: none;
  border-right: 1px solid #e5e5e5;
  border-bottom: 1px solid #e5e5e5;
  transition: background 0.2s ease;
}

.category-item:nth-child(4n) {
  border-right: none;
}

.category-item:hover {
  background: #f9fafb;
}

.category-name {
  font-size: 0.875rem;
  font-weight: 600;
  color: #171616;
  margin-bottom: 0.5rem;
}

.category-count {
  font-size: 0.75rem;
  color: #666;
}

@media (max-width: 1024px) {
  .category-grid {
    grid-template-columns: repeat(3, 1fr);
  }

  .category-item:nth-child(3n) {
    border-right: none;
  }

  .category-item:nth-child(4n) {
    border-right: 1px solid #e5e5e5;
  }
}

@media (max-width: 768px) {
  .shop-section {
    padding: 2rem 0;
  }

  .section-title {
    font-size: 1.45rem;
  }

  .category-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .category-item {
    border-right: 1px solid #e5e5e5;
  }

  .category-item:nth-child(2n) {
    border-right: none;
  }
}

@media (max-width: 540px) {
  .container {
    padding: 0 0.875rem;
  }

  .section-header {
    margin-bottom: 1.125rem;
  }
}
</style>