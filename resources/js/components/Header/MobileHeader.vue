<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import ShowCart from '../ShowCart.vue';
import MobileSearch from '../MobileSearch.vue';
import axios from 'axios';

const isMenuOpen = ref(false);
const isScrolled = ref(false);
const categories = ref([]);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
    if (isMenuOpen.value) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
};

const closeMenu = () => {
    isMenuOpen.value = false;
    document.body.style.overflow = '';
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
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
    fetchCategories();
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    document.body.style.overflow = '';
});
</script>

<template>
    <header class="mobile-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <a href="tel:+254798742543" class="contact-link">
                        <span>+254 798 742 543</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header" :class="{ 'is-scrolled': isScrolled }">
            <div class="container">
                <div class="header-content">
                    <button @click="toggleMenu" class="menu-btn" aria-label="Open menu">
                        <i class="fas fa-bars"></i>
                    </button>

                    <a href="/" class="logo-link">
                        <img src="/front-assets/img/brand-logo/logo.png" alt="Pixies Technologies" class="logo">
                    </a>

                    <div class="header-actions">
                        <ShowCart />
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="menu-overlay" :class="{ 'is-visible': isMenuOpen }" @click="closeMenu"></div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" :class="{ 'is-open': isMenuOpen }">
            <div class="menu-header">
                <div class="menu-header-content">
                    <img src="/front-assets/img/brand-logo/logo.png" alt="Logo" class="menu-logo">
                    <span class="menu-title">Pixies Technologies</span>
                </div>
                <button @click="closeMenu" class="close-btn" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Search -->
            <div class="menu-search">
                <MobileSearch />
            </div>

            <!-- Navigation -->
            <nav class="menu-nav">
                <a href="/" class="nav-item" @click="closeMenu">
                    <span>Home</span>
                </a>
                <a href="/shop" class="nav-item" @click="closeMenu">
                    <span>Shop All</span>
                </a>
                
                <div class="nav-divider">Categories</div>
                
                <a v-for="category in categories" :key="category.id" :href="`/category/${category.slug}`" class="nav-item" @click="closeMenu">
                    <span>{{ category.category_name }}</span>
                </a>
                
                <div class="nav-divider">Information</div>
                
                <a href="/contact/us" class="nav-item" @click="closeMenu">
                    <span>Contact Us</span>
                </a>
                <a href="/about" class="nav-item" @click="closeMenu">
                    <span>About Us</span>
                </a>
                <a href="/shipping" class="nav-item" @click="closeMenu">
                    <span>Shipping</span>
                </a>
                <a href="/faqs" class="nav-item" @click="closeMenu">
                    <span>FAQs</span>
                </a>
            </nav>

            <!-- Menu Footer -->
            <div class="menu-footer">
                <div class="contact-row">
                    <a href="tel:+254798742543" class="footer-link">
                        <i class="fas fa-phone-alt"></i>
                        <span>+254 798 742 543</span>
                    </a>
                    <a href="mailto:info@pixies.co.ke" class="footer-link">
                        <i class="fas fa-envelope"></i>
                        <span>info@pixies.co.ke</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>
.mobile-header {
    display: block;
}

@media (min-width: 768px) {
    .mobile-header {
        display: none;
    }
}

/* Top Bar */
.top-bar {
    background: #171616;
    padding: 8px 0;
    font-size: 0.8125rem;
}

.container {
    padding: 0 16px;
}

.top-bar-content {
    display: flex;
    justify-content: center;
}

.contact-link {
    color: white;
    text-decoration: none;
    font-weight: 500;
}

/* Main Header */
.main-header {
    background: white;
    padding: 12px 0;
    position: sticky;
    top: 0;
    z-index: 40;
    border-bottom: 1px solid #e5e5e5;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.menu-btn {
    background: none;
    border: none;
    color: #171616;
    font-size: 1.25rem;
    padding: 8px;
    cursor: pointer;
}

.logo-link {
    display: block;
}

.logo {
    height: 50px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Menu Overlay */
.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 49;
}

.menu-overlay.is-visible {
    opacity: 1;
    visibility: visible;
}

/* Mobile Menu */
.mobile-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 85%;
    max-width: 320px;
    height: 100vh;
    background: white;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
    z-index: 50;
    display: flex;
    flex-direction: column;
}

.mobile-menu.is-open {
    transform: translateX(0);
}

.menu-header {
    background: #171616;
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.menu-header-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.menu-logo {
    height: 28px;
    filter: brightness(0) invert(1);
}

.menu-title {
    color: white;
    font-weight: 600;
    font-size: 0.9375rem;
}

.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 1.25rem;
    padding: 8px;
    cursor: pointer;
}

/* Menu Search */
.menu-search {
    padding: 12px 16px;
    border-bottom: 1px solid #e5e5e5;
}

/* Menu Navigation */
.menu-nav {
    flex: 1;
    overflow-y: auto;
    padding: 0;
}

.nav-item {
    display: block;
    padding: 14px 16px;
    color: #171616;
    text-decoration: none;
    font-size: 0.9375rem;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.2s ease;
}

.nav-item:hover {
    background: #f9fafb;
}

.nav-item:active {
    background: #171616;
    color: white;
}

.nav-divider {
    padding: 12px 16px 8px;
    font-size: 0.6875rem;
    font-weight: 600;
    color: #95002a;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: #f9fafb;
}

/* Menu Footer */
.menu-footer {
    padding: 16px;
    border-top: 1px solid #e5e5e5;
    background: #f9fafb;
}

.contact-row {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.footer-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
    text-decoration: none;
    font-size: 0.875rem;
}

.footer-link i {
    color: #95002a;
    width: 16px;
}

.footer-link:hover {
    color: #95002a;
}

@media (max-width: 360px) {
    .mobile-menu {
        width: 90%;
    }
}
</style>