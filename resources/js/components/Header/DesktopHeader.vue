<template>
    <header class="desktop-header">
        <!-- Main Header - Row 1 -->
        <div class="main-header" :class="{ 'is-sticky': isScrolled }">
            <div class="container">
                <div class="header-row-1">
                    <!-- Search Icon -->
                    <Search />

                    <!-- Logo (Center, Bigger) -->
                    <div class="logo-wrapper">
                        <a href="/" class="logo-link">
                            <img src="/front-assets/img/brand-logo/logo.png" alt="Pixies Technologies" class="logo">
                        </a>
                    </div>

                    <!-- Cart -->
                    <ShowCart />
                </div>
            </div>
        </div>

        <!-- Row 2: Categories & Nav -->
        <div class="header-row-2">
            <div class="container">
                <div class="header-row-2-content">
                    <!-- Categories -->
                    <nav class="categories-nav">
                        <a 
                            v-for="category in categories" 
                            :key="category.id" 
                            :href="`/category/${category.slug}`" 
                            class="category-link"
                        >
                            {{ category.category_name }}
                        </a>
                    </nav>

                    <!-- Nav Links -->
                    <nav class="header-nav">
                        <a href="/shop" class="nav-link" :class="{ active: currentPath === '/shop' }">Shop All</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';
import Search from '../Search.vue';
import ShowCart from '../ShowCart.vue';
import axios from 'axios';

export default {
    name: 'DesktopHeader',
    components: {
        Search,
        ShowCart
    },
    setup() {
        const isScrolled = ref(false);
        const currentPath = ref('/');
        const categories = ref([]);

        const handleScroll = () => {
            isScrolled.value = window.scrollY > 50;
        };

        const updateCurrentPath = () => {
            currentPath.value = window.location.pathname;
        };

        const fetchCategories = async () => {
            try {
                const response = await axios.get('/api/wabegadgets/categories');
                if (response.data.categories) {
                    categories.value = response.data.categories.filter(category => 
                        category.category_name.toLowerCase() !== 'root' &&
                        category.products?.length > 0
                    );
                }
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };

        onMounted(() => {
            window.addEventListener('scroll', handleScroll);
            updateCurrentPath();
            fetchCategories();
        });

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });

        return {
            isScrolled,
            currentPath,
            categories
        };
    }
}
</script>

<style scoped>
.desktop-header {
    display: none;
}

@media (min-width: 768px) {
    .desktop-header {
        display: block;
    }
}

.main-header {
    background: #ffffff;
    padding: 14px 0;
    transition: all 0.3s ease;
    position: relative;
    z-index: 100;
}

.main-header.is-sticky {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    padding: 10px 0;
    border-bottom: 3px solid #95002a;
}

.header-row-2 {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
}

.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0 15px;
}

.header-row-1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo-wrapper {
    flex: 1;
    display: flex;
    justify-content: center;
}

.logo-link {
    display: block;
    transition: opacity 0.2s ease;
}

.logo-link:hover {
    opacity: 0.85;
}

.logo {
    height: 60px;
    width: auto;
}

.main-header.is-sticky .logo {
    height: 45px;
}

.header-row-2-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    padding: 10px 0;
}

.categories-nav {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    justify-content: center;
}

.category-link {
    color: #171616;
    text-decoration: none;
    font-size: 13px;
    font-weight: 400;
    letter-spacing: 0.3px;
    white-space: nowrap;
    transition: color 0.2s ease;
}

.category-link:hover {
    color: #95002a;
}

.header-nav {
    display: flex;
    align-items: center;
}

.header-nav .nav-link {
    color: #171616;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: color 0.2s ease;
}

.header-nav .nav-link:hover,
.header-nav .nav-link.active {
    color: #95002a;
}

@media (max-width: 1024px) {
    .logo {
        height: 60px;
    }
    
    .categories-nav {
        gap: 2px;
    }
    
    .category-link {
        font-size: 12px;
        padding: 6px 10px;
    }
    
    .header-nav .nav-link {
        font-size: 13px;
    }
}

@media (max-width: 768px) {
    .desktop-header {
        display: none;
    }
}
</style>