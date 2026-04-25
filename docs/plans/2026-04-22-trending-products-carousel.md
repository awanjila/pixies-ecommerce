# TrendingProducts Carousel Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Convert TrendingProducts.vue from paginated grid to carousel showing 6 products with rounded corners and padding.

**Architecture:** Use CSS scroll-snap for smooth horizontal scrolling, with arrow buttons and dot navigation for controlling scroll position.

**Tech Stack:** Vue.js, CSS scroll-snap, vanilla JS for carousel logic.

---

### Task 1: Modify TrendingProducts.vue Template

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\TrendingProducts.vue:1-104`

**Step 1: Update template to carousel structure**

Replace the products-grid div with carousel structure:

```vue
<div class="carousel-wrapper">
    <button class="carousel-arrow prev-arrow" @click="scrollCarousel('prev')" aria-label="Previous">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    
    <div class="carousel-container" ref="carouselContainer">
        <div class="carousel-track">
            <article v-for="product in trendingProducts" :key="product.id" class="product-card">
                <!-- existing product card content -->
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
```

**Step 2: Commit changes**

```bash
git add resources/js/components/TrendingProducts.vue
git commit -m "feat: add carousel structure to TrendingProducts"
```

---

### Task 2: Update Script Section

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\TrendingProducts.vue:106-231`

**Step 1: Add carousel data and methods**

Replace `itemsPerPage` and pagination computed with:

```javascript
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
    scrollCarousel(direction) {
        const container = this.$refs.carouselContainer;
        const cardWidth = container.querySelector('.product-card').offsetWidth + 18; // include gap
        const scrollAmount = direction === 'next' ? cardWidth * this.productsPerSlide : -cardWidth * this.productsPerSlide;
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    },
    goToDot(index) {
        const container = this.$refs.carouselContainer;
        const cardWidth = container.querySelector('.product-card').offsetWidth + 18;
        container.scrollTo({ left: index * cardWidth * this.productsPerSlide, behavior: 'smooth' });
        this.currentDot = index;
    },
    updateCurrentDot() {
        const container = this.$refs.carouselContainer;
        const cardWidth = container.querySelector('.product-card').offsetWidth + 18;
        const scrollLeft = container.scrollLeft;
        this.currentDot = Math.round(scrollLeft / (cardWidth * this.productsPerSlide));
    },
    // Remove pagination methods: prevPage, nextPage, goToPage
}
```

**Step 2: Add scroll listener in mounted**

```javascript
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
```

**Step 3: Commit**

```bash
git add resources/js/components/TrendingProducts.vue
git commit -m "feat: add carousel scroll logic to TrendingProducts"
```

---

### Task 3: Update Styles for Carousel

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\TrendingProducts.vue:234-506`

**Step 1: Replace pagination styles with carousel styles**

```css
.carousel-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0;
}

.carousel-container {
    flex: 1;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    -ms-overflow-style: none;
    margin: 0 40px;
}

.carousel-container::-webkit-scrollbar {
    display: none;
}

.carousel-track {
    display: flex;
    gap: 18px;
    padding: 4px 0;
}

.product-card {
    flex: 0 0 calc((100% - (5 * 18px)) / 6);
    min-width: calc((100% - (5 * 18px)) / 6);
    border-radius: 12px;
    padding: 16px;
    scroll-snap-align: start;
}

.carousel-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border: 1px solid #e5e5e5;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.2s ease;
    color: #171616;
}

.carousel-arrow:hover {
    background: #95002a;
    border-color: #95002a;
    color: #fff;
}

.prev-arrow {
    left: 0;
}

.next-arrow {
    right: 0;
}

.carousel-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 24px;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 1px solid #95002a;
    background: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    padding: 0;
}

.dot.active {
    background: #95002a;
}

.dot:hover {
    background: #95002a;
}

/* Remove pagination-controls styles */
/* Update responsive */
@media (max-width: 1200px) {
    .product-card {
        flex: 0 0 calc((100% - (3 * 18px)) / 4);
        min-width: calc((100% - (3 * 18px)) / 4);
    }
}

@media (max-width: 992px) {
    .product-card {
        flex: 0 0 calc((100% - (2 * 18px)) / 3);
        min-width: calc((100% - (2 * 18px)) / 3);
    }
}

@media (max-width: 768px) {
    .product-card {
        flex: 0 0 calc((100% - 18px) / 2);
        min-width: calc((100% - 18px) / 2);
    }
    
    .carousel-container {
        margin: 0 36px;
    }
    
    .carousel-arrow {
        width: 36px;
        height: 36px;
    }
}
```

**Step 2: Commit**

```bash
git add resources/js/components/TrendingProducts.vue
git commit -m "feat: add carousel styles to TrendingProducts"
```

---

### Task 4: Test the Changes

**Step 1: Run the development server**

```bash
npm run dev
```

**Step 2: Verify in browser**
- Carousel displays 6 products on desktop
- Arrow buttons scroll left/right
- Dots navigate to correct positions
- Responsive breakpoints work correctly

**Step 3: Commit final**

```bash
git add resources/js/components/TrendingProducts.vue
git commit -m "feat: complete TrendingProducts carousel implementation"
```
