<template>
  <div class="category-showcase">
    <div class="container">
      <div class="category-header">
        <h2>Shop By Category</h2>
      </div>

      <div class="category-list">
        <button class="nav-btn prev" @click="scrollLeft">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="category-wrapper" ref="categoryWrapper">
          <a v-for="category in displayedCategories" 
             :key="category.id" 
             :href="`/category/${category.slug}`"
             class="category-item"
          >
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
            <span class="name">{{ capitalizeFirstLetter(category.category_name) }}</span>
          </a>

          <a href="/shop" class="category-item">
            <div class="icon">
              <i class="fas fa-th-large"></i>
            </div>
            <span class="name">View All</span>
          </a>
        </div>

        <button class="nav-btn next" @click="scrollRight">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      categories: [],
      displayedCategories: []
    };
  },
  methods: {
    fetchCategories() {
      axios.get('/api/wabegadgets/categories')
        .then(response => {
          this.categories = response.data.categories;
          this.displayedCategories = this.getRandomCategories(this.categories, 10);
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    getRandomCategories(categories, count) {
      let filteredCategories = categories.filter(cat => 
        !(cat.id === 1 && cat.category_name.toLowerCase() === 'root')
      );
      let shuffled = [...filteredCategories];
      for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
      }
      return shuffled.slice(0, Math.min(count, shuffled.length));
    },
    capitalizeFirstLetter(str) {
      return str.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
    },
    scrollLeft() {
      this.$refs.categoryWrapper.scrollBy({ left: -200, behavior: 'smooth' });
    },
    scrollRight() {
      this.$refs.categoryWrapper.scrollBy({ left: 200, behavior: 'smooth' });
    }
  },
  mounted() {
    this.fetchCategories();
  }
};
</script>

<style scoped>
/* Basic layout styles only */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 16px;
}

.category-wrapper {
  display: flex;
  overflow-x: auto;
}

.category-item {
  text-decoration: none;
}
</style>
