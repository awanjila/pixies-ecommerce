<template>
    <div class="header-search-2 position-relative">
        <input 
            type="text" 
            v-model="searchQuery" 
            @input="searchProducts"
            placeholder="I am looking for..."
            class="search-input"
        />
        <button type="submit" class="search-button">
            <span><i class="icon-search"></i></span>
        </button>

        <!-- Search Results Dropdown -->
        <div v-if="showResults" class="search-results-dropdown">
            <div v-if="loading" class="text-center p-2">
                Searching...
            </div>
            <div v-else-if="products.length > 0" class="product-list">
                <div 
                    v-for="product in products" 
                    :key="product.id" 
                    class="product-item p-2"
                    @click="goToProduct(product)"
                >
                    <img :src="getImagePath(product.product_image)" class="product-thumb" />
                    <div class="product-info">
                        <div class="product-name">{{ product.product_name }}</div>
                        <div class="product-price">KES {{ product.selling_price }}</div>
                    </div>
                </div>
            </div>
            <div v-else-if="searchQuery.length >= 3" class="no-results p-3">
                <p class="mb-2">Product not found</p>
                <a 
                    :href="whatsappLink" 
                    target="_blank" 
                    class="whatsapp-btn"
                >
                    <i class="fab fa-whatsapp"></i> WhatsApp Us for Enquiry
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import axios from 'axios'

export default {
    name: 'Search',
    setup() {
        const searchQuery = ref('')
        const products = ref([])
        const loading = ref(false)
        const showResults = ref(false)

        const whatsappLink = computed(() => {
            return `https://wa.me/254710909198?text=Hello, I'm looking for ${searchQuery.value}`
        })

        const getImagePath = (imagePath) => {
            return imagePath.startsWith('/') ? imagePath : `/${imagePath}`
        }

        const searchProducts = async () => {
            if (searchQuery.value.length >= 3) {
                loading.value = true
                showResults.value = true

                try {
                    const response = await axios.get(`/api/search-products?query=${searchQuery.value}`)
                    products.value = response.data
                } catch (error) {
                    console.error('Search error:', error)
                    products.value = []
                } finally {
                    loading.value = false
                }
            } else {
                showResults.value = false
                products.value = []
            }
        }

        const goToProduct = (product) => {
            window.location.href = `/show/product/${product.slug}`
            showResults.value = false
        }

        watch(showResults, (newValue) => {
            if (newValue) {
                document.body.classList.add('search-results-visible')
            } else {
                document.body.classList.remove('search-results-visible')
            }
        })

        onMounted(() => {
            // Any other mounted logic if needed
        })

        onUnmounted(() => {
            document.body.classList.remove('search-results-visible')
        })

        return {
            searchQuery,
            products,
            loading,
            showResults,
            whatsappLink,
            searchProducts,
            goToProduct,
            getImagePath
        }
    }
}
</script>

<style scoped>
.header-search-2 {
    position: relative;
    width: 100%;
    margin: 0 auto;
}

/* Responsive search input */
.search-input {
    width: 100%;
    padding: 8px 40px 8px 15px;
    border: 1px solid #eee;
    border-radius: 4px;
    font-size: 14px;
}

/* Search button positioning */
.search-button {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    padding: 0 15px;
    background: transparent;
    border: none;
    cursor: pointer;
}

/* Dropdown positioning and responsiveness */
.search-results-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
    margin-top: 5px;
}

.product-item {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    transition: background 0.3s;
    padding: 10px;
}

.product-item:hover {
    background: #f5f5f5;
}

.product-thumb {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
}

.product-info {
    flex: 1;
    min-width: 0; /* Prevents text overflow */
}

.product-name {
    font-size: 14px;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-price {
    font-size: 13px;
    color: #666;
}

.whatsapp-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25D366;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    transition: background 0.3s;
    font-size: 14px;
    justify-content: center;
    width: 100%;
}

.whatsapp-btn:hover {
    background: #128C7E;
    color: white;
}

/* Mobile-specific styles */
@media (max-width: 768px) {
    .header-search-2 {
        width: 100%;
        padding: 0 15px;
    }

    .search-input {
        width: 100%;
        padding-right: 40px;
    }

    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 60vh;
        border-radius: 4px;
        z-index: 1001;
        margin-top: 5px;
        border: 1px solid #eee;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .product-list {
        max-height: calc(60vh - 60px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        background: white;
    }

    .product-item {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .search-results-dropdown::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: -1;
    }

    .search-button {
        right: 15px;
    }
}

/* Add styles for search results container */
.search-results-container {
    background: white;
    position: relative;
    z-index: 1002;
    height: 100%;
    overflow-y: auto;
}

/* Prevent body scroll when dropdown is open */
body.search-results-visible {
    overflow: hidden;
}
</style> 