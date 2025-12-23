<template>
    <section class="trending-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <div class="header-content">
                    <div class="title-block">
                        <div class="badge-row">
                            <span class="header-badge trending">
                                <i class="fas fa-fire"></i>
                                Trending Now
                            </span>
                        </div>
                        <h2 class="section-title">Best-Selling Electronics</h2>
                        <p class="section-subtitle">Trusted technology for homes, offices, and businesses</p>
                    </div>
                    <a href="/shop" class="view-all-btn">
                        <span>Explore Collection</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="state-container">
                <div class="loading-spinner">
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                    <p>Loading trending products...</p>
                </div>
            </div>

            <!-- Error State -->
            <div v-else-if="error" class="state-container">
                <div class="error-state">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>{{ error }}</p>
                    <button @click="fetchTrendingProducts" class="retry-btn">Try Again</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div v-else-if="trendingProducts.length > 0" class="products-container">
                <div class="products-grid">
                    <div 
                        v-for="(product, index) in visibleProducts" 
                        :key="product.id" 
                        class="product-card"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div class="product-image-container">
                            <a :href="'/show/product/' + product.slug" class="image-link">
                                <img 
                                    :src="product.product_image" 
                                    :alt="product.product_name" 
                                    class="product-img"
                                    loading="lazy"
                                />
                            </a>
                            
                            <div class="product-badges">
                                <span v-if="product.discount_price" class="badge sale">
                                    <i class="fas fa-tag"></i>
                                    Sale
                                </span>
                                <span v-if="product.hot_deals" class="badge hot">
                                    <i class="fas fa-fire"></i>
                                    Hot
                                </span>
                            </div>
                            
                            <div class="product-actions">
                                <button 
                                    @click.prevent="openQuickView(product)" 
                                    class="action-btn"
                                    title="Quick View"
                                >
                                    <i class="far fa-eye"></i>
                                </button>
                                <button 
                                    @click.prevent="handleAddToCart(product)" 
                                    class="action-btn primary"
                                    title="Add to Cart"
                                >
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <button class="action-btn" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>

                            <div v-if="product.discount_price" class="discount-badge">
                                {{ calculateDiscount(product.selling_price, product.discount_price) }}% OFF
                            </div>
                        </div>

                        <div class="product-info">
                            <h3 class="product-title">
                                <a :href="'/show/product/' + product.slug">{{ product.product_name }}</a>
                            </h3>
                            <div class="product-footer">
                                <div class="product-price">
                                    <template v-if="product.discount_price">
                                        <div class="price-group">
                                            <span class="current-price">Ksh {{ formatPrice(product.discount_price) }}</span>
                                            <span class="original-price">Ksh {{ formatPrice(product.selling_price) }}</span>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <span class="current-price">Ksh {{ formatPrice(product.selling_price) }}</span>
                                    </template>
                                </div>
                                <button 
                                    @click.prevent="handleAddToCart(product)" 
                                    class="quick-add-btn"
                                    title="Quick Add"
                                >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination Controls -->
                <div class="pagination-controls" v-if="totalPages > 1">
                    <button 
                        @click="prevPage" 
                        :disabled="currentPage === 0" 
                        class="pagination-btn"
                        aria-label="Previous page"
                    >
                        <i class="fas fa-chevron-left"></i>
                        Previous
                    </button>
                    
                    <div class="page-indicators">
                        <button
                            v-for="page in displayPages"
                            :key="page"
                            @click="goToPage(page)"
                            :class="['page-btn', { active: currentPage === page }]"
                        >
                            {{ page + 1 }}
                        </button>
                    </div>
                    
                    <button 
                        @click="nextPage" 
                        :disabled="currentPage >= totalPages - 1" 
                        class="pagination-btn"
                        aria-label="Next page"
                    >
                        Next
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="state-container">
                <div class="empty-state">
                    <i class="fas fa-chart-line"></i>
                    <h3>No Trending Products</h3>
                    <p>Check back soon for Best-Selling Electronics.</p>
                </div>
            </div>

            <!-- Modals -->
            <ProductModal 
                v-if="selectedProduct" 
                :product="selectedProduct" 
                @close="closeQuickView" 
            />
            <AddToCartModal 
                v-if="showAddToCartModal && productToAddToCart" 
                :product="productToAddToCart" 
                @close="closeAddToCartModal" 
            />
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import { useCartStore } from '../store/cart';
import ProductModal from './shared/ProductModal.vue';
import AddToCartModal from './shared/AddToCartModal.vue';

