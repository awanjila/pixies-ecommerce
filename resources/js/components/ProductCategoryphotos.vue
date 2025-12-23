<template>
  <div v-for="category in categories" :key="category.id" class="col">
    <div class="tp-product-category-item text-center mb-40">
      <div class="tp-product-category-thumb fix">
        <a :href="'category/' + category.slug">
          <img :src="getFirstProductImage(category)" alt="product-category" class="category-image">
        </a>
      </div>
      <div class="tp-product-category-content">
        <h3 class="tp-product-category-title">
          <a :href="'/category/' + category.slug">{{ capitalizeFirstLetter(category.category_name) }}</a>
        </h3>
        <p>{{ category.products.length }} Products</p>
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
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    getFirstProductImage(category) {
      // Check if the category has any products
      if (category.products.length > 0) {
        // Assuming your product has a 'image' attribute
        return category.products[0].product_image;
      }
      // If no products are available, return a default image URL or handle it accordingly
      return 'default-image-url.jpg';
    },
    capitalizeFirstLetter(str) {
      return str.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
    }
  }
};
</script>

<style>
.category-image {
  width: 76px;
  height: 98px;
  border-radius: 8px;
}

.tp-product-category-item {
  margin-bottom: 40px;
}
</style>
