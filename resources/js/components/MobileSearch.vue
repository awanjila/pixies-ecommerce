<template>
    <div class="mobile-search">
        <div class="search-container">
            <input 
                type="text" 
                v-model="searchQuery" 
                @input="searchProducts"
                placeholder="Search products..."
                class="search-input"
            />
            <button type="submit" class="search-button">
                <i class="icon-search"></i>
            </button>
        </div>

        <!-- Search Results -->
        <div v-if="showResults" class="search-results">
            <div v-if="loading" class="search-loading">
                <span>Searching...</span>
            </div>
            
            <div v-else-if="products.length > 0" class="results-list">
                <div 
                    v-for="product in products" 
                    :key="product.id" 
                    class="result-item"
                    @click="goToProduct(product)"
                >
                    <img :src="getImagePath(product.product_image)" class="product-image" />
                    <div class="product-details">
                        <div class="product-name">{{ product.product_name }}</div>
                        <div class="product-price">KES {{ product.selling_price }}</div>
                    </div>
                </div>
            </div>
            
            <div v-else-if="searchQuery.length >= 3" class="no-results">
                <p>Product not found</p>
                <a :href="whatsappLink" target="_blank" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> 
                    WhatsApp Us for Enquiry
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
.mobile-search {
    position: relative;
    padding: 16px;
    background: white;
    border-bottom: 1px solid #eee;
}

.search-container {
    position: relative;
    width: 100%;
}

.search-input {
    width: 100%;
    height: 44px;
    padding: 0 44px 0 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f9fafb;
    color: #1f2937;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #0a609d;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 75, 31, 0.1);
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-button {
    position: absolute;
    right: 0;
    top: 0;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: color 0.2s ease;
}

.search-button:hover {
    color: #0a609d;
}

/* Search Results */
.search-results {
    position: absolute;
    left: 16px;
    right: 16px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-top: 8px;
    max-height: calc(100vh - 250px);
    overflow-y: auto;
    z-index: 10;
}

.search-loading {
    padding: 16px;
    text-align: center;
    color: #6b7280;
}

.results-list {
    padding: 8px 0;
}

.result-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border-bottom: 1px solid #f3f4f6;
}

.result-item:hover {
    background-color: #f9fafb;
}

.product-image {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 6px;
}

.product-details {
    flex: 1;
    min-width: 0;
}

.product-name {
    font-size: 0.875rem;
    color: #1f2937;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-price {
    font-size: 0.813rem;
    color: #0a609d;
    font-weight: 500;
}

.no-results {
    padding: 16px;
    text-align: center;
}

.no-results p {
    color: #6b7280;
    margin-bottom: 12px;
}

.whatsapp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: calc(100% - 32px);
    padding: 12px;
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
    color: white;
    font-size: 0.875rem;
    font-weight: 500;
    border-radius: 8px;
    text-decoration: none;
    transition: transform 0.2s ease;
}

.whatsapp-button:hover {
    transform: translateY(-1px);
}

/* Custom Scrollbar */
.search-results::-webkit-scrollbar {
    width: 4px;
}

.search-results::-webkit-scrollbar-track {
    background: #f3f4f6;
}

.search-results::-webkit-scrollbar-thumb {
    background: #0a609d;
    border-radius: 2px;
}

/* Mobile Optimization */
@media (max-width: 768px) {
    .search-results {
        position: absolute;
        left: 0;
        right: 0;
        margin: 8px 16px;
        max-height: 60vh;
    }
}
</style> 