<template>
    <nav class="secondary-nav">
      <ul class="secondary-menu">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Shop By Category</a>
          <ul class="dropdown-menu">
            <li v-for="category in categories" :key="category.id">
              <a :href="`/category/${category.slug}`">{{ capitalizeFirstLetter(category.category_name) }}</a>
            </li>
          </ul>
        </li>
        <li><a href="#">News & Updates</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
      <div class="free-shipping">
        Free Shipping on Orders Kes 10000+
      </div>
    </nav>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        categories: [],
      };
    },
    methods: {
      async fetchCategories() {
        try {
          const response = await axios.get('api/wabegadgets/categories');
          this.categories = response.data.categories;
        } catch (error) {
          console.error('Error fetching categories:', error);
        }
      },
      capitalizeFirstLetter(text) {
        return text
          ? text.charAt(0).toUpperCase() + text.slice(1).toLowerCase()
          : '';
      }
    },
    mounted() {
      this.fetchCategories();
    }
  };
  </script>
  
  <style scoped>
  .secondary-nav {
    background-color: #f8f9fa;
    padding: 10px 20px;
    border-top: 1px solid #ebebeb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1300px;
    margin: 0 auto;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  
  /* Hide on mobile */
  @media (max-width: 768px) {
    .secondary-nav {
      display: none;
    }
  }
  
  .secondary-menu {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0;
  }
  
  .secondary-menu li {
    position: relative;
    margin-right: 30px;
  }
  
  .secondary-menu li a {
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    text-transform: capitalize; /* Ensures only the first letter is capital */
    transition: color 0.3s ease;
    padding: 8px 15px;
  }
  
  .secondary-menu li a:hover {
    color: #ffd700;
  }
  
  /* Dropdown Toggle */
  .dropdown-toggle {
    background-color: #ffd700;
    padding: 10px 15px;
    font-size: 14px;
    color: #fff;
    border-radius: 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .dropdown-toggle:hover {
    background-color: #e0b000;
  }
  
  /* Dropdown Menu */
  .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    width: 250px;
    z-index: 999;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .dropdown:hover .dropdown-menu {
    display: block;
  }
  
  .dropdown-menu li {
    padding: 10px;
    border-bottom: 1px solid #ebebeb;
  }
  
  .dropdown-menu li:last-child {
    border-bottom: none;
  }
  
  .dropdown-menu li a {
    color: #333;
    display: block;
    width: 100%;
    white-space: nowrap; /* Ensure categories fit on one line */
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
  .dropdown-menu li:hover {
    background-color: #fff;
    color: #fff;
  }
  
  /* Free Shipping */
  .free-shipping {
    font-size: 14px;
    color: #333;
    font-weight: bold;
    text-align: right;
    white-space: nowrap;
    padding-right: 20px;
  }
  </style>
  