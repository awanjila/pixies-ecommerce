<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import ShowCart from '../ShowCart.vue';
import MobileSearch from '../MobileSearch.vue';

const isMenuOpen = ref(false);
const isScrolled = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
    // Prevent body scroll when menu is open
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

onMounted(() => {
    console.log('MobileHeader mounted');
    window.addEventListener('scroll', handleScroll);
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
                    <a href="tel:+254710909198" class="contact-link">
                        <i class="fas fa-phone"></i>
                        <span>+254 710 909 198</span>
                    </a>
                    <div class="trust-badge">
                        <i class="fas fa-shield-check"></i>
                        <span>ISO Certified</span>
                    </div>
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
                        <img src="/front-assets/img/brand-logo/logo.png" alt="Medical Equipment Logo" class="logo">
            
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
            <div class="menu-wrapper">
                <!-- Menu Header -->
                <div class="menu-header">
                    <div class="menu-header-content">
                        <img src="/front-assets/img/brand-logo/logo.png" alt="Logo" class="menu-logo">
                        <div class="menu-title">
                            <span class="title-main">Medical Equipment</span>
                            <span class="title-sub">Professional Healthcare Solutions</span>
                        </div>
                    </div>
                    <button @click="closeMenu" class="close-btn" aria-label="Close menu">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Search -->
                <div class="menu-search">
                    <MobileSearch />
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                   
                </div>

                <!-- Navigation -->
                <nav class="menu-nav">
                    <div class="nav-section">
                        <h4 class="nav-section-title">Main Menu</h4>
                        <a href="/" class="nav-item" @click="closeMenu">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                        <a href="/shop" class="nav-item" @click="closeMenu">
                            <i class="fas fa-store"></i>
                            <span>Shop All Products</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                        <a href="/about" class="nav-item" @click="closeMenu">
                            <i class="fas fa-info-circle"></i>
                            <span>About Us</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                    </div>

                    <div class="nav-section">
                        <h4 class="nav-section-title">Support</h4>
                        <a href="/contact/us" class="nav-item" @click="closeMenu">
                            <i class="fas fa-envelope"></i>
                            <span>Contact Us</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                        <a href="/shipping" class="nav-item" @click="closeMenu">
                            <i class="fas fa-shipping-fast"></i>
                            <span>Shipping Info</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                        <a href="/return/policy" class="nav-item" @click="closeMenu">
                            <i class="fas fa-undo"></i>
                            <span>Returns Policy</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                    </div>
                </nav>

                <!-- Menu Footer -->
                <div class="menu-footer">
                    <div class="contact-section">
                        <h4 class="footer-title">Get In Touch</h4>
                        <div class="contact-links">
                            <a href="tel:+254710909198" class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Call Us</span>
                                    <span class="contact-value">+254 710 909 198</span>
                                </div>
                            </a>
                            <a href="mailto:info@wabegadgets.co.ke" class="contact-item">
                                <div class="contact-icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Email Us</span>
                                    <span class="contact-value">info@wabegadgets.co.ke</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="social-section">
                        <h4 class="footer-title">Follow Us</h4>
                        <div class="menu-social">
                            <a href="#" class="social-btn facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn twitter" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-btn instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-btn linkedin" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer-badge">
                        <i class="fas fa-shield-check"></i>
                        <span>ISO Certified Medical Equipment</span>
                    </div>
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
    background: linear-gradient(135deg, #084c74 0%, #0a609d 100%);
    padding: 8px 0;
    font-size: 0.8125rem;
}

.container {
    padding: 0 16px;
}

.top-bar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.contact-link {
    color: white;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-weight: 500;
}

.contact-link i {
    font-size: 0.75rem;
}

.trust-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    color: white;
    font-weight: 600;
    font-size: 0.75rem;
}

.trust-badge i {
    color: #fbbf24;
    font-size: 0.875rem;
}

/* Main Header */
.main-header {
    background: white;
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 40;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.main-header.is-scrolled {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 52px;
}

.menu-btn {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    border: none;
    color: white;
    font-size: 1.25rem;
    padding: 10px 14px;
    cursor: pointer;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.menu-btn:active {
    transform: scale(0.95);
}

.logo-link {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.logo {
    height: 70px;
}

.logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.brand-name {
    font-size: 1rem;
    font-weight: 700;
    color: #084c74;
}

.brand-subtitle {
    font-size: 0.6875rem;
    color: #0a609d;
    font-weight: 600;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.action-btn {
    color: #374151;
    font-size: 1.25rem;
    padding: 8px;
    transition: color 0.3s ease;
}

.action-btn:hover {
    color: #0a609d;
}

/* Menu Overlay */
.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
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
    max-width: 380px;
    height: 100vh;
    background: white;
    transform: translateX(-100%);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 50;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
}

.mobile-menu.is-open {
    transform: translateX(0);
}

.menu-wrapper {
    display: flex;
    flex-direction: column;
    height: 100vh;
    overflow-y: auto;
}

/* Menu Header */
.menu-header {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.menu-header-content {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.menu-logo {
    height: 36px;
    filter: brightness(0) invert(1);
}

.menu-title {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.title-main {
    font-size: 0.9375rem;
    font-weight: 700;
    color: white;
}

.title-sub {
    font-size: 0.6875rem;
    color: rgba(255, 255, 255, 0.9);
}

.close-btn {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: white;
    font-size: 1.5rem;
    padding: 8px;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.close-btn:active {
    transform: scale(0.95);
    background: rgba(255, 255, 255, 0.25);
}

/* Menu Search */
.menu-search {
    padding: 16px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    padding: 16px;
    background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
}

.quick-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    background: white;
    border: 2px solid #87CEFA;
    border-radius: 12px;
    color: #2ea5dd;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.quick-action-btn:active {
    transform: scale(0.95);
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    border-color: transparent;
}

/* Menu Navigation */
.menu-nav {
    flex: 1;
    padding: 8px 0;
}

.nav-section {
    margin-bottom: 8px;
}

.nav-section-title {
    padding: 12px 20px 8px;
    margin: 0;
  font-size: 0.75rem;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    color: #374151;
    text-decoration: none;
    font-size: 0.9375rem;
    font-weight: 500;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    position: relative;
}

.nav-item i:first-child {
    color: #0a609d;
    width: 20px;
    text-align: center;
    font-size: 1rem;
}

.nav-item span {
    flex: 1;
}

.nav-arrow {
    font-size: 0.75rem;
    color: #9ca3af;
    transition: all 0.3s ease;
}

.nav-item:active {
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    color: white;
    padding-left: 28px;
}

.nav-item:active i {
    color: white;
}

.nav-item:active .nav-arrow {
    transform: translateX(4px);
    color: white;
}

/* Menu Footer */
.menu-footer {
    margin-top: auto;
    padding: 20px;
    background: linear-gradient(to bottom, #f9fafb 0%, #f3f4f6 100%);
    border-top: 2px solid #e5e7eb;
}

.footer-title {
    font-size: 0.875rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 12px 0;
}

.contact-section {
    margin-bottom: 20px;
}

.contact-links {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: white;
    border-radius: 12px;
    text-decoration: none;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.contact-item:active {
    transform: scale(0.98);
    border-color: #0a609d;
    background: #f0fdf4;
}

.contact-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
    border-radius: 10px;
    color: white;
    font-size: 0.875rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.contact-label {
    font-size: 0.6875rem;
    color: #6b7280;
    font-weight: 500;
}

.contact-value {
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
}

.social-section {
    margin-bottom: 16px;
}

.menu-social {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.social-btn {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 12px;
    color: #6b7280;
    font-size: 1.125rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
}

.social-btn:active {
    transform: scale(0.9);
}

.social-btn.facebook:active {
    background: #1877f2;
    color: white;
    border-color: #1877f2;
}

.social-btn.twitter:active {
    background: #1da1f2;
    color: white;
    border-color: #1da1f2;
}

.social-btn.instagram:active {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    color: white;
    border-color: transparent;
}

.social-btn.linkedin:active {
    background: #0077b5;
    color: white;
    border-color: #0077b5;
}

.footer-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 12px;
    color: #92400e;
    font-weight: 600;
    font-size: 0.8125rem;
    text-align: center;
}

.footer-badge i {
    color: #f59e0b;
    font-size: 1.125rem;
}

/* Responsive */
@media (max-width: 360px) {
    .mobile-menu {
        width: 90%;
    }

    .logo-text {
        display: none;
    }
}
</style>