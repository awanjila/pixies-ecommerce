<template>
    <header class="desktop-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <div class="top-bar-left">
                        <div class="contact-info">
                            <a href="tel:+254710909198" class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+254 710 909 198</span>
                            </a>
                            <a href="mailto:info@wabegadgets.co.ke" class="contact-item">
                                <i class="far fa-envelope"></i>
                                <span>info@wabegadgets.co.ke</span>
                            </a>
                        </div>
                    </div>
                    <div class="top-bar-right">
                        <div class="trust-badge">
                            <i class="fas fa-shield-check"></i>
                            <span>ISO Certified Medical Equipment</span>
                        </div>
                        <div class="social-icons">
                            <a href="#" class="social-link facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link twitter" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link linkedin" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header" :class="{ 'is-sticky': isScrolled }">
            <div class="container">
                <div class="header-content">
                    <div class="logo-wrapper">
                        <a href="/" class="logo-link">
                            <img src="/front-assets/img/brand-logo/logo.png" alt="Medical Equipment Logo" class="logo">
                    
                        </a>
                    </div>

                    <div class="header-center">
                        <div class="contact-blocks">
                            <div class="contact-block">
                                <div class="icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="info">
                                    
                                    <a href="tel:+254710909198" class="value">+254 710 909 198</a>
                                </div>
                            </div>
                        </div>
                        <Search />
                    </div>

                    <div class="header-actions">
                       
                        
                        <ShowCart />
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="main-nav" :class="{ 'is-sticky': isScrolled }">
            <div class="container">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="/" class="nav-link" :class="{ active: currentPath === '/' }">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/shop" class="nav-link" :class="{ active: currentPath === '/shop' }">
                            <i class="fas fa-store"></i>
                            <span>Shop</span>
                        </a>
                    </li>
                    
                    <!-- Random Categories -->
                    <li v-for="category in randomCategories" :key="category.id" class="nav-item">
                        <a :href="`/category/${category.slug}`" class="nav-link">
                            <i class="fas fa-microchip"></i>
                            <span>{{ category.category_name }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/about/us" class="nav-link" :class="{ active: currentPath === '/about' }">
                            <i class="fas fa-info-circle"></i>
                            <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact/us" class="nav-link" :class="{ active: currentPath === '/contact/us' }">
                            <i class="fas fa-envelope"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
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
        const randomCategories = ref([]);
        const currentPath = ref('/');

        const handleScroll = () => {
            isScrolled.value = window.scrollY > 50;
        };

        const fetchRandomCategories = async () => {
            try {
                const response = await axios.get('/api/wabegadgets/categories');
                if (response.data.categories) {
                    const activeCategories = response.data.categories.filter(category => 
                        !(category.id === 1 && category.category_name.toLowerCase() === 'root') &&
                        category.products?.length > 0
                    );
                    randomCategories.value = activeCategories
                        .sort(() => Math.random() - 0.5)
                        .slice(0, 4);
                }
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };

        const updateCurrentPath = () => {
            currentPath.value = window.location.pathname;
        };

        onMounted(() => {
            window.addEventListener('scroll', handleScroll);
            updateCurrentPath();
            fetchRandomCategories();
        });

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });

        return {
            isScrolled,
            randomCategories,
            currentPath
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

/* Top Bar */
.top-bar {
    background: linear-gradient(135deg, #084c74 0%, #0a609d 100%);
    padding: 10px 0;
    font-size: 0.875rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.top-bar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-bar-left,
.top-bar-right {
    display: flex;
    align-items: center;
    gap: 24px;
}

.contact-info {
    display: flex;
    align-items: center;
    gap: 24px;
}

.contact-item {
    color: rgba(255, 255, 255, 0.95);
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 4px 8px;
    border-radius: 6px;
}

.contact-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.contact-item i {
    font-size: 0.875rem;
}

.trust-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 12px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    color: white;
    font-weight: 600;
    font-size: 0.8125rem;
}

.trust-badge i {
    color: #fbbf24;
}

.social-icons {
    display: flex;
    gap: 8px;
}

.social-link {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    color: white;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-link:hover {
    background: white;
    transform: translateY(-2px);
}

.social-link.facebook:hover {
    color: #1877f2;
}

.social-link.twitter:hover {
    color: #1da1f2;
}

.social-link.instagram:hover {
    color: #e4405f;
}

.social-link.linkedin:hover {
    color: #0077b5;
}

/* Main Header */
.main-header {
    background: white;
    padding: 20px 0;
    border-bottom: 1px solid #e5e7eb;
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
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 12px 0;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
}

/* Logo */
.logo-wrapper {
    flex-shrink: 0;
}

.logo-link {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.logo-link:hover {
    transform: scale(1.02);
}

.logo {
    height: 70px;
    width: auto;
}

.main-header.is-sticky .logo {
    height: 40px;
}

.logo-text {
    display: flex;
    flex-direction: column;
}

.brand-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #084c74;
    line-height: 1.2;
}

.brand-tagline {
    font-size: 0.75rem;
    color: #0a609d;
    font-weight: 500;
}

/* Header Center */
.header-center {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 32px;
}

.contact-blocks {
    display: flex;
    gap: 16px;
}

.contact-block {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
    border-radius: 12px;
    border: 1px solid #87CEFA;
    transition: all 0.3s ease;
}

.contact-block:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(10, 154, 115, 0.15);
}

.contact-block .icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.125rem;
}

.contact-block .info {
    display: flex;
    flex-direction: column;
}

.contact-block .label {
    font-size: 0.75rem;
    color: #0b4d70;
    font-weight: 600;
}

.contact-block .value {
    color: #2ea5dd;
    font-weight: 700;
    text-decoration: none;
    transition: color 0.3s ease;
    font-size: 0.9375rem;
}

.contact-block .value:hover {
    color: #0a609d;
}

/* Header Actions */
.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    color: #374151;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    position: relative;
}

