import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { createPinia } from 'pinia';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faCartPlus, faCheck } from '@fortawesome/free-solid-svg-icons';

// Import components
import SecNav from '@/components/SecNav.vue';
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
import SubscriptionComponent from '@/components/SubscriptionComponent.vue';
import WhatsAppComponent from '@/components/WhatsAppComponent.vue';
import WhatsappButton from '@/components/WhatsappButton.vue';
import BlogDetails from '@/components/BlogDetails.vue';
import ShareBlogDetails from '@/components/ShareBlogDetails.vue';
import CartDrawer from '@/components/CartDrawer.vue';
import OrderSuccessModal from '@/components/OrderSuccessModal.vue';
import Slider from '@/components/Slider.vue';
import ParentHeader from './components/Header/ParentHeader.vue';
import SearchProduct from './components/SearchProduct.vue';
import AboutPage from './components/AboutUs.vue';



// Add the imported icons to the library
library.add(faCartPlus, faCheck);

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
const app = createApp({});

// Register Font Awesome icon component globally
app.component('font-awesome-icon', FontAwesomeIcon);

app.component('sec-nav', SecNav);

// Register components with the application instance
app.component('OrderSuccessModal', OrderSuccessModal);
app.component('parent-header', ParentHeader);
app.component('Cart', Cart);
app.component('CartAddRemove', CartAddRemove);
app.component('Slider', Slider);
app.component('CartButton', CartButton);
app.component('OrderSuccess', OrderSuccess);
app.component('WhatsappButton', WhatsappButton);
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
app.component('SubscriptionComponent', SubscriptionComponent);
app.component('WhatsAppComponent', WhatsAppComponent);
app.component('BlogDetails', BlogDetails);
app.component('ShareBlogDetails', ShareBlogDetails);
app.component('CartDrawer', CartDrawer);
app.component('search-product', SearchProduct);
app.component('about-page', AboutPage);

// Mount the application instance to the specified element
app.use(router).use(store).mount('#app');
