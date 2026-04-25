<template>
    <div class="search-icon-wrapper" ref="searchRef">
        <!-- Search Icon Button -->
        <button class="search-toggle" @click="toggleSearch">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
        </button>

        <!-- Search Overlay -->
        <div v-if="isOpen" class="search-overlay">
            <div class="search-modal">
                <div class="search-header">
                    <input 
                        ref="searchInput"
                        type="text" 
                        v-model="searchQuery" 
                        @input="searchProducts"
                        placeholder="Search products..."
                        class="search-field"
                        autofocus
                    />
                    <button class="search-close" @click="closeSearch">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Search Results -->
                <div class="search-body">
                    <div v-if="loading" class="search-loading">
                        Searching...
                    </div>
                    <div v-else-if="products.length > 0" class="search-results">
                        <a 
                            v-for="product in products" 
                            :key="product.id" 
                            :href="`/show/product/${product.slug}`" 
                            class="search-result-item"
                            @click="isOpen = false"
                        >
                            <img :src="getImagePath(product.product_image)" class="result-thumb" />
                            <div class="result-info">
                                <div class="result-name">{{ product.product_name }}</div>
                                <div class="result-price">KES {{ product.selling_price }}</div>
                            </div>
                        </a>
                    </div>
                    <div v-else-if="searchQuery.length >= 2" class="no-results">
                        <p>No products found</p>
                        <a :href="whatsappLink" target="_blank" class="whatsapp-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.347-.362.603-.65.773-.044.15-.444.268-.802.477-.274.139-.539.348-.794.606-.254.257-.498.558-.509.689-.013.153-.092.35-.014.492.014.142.206.412.443.62.237.208.508.268.508.268.03-.005.342-.058.567-.298.221-.226.371-.498.371-.694 0-.196-.028-.392-.061-.558-.099-.495-.513-.874-1.027-1.133-.659-.333-1.445-.497-2.187-.497-.585 0-1.103.12-1.568.428-.465.309-1.035.946-1.183 1.124-.151.179-.445.238-.683.238-.238 0-.476-.02-.683-.02-.206-.01.395-.122.868-.444.473-.322 1.008-.789 1.199-1.115.187-.334.249-.535.341-.765.093-.223.023-.424.012-.548-.012-.126-.124-.238-.261-.338m-5.680 5.145l-.252-.122C9.532 17.821 8.622 17.288 8.45 16.823c-.084-.233-.321-.394-.593-.394-.268 0-.535.04-.775.113-.238.073-.496.194-.705.37-.209.174-.446.424-.446.424l-.923-.229s-.437-.111-.509-.379c-.072-.269.073-.771.263-1.105.19-.334.532-.773.839-1.113.307-.34.665-.695 1.013-1.059.348-.364.593-.364.593-.364l.672.056s.433-.052.833.113c.4.165 1.005.593 1.381 1.137.375.545.636 1.004.636 1.004l.161.641s.033-.228-.097-.517"/>
                            </svg>
                            WhatsApp for enquiry
                        </a>
                    </div>
                    <div v-else class="search-hint">
                        <p>Type to search products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
import axios from 'axios'

export default {
    name: 'Search',
    setup() {
        const searchQuery = ref('')
        const products = ref([])
        const loading = ref(false)
        const isOpen = ref(false)
        const searchInput = ref(null)
        const searchRef = ref(null)

        const whatsappLink = computed(() => {
            return `https://wa.me/254710909198?text=Hello, I'm looking for ${searchQuery.value}`
        })

        const getImagePath = (imagePath) => {
            return imagePath.startsWith('/') ? imagePath : `/${imagePath}`
        }

        const toggleSearch = async () => {
            if (isOpen.value) {
                closeSearch()
            } else {
                isOpen.value = true
                await nextTick()
                searchInput.value?.focus()
            }
        }

        const closeSearch = () => {
            isOpen.value = false
            searchQuery.value = ''
            products.value = []
        }

        const searchProducts = async () => {
            if (searchQuery.value.length >= 2) {
                loading.value = true
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
                products.value = []
            }
        }

        onMounted(() => {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isOpen.value) {
                    closeSearch()
                }
            })
        })

        return {
            searchQuery,
            products,
            loading,
            isOpen,
            searchInput,
            searchRef,
            whatsappLink,
            toggleSearch,
            closeSearch,
            searchProducts,
            getImagePath
        }
    }
}
</script>

<style scoped>
.search-icon-wrapper {
    position: relative;
}

.search-toggle {
    background: none;
    border: none;
    cursor: pointer;
    color: #171616;
    padding: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    transition: background 0.2s ease;
}

.search-toggle:hover {
    background: #f5f5f5;
}

.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 80px;
}

.search-modal {
    background: #fff;
    border-radius: 8px;
    width: 100%;
    max-width: 560px;
    margin: 0 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.search-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    border-bottom: 1px solid #e5e5e5;
}

.search-field {
    flex: 1;
    border: none;
    font-size: 16px;
    font-family: inherit;
    outline: none;
    background: transparent;
}

.search-field::placeholder {
    color: #999;
}

.search-close {
    background: none;
    border: none;
    cursor: pointer;
    color: #666;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-close:hover {
    color: #1a1a1a;
}

.search-body {
    max-height: 60vh;
    overflow-y: auto;
}

.search-loading {
    padding: 32px;
    text-align: center;
    color: #666;
}

.search-results {
    padding: 8px;
}

.search-result-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.15s ease;
}

.search-result-item:hover {
    background: #f5f5f5;
}

.result-thumb {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 4px;
}

.result-info {
    flex: 1;
    min-width: 0;
}

.result-name {
    font-size: 14px;
    color: #1a1a1a;
    font-weight: 500;
}

.result-price {
    font-size: 13px;
    color: #666;
    margin-top: 2px;
}

.no-results,
.search-hint {
    padding: 32px;
    text-align: center;
    color: #666;
}

.whatsapp-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
    color: #25D366;
    text-decoration: none;
    font-size: 13px;
}

.whatsapp-link:hover {
    text-decoration: underline;
}
</style> 