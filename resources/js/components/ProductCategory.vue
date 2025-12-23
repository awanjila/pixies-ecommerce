<template>
  <div class="category-menu">
    <div class="menu-header">
      <h3 class="menu-title">
        
        Categories
      </h3>
    </div>
    <ul class="category-list">
      <!-- Main categories -->
      <li 
        v-for="category in displayedCategories" 
        :key="category.id" 
        class="category-item"
      >
        <a :href="'/category/' + category.slug" class="category-link">
          <span class="link-content">
            <i class="fas fa-microchip"></i>
            <span class="category-name">{{ capitalizeFirstLetter(category.category_name) }}</span>
          </span>
          <i class="fas fa-chevron-right arrow-icon"></i>
        </a>
      </li>

      <!-- More categories link -->
      <li class="category-item more-categories">
        <a href="/shop" class="category-link">
          <span class="link-content">
            <i class="fas fa-th-large"></i>
            <span class="category-name">View All Categories</span>
          </span>
          <i class="fas fa-arrow-right arrow-icon"></i>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CategoryMenu',
  data() {
    return {
      categories: [],
      displayedCategories: []
    };
  },
  mounted() {
    this.fetchCategories();
  },
  methods: {
    fetchCategories() {
      axios.get('/api/wabegadgets/categories')
        .then(response => {
          this.categories = response.data.categories;
          // Randomly select 9 categories
          this.displayedCategories = this.getRandomCategories(this.categories, 9);
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    getRandomCategories(categories, count) {
      // Filter out root category
      let filteredCategories = categories.filter(cat => 
        !(cat.id === 1 && cat.category_name.toLowerCase() === 'root')
      );
      
      let shuffled = [...filteredCategories];
      
      // Shuffle the array
      for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
      }
      
      // Return the first 'count' elements or all if less than count
      return shuffled.slice(0, Math.min(count, shuffled.length));
    },
    capitalizeFirstLetter(str) {
      return str.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
    }
  }
};
</script>

<style scoped>
.category-menu {
  height: 100%;
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
}

.menu-header {
  padding: 20px 24px;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.menu-title {
  margin: 0;
  font-size: 1.25rem;
  font-weight: 700;
  color: white;
  display: flex;
  align-items: center;
  gap: 12px;
}

.title-icon {
  font-size: 1.5rem;
}

.category-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.category-item {
  border-bottom: 1px solid #f3f4f6;
  transition: all 0.2s ease;
}

.category-item:last-child {
  border-bottom: none;
}

.category-item:hover {
  background: #f9fafb;
}

.category-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 24px;
  color: #374151;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-size: 0.9375rem;
  position: relative;
  overflow: hidden;
}

.link-content {
  display: flex;
  align-items: center;
  gap: 12px;
  flex: 1;
  z-index: 1;
}

.category-link i.fas {
  color: #0a609d;
  font-size: 0.875rem;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.category-name {
  font-weight: 500;
  transition: all 0.3s ease;
}

.arrow-icon {
  opacity: 0;
  transform: translateX(-10px);
  transition: all 0.3s ease;
  font-size: 0.75rem;
  z-index: 1;
}

.category-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  transform: scaleY(0);
  transition: transform 0.3s ease;
}

.category-link::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, rgba(10, 154, 115, 0.05) 0%, transparent 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.category-item:hover .category-link::before {
  transform: scaleY(1);
}

.category-item:hover .category-link::after {
  opacity: 1;
}

.category-item:hover .category-link {
  padding-left: 32px;
  color: #0a609d;
}

.category-item:hover .category-link i.fas {
  color: #0a609d;
  transform: scale(1.1);
}

.category-item:hover .arrow-icon {
  opacity: 1;
  transform: translateX(0);
  color: #0a609d;
}

/* More Categories Special Styling */
.more-categories {
  background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
  border-top: 2px solid #87CEFA;
  margin-top: 8px;
}

.more-categories .category-link {
  font-weight: 600;
  color: #2ea5dd;
}

.more-categories .category-link i.fas {
  color: #0b4d70;
}

.more-categories:hover {
  background: linear-gradient(135deg, #B0E0E6 0%, #bbf7d0 100%);
}

.more-categories:hover .category-link {
  color: #2ea5dd;
}

.more-categories .arrow-icon {
  opacity: 1;
  transform: translateX(0);
}

.more-categories:hover .arrow-icon {
  transform: translateX(4px);
}

/* Loading Animation */
@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}

.category-item.loading {
  background: linear-gradient(
    90deg,
    #f3f4f6 0px,
    #e5e7eb 40px,
    #f3f4f6 80px
  );
  background-size: 1000px 100%;
  animation: shimmer 2s infinite;
  height: 50px;
}

/* Responsive */
@media (max-width: 768px) {
  .menu-header {
    padding: 16px 20px;
  }

  .menu-title {
    font-size: 1.125rem;
  }

  .category-link {
    padding: 12px 20px;
    font-size: 0.875rem;
  }

  .category-item:hover .category-link {
    padding-left: 28px;
  }
}

/* Accessibility */
.category-link:focus {
  outline: 2px solid #0a609d;
  outline-offset: -2px;
}

.category-link:focus-visible {
  outline: 2px solid #0a609d;
  outline-offset: -2px;
}

/* Dark mode support (optional) */
@media (prefers-color-scheme: dark) {
  .category-menu {
    background: #1f2937;
    border-color: #374151;
  }

  .category-item {
    border-bottom-color: #374151;
  }

  .category-link {
    color: #d1d5db;
  }

  .category-item:hover {
    background: #374151;
  }
}
</style>