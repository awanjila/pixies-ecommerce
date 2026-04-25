<template>
    <div class="header-categories" v-if="showCategories">
      <div class="header-categories-header">
        <img src="/front-assets/images/logos/logo-ft.png" alt="Pixies Technologies" class="side-menu-logo" />
        <button @click="toggleCategories" class="close-btn">
          <i class="fa fa-times"></i>
        </button>
      </div>

      <ul class="category-list">
        <li v-for="category in categories" :key="category.id">
          <a :href="`/category/${category.slug}`">{{ capitalize(category.category_name) }}</a>
        </li>
      </ul>

      <!-- Footer Section - Fixed to the Bottom -->
      <div class="footer">
        <div class="social-media-links">
          <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-facebook"></i>
          </a>
          <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-twitter"></i>
          </a>
          <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-instagram"></i>
          </a>
        </div>

        <!-- Phone number section -->
        <div class="phone-footer">
          <p><strong>Phone:</strong> +254 798 742 543</p>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      showCategories: false,
      isSearchBarVisible: false,
      categories: [],
    };
  },
  methods: {
    toggleCategories() {
      this.showCategories = !this.showCategories;
    },
    async fetchCategories() {
      try {
        const response = await axios.get('api/wabegadgets/categories');
        if (response.data && response.data.categories) {
          this.categories = response.data.categories;
        } else {
          console.error('Failed to load categories');
        }
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    capitalize(text) {
      if (!text) return '';
      return text
        .toLowerCase()
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
    }
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>