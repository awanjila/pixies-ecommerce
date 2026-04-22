<template>
    <section class="trending-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Trending Products</h2>
                <a href="/shop" class="view-all-link">View all</a>
            </div>

            <div v-if="loading" class="state-container">
                <p class="state-text">Loading products...</p>
            </div>

            <div v-else-if="error" class="state-container">
                <div class="error-state">
                    <p>{{ error }}</p>
                    <button @click="fetchTrendingProducts" class="retry-btn">Try Again</button>
                </div>
            </div>

            <div v-else-if="trendingProducts.length > 0" class="carousel-wrapper">
    <button class="carousel-arrow prev-arrow" @click="scrollCarousel('prev')" aria-label="Previous">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    
    <div class="carousel-container" ref="carouselContainer">
        <div class="carousel-track">
            <article v-for="product in visibleProducts" :key="product.id" class="product-card">
                <a :href="'/show/product/' + product.slug" class="product-image-link">
                    <img
                        :src="product.product_image"
                        :alt="product.product_name"
                        class="product-img"
                        loading="lazy"
                    />
                    <span v-if="product.discount_price" class="discount-pill">
                        -{{ calculateDiscount(product.selling_price, product.discount_price) }}%
                    </span>
                </a>

                <div class="product-info">
                    <h3 class="product-title">
                        <a :href="'/show/product/' + product.slug">{{ product.product_name }}</a>
                    </h3>

                    <div class="product-price">
                        <span class="current-price">
                            Ksh {{ formatPrice(product.discount_price || product.selling_price) }}
                        </span>
                        <span v-if="product.discount_price" class="original-price">
                            Ksh {{ formatPrice(product.selling_price) }}
                        </span>
                    </div>

                    <button @click.prevent="handleAddToCart(product)" class="add-to-cart-btn">
                        Add to cart
                    </button>
                </div>
            </article>
        </div>
    </div>
    
    <button class="carousel-arrow next-arrow" @click="scrollCarousel('next')" aria-label="Next">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
</div>

<div class="carousel-dots" v-if="totalDots > 1">
    <button 
        v-for="dot in totalDots" 
        :key="dot"
        :class="['dot', { active: currentDot === dot - 1 }]"
        @click="goToDot(dot - 1)"
        :aria-label="'Go to slide ' + dot"
    ></button>
</div>

            <div v-else class="state-container">
                <p class="state-text">No trending products available right now.</p>
            </div>

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
            currentDot: 0,
            productsPerSlide: 6
        }
    },
    computed: {
        visibleProducts() {
            return this.trendingProducts;
        },
        totalDots() {
            return Math.ceil(this.trendingProducts.length / this.productsPerSlide);
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
        scrollCarousel(direction) {
            const container = this.$refs.carouselContainer;
            if (!container) return;
            
            const cardWidth = container.querySelector('.product-card')?.offsetWidth || 200;
            const gap = 18;
            const scrollAmount = direction === 'next' 
                ? cardWidth * this.productsPerSlide + gap 
                : -(cardWidth * this.productsPerSlide + gap);
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        },
        goToDot(index) {
            const container = this.$refs.carouselContainer;
            if (!container) return;
            
            const cardWidth = container.querySelector('.product-card')?.offsetWidth || 200;
            const gap = 18;
            const scrollLeft = index * (cardWidth * this.productsPerSlide + gap);
            container.scrollTo({ left: scrollLeft, behavior: 'smooth' });
            this.currentDot = index;
        },
        updateCurrentDot() {
            const container = this.$refs.carouselContainer;
            if (!container) return;
            
            const cardWidth = container.querySelector('.product-card')?.offsetWidth || 200;
            const gap = 18;
            const scrollLeft = container.scrollLeft;
            this.currentDot = Math.round(scrollLeft / (cardWidth * this.productsPerSlide + gap));
        }
    },
    mounted() {
        this.fetchTrendingProducts();
        this.$nextTick(() => {
            const container = this.$refs.carouselContainer;
            if (container) {
                container.addEventListener('scroll', this.updateCurrentDot);
            }
        });
    },
    beforeUnmount() {
        const container = this.$refs.carouselContainer;
        if (container) {
            container.removeEventListener('scroll', this.updateCurrentDot);
        }
    }
}
</script>

<style scoped>
.trending-section {
    padding: 56px 0;
    background: #fff;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
}

.section-title {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    color: #171616;
}

.view-all-link {
    color: #171616;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.view-all-link:hover {
    text-decoration: underline;
}

.carousel-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 16px;
}

.carousel-container {
    flex: 1;
    overflow: hidden;
}

.carousel-track {
    display: flex;
    transition: transform 0.4s ease;
}

.carousel-arrow {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e5e5e5;
    background: #fff;
    color: #171616;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

.carousel-arrow:hover {
    background: #fafafa;
    border-color: #d9d9d9;
}

.carousel-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.dot {
    width: 10px;
    height: 10px;
    border: none;
    background: #e5e5e5;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.dot.active {
    background: #95002a;
}

.product-card {
    display: flex;
    flex-direction: column;
    border: 1px solid #e5e5e5;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    transition: box-shadow 0.2s ease, border-color 0.2s ease;
}

.product-card:hover {
    border-color: #d9d9d9;
    box-shadow: 0 8px 20px rgba(23, 22, 22, 0.08);
}

.product-image-link {
    position: relative;
    display: block;
    height: 215px;
    padding: 14px;
    background: #fff;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.discount-pill {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #171616;
    color: #fff;
    padding: 4px 8px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
}

.product-info {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 14px;
    border-top: 1px solid #e5e5e5;
    flex: 1;
}

.product-title {
    margin: 0;
    font-size: 0.92rem;
    font-weight: 600;
    line-height: 1.45;
    min-height: 2.7em;
    color: #171616;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-title a {
    color: inherit;
    text-decoration: none;
}

.product-title a:hover {
    color: #666;
}

.product-price {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 8px;
}

.current-price {
    font-size: 1.05rem;
    font-weight: 600;
    color: #171616;
}

.original-price {
    font-size: 0.85rem;
    color: #666;
    text-decoration: line-through;
}

.add-to-cart-btn {
    margin-top: auto;
    width: 100%;
    border: 1px solid #e5e5e5;
    background: #fff;
    color: #171616;
    border-radius: 6px;
    padding: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

.add-to-cart-btn:hover {
    background: #fafafa;
    border-color: #d9d9d9;
}

.state-container {
    min-height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.state-text,
.error-state p {
    margin: 0;
    color: #666;
    font-size: 1rem;
}

.retry-btn {
    margin-top: 12px;
    border: 1px solid #e5e5e5;
    background: #fff;
    color: #171616;
    border-radius: 6px;
    padding: 8px 14px;
    font-weight: 600;
    cursor: pointer;
}

.retry-btn:hover {
    background: #fafafa;
}

@media (max-width: 1200px) {
    .carousel-track {
        gap: 16px;
    }
}

@media (max-width: 992px) {
    .carousel-track {
        gap: 14px;
    }
}

@media (max-width: 768px) {
    .trending-section {
        padding: 42px 0;
    }

    .section-title {
        font-size: 1.45rem;
    }

    .carousel-track {
        gap: 12px;
    }

    .product-image-link {
        height: 190px;
    }

    .carousel-arrow {
        width: 38px;
        height: 38px;
    }
}

@media (max-width: 540px) {
    .container {
        padding: 0 14px;
    }

    .section-header {
        margin-bottom: 18px;
    }

    .carousel-arrow {
        display: none;
    }

    .carousel-track {
        gap: 10px;
    }
}
</style>