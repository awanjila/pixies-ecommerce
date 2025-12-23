import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { createPinia } from 'pinia';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
// Import the icons you need
import { faCartPlus, faCheck, faTruckFast, faHandHoldingDollar, faTags, faHeadset } from '@fortawesome/free-solid-svg-icons';

// Import components
import SecNav from '@/components/SecNav.vue';
import AllShop from '@/components/AllShop.vue';
import Cart from '@/components/Cart.vue';
import CartAddRemove from '@/components/CartAddRemove.vue';
import OrderSuccess from '@/components/OrderSuccess.vue';
import CartButton from '@/components/CartButton.vue';
import Products from '@/components/ProductsComponent.vue';
import ProductCategory from '@/components/ProductCategory.vue';
import CategoryProduct from '@/components/CategoryProduct.vue';
import Examples from '@/components/ExampleComponent.vue';

import CheckOutButton from '@/components/CheckOutButtonComponent.vue';
import ShopCart from '@/components/ShopCartComponent.vue';
import AgeVerificationComponent from '@/components/AgeVerificationComponent.vue';
import Checkout from '@/components/Checkout.vue';
import ShowCart from '@/components/ShowCart.vue';
import ProductReviewSection from '@/components/ProductReviewSection.vue';
import ProductReviewModal from '@/components/ProductReviewModal.vue';
import CouponComponent from '@/components/CouponComponent.vue';
import SubscriptionModal from '@/components/SubscriptionModal.vue';
import BlogDetails from '@/components/BlogDetails.vue';
import ShareBlogDetails from '@/components/ShareBlogDetails.vue';
import CartDrawer from '@/components/CartDrawer.vue';
import OrderSuccessModal from '@/components/OrderSuccessModal.vue';
import Slider from '@/components/Slider.vue';
import ParentHeader from './components/Header/ParentHeader.vue';
// import InvoiceMail from '@/components/InvoiceMail.vue';
import SearchProduct from './components/SearchProduct.vue';
import Search from './components/Search.vue'
import SlugCategory from './components/SlugCategory.vue'
import Features from './components/Features.vue'
import BlogNotification from './components/EmailTemplates/BlogNotification.vue';
import TrendingProducts from './components/TrendingProducts.vue';
import ContactForm from './components/ContactForm.vue';
import WhatsAppButton from './components/WhatsAppButton.vue';
import BrandCarousel from './components/BrandCarousel.vue'
import DesktopSearch from './components/DesktopSearch.vue'
import MobileSearch from './components/MobileSearch.vue'
import ProductDetail from './components/ProductDetail.vue';
import Footer from './components/Footer.vue';
import ShippingPage from './components/ShippingPage.vue';
import ReturnPage from './components/ReturnPage.vue';
import TermsPage from './components/TermsPage.vue';
import PrivacyPage from './components/PrivacyPage.vue';
import AboutPage from './components/AboutUs.vue';

import './bootstrap';

// Add the imported icons to the library
library.add(faCartPlus, faCheck, faTruckFast, faHandHoldingDollar, faTags, faHeadset);

// Create Vue Router instance

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'catalog.index',
      component: Examples
    },
    { path: '/cart', name: 'Cart', component: Cart },
    { path: '/checkout', component: Checkout },
    {
      path: '/order-success/:orderId',
      name: 'order.success',
      component: OrderSuccess
    },
  ]
});

// Create Pinia store instance
const store = createPinia();

// Create a Vue application instance
const app = createApp({})
app.component('Search', Search)
app.component('desktop-search', DesktopSearch)
app.component('mobile-search', MobileSearch)

// Register Font Awesome icon component globally
app.component('font-awesome-icon', FontAwesomeIcon);

app.component('sec-nav', SecNav);

// Register Font Awesome icon component globally

// Register components with the application instance
app.component('OrderSuccessModal', OrderSuccessModal);
// app.component('InvoiceMail', InvoiceMail);
app.component('parent-header', ParentHeader);
app.component('all-shop', AllShop);
app.component('Cart', Cart);
app.component('CartAddRemove', CartAddRemove);
app.component('Slider', Slider);
app.component('CartButton', CartButton);
app.component('OrderSuccess', OrderSuccess);
app.component('whatsapp-button', WhatsAppButton);
app.component('Products', Products);
app.component('ProductCategory', ProductCategory);
app.component('CategoryProduct', CategoryProduct);
app.component('Examples', Examples);
app.component('CheckOutButton', CheckOutButton);
app.component('ShopCart', ShopCart);
app.component('AgeVerificationComponent', AgeVerificationComponent);
app.component('Checkout', Checkout);
app.component('ShowCart', ShowCart);
app.component('ProductReviewSection', ProductReviewSection);
app.component('ProductReviewModal', ProductReviewModal);
app.component('CouponComponent', CouponComponent);
app.component('subscription-modal', SubscriptionModal);
app.component('BlogDetails', BlogDetails);
app.component('ShareBlogDetails', ShareBlogDetails);
app.component('CartDrawer', CartDrawer);
app.component('search-product', SearchProduct);
app.component('slug-category', SlugCategory)
app.component('Features', Features)
app.component('blog-notification', BlogNotification);
app.component('trending-products', TrendingProducts);
app.component('contact-form', ContactForm)
app.component('brand-carousel', BrandCarousel)
app.component('product-detail', ProductDetail)
// app.component('site-footer', Footer)
app.component('shipping-page', ShippingPage)
app.component('return-page', ReturnPage)
app.component('terms-page', TermsPage)
app.component('privacy-page', PrivacyPage)


app.component('about-page', AboutPage);

// Register the component globally
app.component('site-footer', Footer); // Note: Using 'site-footer' to avoid conflicts with native HTML footer

// Mount the application instance to the specified element
app.use(router).use(store).mount('#app');