export default {
    name: 'TrendingProducts',
    components: {
        ProductModal,
        AddToCartModal
    },
    data() {
        return {
            trendingProducts: [],
            selectedProduct: null,
            productToAddToCart: null,
            showAddToCartModal: false,
            loading: true,
            error: null,
            currentPage: 0,
            itemsPerPage: 10
        }
    },
    computed: {
        visibleProducts() {
            const start = this.currentPage * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.trendingProducts.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.trendingProducts.length / this.itemsPerPage);
        },
        displayPages() {
            const pages = [];
            const maxVisible = 5;
            let start = Math.max(0, this.currentPage - Math.floor(maxVisible / 2));
            let end = Math.min(this.totalPages, start + maxVisible);
            
            if (end - start < maxVisible) {
                start = Math.max(0, end - maxVisible);
            }
            
            for (let i = start; i < end; i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    methods: {
        async fetchTrendingProducts() {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.get('/api/trending-products');
                this.trendingProducts = this.shuffleArray(response.data);
            } catch (error) {
                this.error = 'Failed to load trending products. Please try again later.';
                console.error('Error fetching trending products:', error);
            } finally {
                this.loading = false;
            }
        },
        shuffleArray(array) {
            return array.sort(() => Math.random() - 0.5);
        },
        formatPrice(price) {
            return parseFloat(price).toLocaleString('en-KE', { 
                minimumFractionDigits: 2,
                maximumFractionDigits: 2 
            });
        },
        calculateDiscount(original, discounted) {
            return Math.round(((original - discounted) / original) * 100);
        },
        openQuickView(product) {
            if (product) {
                this.selectedProduct = product;
                this.showAddToCartModal = false;
            }
        },
        closeQuickView() {
            this.selectedProduct = null;
        },
        handleAddToCart(product) {
            if (product) {
                const cartStore = useCartStore();
                const cartItem = {
                    id: product.id,
                    product_name: product.product_name,
                    selling_price: product.discount_price || product.selling_price,
                    product_image: product.product_image,
                    quantity: 1,
                    slug: product.slug
                };
                cartStore.addToCart(cartItem);
                this.productToAddToCart = product;
                this.showAddToCartModal = true;
                this.closeQuickView();
            }
        },
        closeAddToCartModal() {
            this.showAddToCartModal = false;
            this.productToAddToCart = null;
        },
        prevPage() {
            if (this.currentPage > 0) {
                this.currentPage--;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages - 1) {
                this.currentPage++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        goToPage(page) {
            this.currentPage = page;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    },
    mounted() {
        this.fetchTrendingProducts();
    }
}
</script>

<style scoped>
.trending-section {
    padding: 80px 0;
    background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
    position: relative;
}

.trending-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #0a609d, transparent);
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Section Header */
.section-header {
    margin-bottom: 56px;
    animation: fadeInDown 0.6s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.title-block {
    flex: 1;
}

.badge-row {
    margin-bottom: 12px;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }
}

.header-badge i {
    animation: flicker 1.5s ease-in-out infinite;
}

@keyframes flicker {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #084c74;
    margin: 0 0 8px 0;
    letter-spacing: -0.02em;
}

.section-subtitle {
    color: #6b7280;
    font-size: 1.125rem;
    margin: 0;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 28px;
    background: white;
    color: #0a609d;
    font-weight: 600;
    border: 2px solid #0a609d;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(10, 154, 115, 0.1);
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(10, 154, 115, 0.2);
}

.view-all-btn i {
    transition: transform 0.3s ease;
}

.view-all-btn:hover i {
    transform: translateX(4px);
}

/* Products Grid */
.products-container {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}

.product-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(10, 154, 115, 0.08);
    display: flex;
    flex-direction: column;
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px rgba(10, 154, 115, 0.15);
    border-color: rgba(10, 154, 115, 0.2);
}

/* Product Image */
.product-image-container {
    position: relative;
    height: 240px;
    background: linear-gradient(135deg, rgba(10, 154, 115, 0.02) 0%, rgba(6, 64, 43, 0.03) 100%);
    overflow: hidden;
}

.image-link {
    display: block;
    width: 100%;
    height: 100%;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 20px;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover .product-img {
    transform: scale(1.08);
}

.product-badges {
    position: absolute;
    top: 12px;
    left: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 2;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.badge.sale {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
}

.badge.hot {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    animation: hotPulse 1.5s ease-in-out infinite;
}

@keyframes hotPulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.discount-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #ef4444;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    z-index: 2;
}

/* Product Actions */
.product-actions {
    position: absolute;
    right: 12px;
    bottom: 12px;
    display: flex;
    gap: 8px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

.product-card:hover .product-actions {
    opacity: 1;
    transform: translateY(0);
}

.action-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #374151;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.action-btn:hover {
    background: #f3f4f6;
    transform: scale(1.1);
}

.action-btn.primary:hover {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
}

/* Product Info */
.product-info {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    flex: 1;
}

.product-title {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.6em;
}

.product-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-title a:hover {
    color: #0a609d;
}

.product-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid #f3f4f6;
}

.product-price {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.price-group {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.current-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0a609d;
    line-height: 1;
}

.original-price {
    font-size: 0.875rem;
    color: #9ca3af;
    text-decoration: line-through;
    line-height: 1;
}

.quick-add-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
}

.quick-add-btn:hover {
    transform: scale(1.1) rotate(90deg);
    box-shadow: 0 6px 16px rgba(10, 154, 115, 0.3);
}

/* Pagination */
.pagination-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    margin-top: 48px;
}

.pagination-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: white;
    color: #0a609d;
    font-weight: 600;
    border: 2px solid #0a609d;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(10, 154, 115, 0.1);
}

.pagination-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(10, 154, 115, 0.2);
}