.action-btn:hover {
    border-color: #0a609d;
    color: #0a609d;
    background: #f0fdf4;
    transform: translateY(-2px);
}

.action-btn i {
    font-size: 1.125rem;
}

.wishlist-btn .badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #ef4444;
    color: white;
    font-size: 0.625rem;
    padding: 2px 6px;
    border-radius: 10px;
    font-weight: 700;
}

/* Main Navigation */
.main-nav {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    position: relative;
    z-index: 99;
    box-shadow: 0 2px 8px rgba(10, 154, 115, 0.2);
}

.main-nav.is-sticky {
    position: fixed;
    top: 72px;
    left: 0;
    right: 0;
    z-index: 999;
}

.nav-list {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
    list-style: none;
    min-height: 56px;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 18px 20px;
    color: white;
    text-decoration: none;
    font-size: 0.9375rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link i {
    font-size: 0.875rem;
    opacity: 0.9;
}

.nav-link::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: white;
    transition: width 0.3s ease;
    border-radius: 2px 2px 0 0;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
}

.nav-link:hover::before,
.nav-link.active::before {
    width: 80%;
}

.nav-link.active {
    background: rgba(255, 255, 255, 0.15);
}

/* Sticky state adjustment */
body.has-sticky-header {
    padding-top: 128px;
}

/* Responsive */
@media (max-width: 1200px) {
    .contact-blocks {
        display: none;
    }

    .nav-link {
        padding: 18px 16px;
        font-size: 0.875rem;
    }
}

@media (max-width: 1024px) {
    .logo-text {
        display: none;
    }

    .trust-badge {
        display: none;
    }

    .nav-link span {
        display: none;
    }

    .nav-link {
        padding: 18px 14px;
    }

    .action-btn span {
        display: none;
    }

    .action-btn {
        padding: 10px 12px;
    }
}

@media (max-width: 768px) {
    .desktop-header {
        display: none;
    }
}
</style>