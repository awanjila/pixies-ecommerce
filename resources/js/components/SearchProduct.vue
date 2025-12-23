<template>
  <div class="header">
    <!-- Desktop header content and styling here -->
    <div class="header-wrapper">
      <!-- Adjusted search bar container -->
      <div class="search-bar-container">
        <div class="search-bar">
          <div class="search-input-wrapper">
            <input
              type="search"
              class="search-input"
              v-model="searchQuery"
              @input="searchProducts"
              placeholder="Search Foxtrot UC....."
            />
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Floating results moved outside of the header -->
  <div class="floating-results-wrapper">
    <FloatingSearchResults :results="results" :visible="showResults" @close="hideResults"/>
  </div>


  <li class="d-lg-none">
                                    <!-- header-search-1 -->
                                    <div class="header-search-wrap">
                                        <div class="header-search-1">
                                            <div class="search-icon">
                                                <i class="icon-search  for-search-show"></i>
                                                <i class="icon-cancel  for-search-close"></i>
                                            </div>
                                        </div>
                                        <div class="header-search-1-form">
                                            <form id="#" method="get"  action="#">
                                                <input type="text" name="search" value="" placeholder="Search here..."/>
                                                <button type="submit">
                                                    <span><i class="icon-search"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
</template>

<script>
import axios from 'axios';
import FloatingSearchResults from './FloatingSearchResults.vue';

export default {
  components: {
    FloatingSearchResults,
  },
  data() {
    return {
      searchQuery: '',
      results: {
        products: [],
        message: '',
        whatsappLink: '',
      },
      showResults: false, // Control visibility of floating results
    };
  },
  methods: {
    searchProducts() {
      if (this.searchQuery.length > 2) {
        axios
          .get('/api/search', { params: { search: this.searchQuery } })
          .then((response) => {
            this.results = response.data;
            this.showResults = true;
          })
          .catch((error) => {
            console.error('Error fetching products:', error);
          });
      } else {
        this.showResults = false;
      }
    },
    hideResults() {
      this.showResults = false;
    }
  },
};
</script>

<style scoped>
.header {
  position: relative;
  width: 100%;
  /* background-color: #f8f9fa; */
}

/* Adjusted search bar styling to match requests */
.search-bar-container {
  display: flex;
  justify-content: center; /* Center the search bar within the container */
  margin-top: 40px; /* Move the search bar slightly down */
  position: relative;
  padding-bottom: 20px; /* Add some spacing for better layout */
}

.search-bar {
  width: 100%;
  max-width: 800px; /* Increase max-width for larger search bar */
  position: relative;
}

.search-input-wrapper {
  width: 100%;
}

.search-input {
  width: 100%;
  padding: 15px 20px; /* Increase padding for larger input */
  font-size: 18px; /* Increase font size */
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
}

.search-input::placeholder {
  color: #888;
}

.search-input:focus {
  border-color: #ed6a5a;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Floating results pushed down outside the header */
.floating-results-wrapper {
  position: relative;
  top: 120px; /* Adjust this value to push results down outside the header */
  z-index: 1000;
  display: flex;
  justify-content: center; /* Center the floating results container */
}

.floating-results {
  width: 100%;
  max-width: 800px; /* Keep the floating results within a fixed width */
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 10px;
  max-height: 300px;
  overflow-y: auto;
}

/* Style for each individual result */
.result-item {
  padding: 10px;
  border-bottom: 1px solid #eee;
}

.result-item:hover {
  background-color: #f9f9f9;
  cursor: pointer;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

/* Mobile specific styling adjustments */
@media (max-width: 768px) {
  .search-bar-container {
    margin-top: 5px; /* Reduce margin on mobile */
    padding-bottom: 5px; /* Reduce padding */
  }

  .search-input {
    padding: 10px 15px; /* Reduce padding for the input on mobile */
    font-size: 12px; /* Adjust font size to be slightly smaller */
  }

  .floating-results-wrapper {
    top: 80px; /* Adjust position to push the results down appropriately */
  }
}
</style>