.pagination-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    border-color: #d1d5db;
    color: #9ca3af;
}

.page-indicators {
    display: flex;
    gap: 8px;
}

.page-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: white;
    border: 1px solid #e5e7eb;
    color: #6b7280;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.page-btn:hover {
    border-color: #0a609d;
    color: #0a609d;
}

.page-btn.active {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(10, 154, 115, 0.2);
}

/* States */
.state-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 400px;
    padding: 60px 20px;
}

.loading-spinner {
    text-align: center;
}

.spinner-ring {
    width: 60px;
    height: 60px;
    margin: 0 auto 20px;
    border: 4px solid rgba(10, 154, 115, 0.1);
    border-top-color: #0a609d;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.spinner-ring:nth-child(2) {
    width: 50px;
    height: 50px;
    margin-top: -55px;
    border-top-color: #084c74;
    animation-delay: -0.3s;
}

.spinner-ring:nth-child(3) {
    width: 40px;
    height: 40px;
    margin-top: -50px;
    border-top-color: #0a609d;
    animation-delay: -0.6s;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.loading-spinner p {
    color: #6b7280;
    font-size: 1rem;
    margin-top: 20px;
}

.error-state,
.empty-state {
    text-align: center;
    max-width: 400px;
}

.error-state i {
    font-size: 4rem;
    color: #ef4444;
    margin-bottom: 20px;
}

.empty-state i {
    font-size: 4rem;
    color: #9ca3af;
    margin-bottom: 20px;
}

.error-state p,
.empty-state p {
    color: #6b7280;
    font-size: 1.125rem;
    margin: 12px 0;
}

.empty-state h3 {
    color: #374151;
    font-size: 1.5rem;
    margin: 0 0 12px 0;
}

.retry-btn {
    margin-top: 20px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.retry-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(10, 154, 115, 0.3);
}

/* Responsive */
@media (max-width: 1280px) {
    .products-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 1024px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .trending-section {
        padding: 60px 0;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .section-subtitle {
        font-size: 1rem;
    }
    
    .view-all-btn {
        width: 100%;
        justify-content: center;
    }
    
    .pagination-btn span {
        display: none;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 16px;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
    
    .product-image-container {
        height: 280px;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .page-indicators {
        gap: 4px;
    }
    
    .page-btn {
        width: 36px;
        height: 36px;
    }
}
</style>