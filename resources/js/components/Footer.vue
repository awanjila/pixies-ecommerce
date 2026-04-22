<template>
  <footer class="site-footer">
    <div class="footer-main">
      <div class="container">
        <div class="footer-grid">
          <!-- Company Info -->
          <div class="footer-col company-info">
            <h3 class="footer-title">About Wabegadgets</h3>
            <p class="company-desc">
              WabeGadgets is your premier destination for top-tier security solutions. We specialize in CCTV systems, cloud storage solutions, professional installations, and cutting-edge smart home technology. Our commitment to security excellence makes us your trusted partner in protecting what matters most.
            </p>
            <div class="social-links">
              <a href="#" class="social-link" title="Facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-link" title="Twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-link" title="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="footer-col">
            <h3 class="footer-title">Quick Links</h3>
            <ul class="footer-links">
               <li><a href="/about/us">About Us</a></li>
              <li><a href="/contact/us">Contact Us</a></li>
              <li><a href="/faqs">FAQs</a></li>
              <li v-for="category in randomCategories" :key="category.id">
                <a :href="`/category/${category.slug}`">{{ category.category_name }}</a>
              </li>
            </ul>
          </div>

          <!-- Legal Links -->
          <div class="footer-col">
            <h3 class="footer-title">Legal</h3>
            <ul class="footer-links">
            
              <li><a href="/privacy/policy">Privacy Policy</a></li>
              <li><a href="/terms/conditions">Terms & Conditions</a></li>
              <li><a href="/shipping">Shipping Policy</a></li>
              <li><a href="/return/policy">Return Policy</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="footer-col">
            <h3 class="footer-title">Contact Us</h3>
            <ul class="contact-info">
              <li>
                <i class="fas fa-phone"></i>
                <a href="tel:+254710909198">+254 710 909 198</a>
              </li>
              <li>
                <i class="fas fa-envelope"></i>
                <a href="mailto:info@wabegadgets.co.ke">info@wabegadgets.co.ke</a>
              </li>
              <li>
                <i class="fas fa-map-marker-alt"></i>
                <span>Nairobi, Kenya</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container">
        <div class="footer-bottom-content">
          <div class="copyright">
            © {{ currentYear }} WabeGadgets. All rights reserved.
          </div>
          <div class="developer-credit">
            Crafted with <i class="fas fa-heart text-red-500"></i> by 
            <a href="https://www.wabestudio.co.ke" target="_blank" rel="noopener noreferrer">
              WabeStudio
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const randomCategories = ref([]);
const currentYear = computed(() => new Date().getFullYear());

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
        .slice(0, 5);
    }
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

onMounted(() => {
  fetchRandomCategories();
});
</script>

<style scoped>
.site-footer {
  background-color: #171616;
  color: #ffffff;
  font-size: 0.875rem;
}

.footer-main {
  padding: 3rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.footer-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 2rem;
  border-bottom: 1px solid #2a2a2a;
  padding-bottom: 2rem;
}

.footer-title {
  color: #ffffff;
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 1.25rem;
}

.company-desc {
  color: #9ca3af;
  line-height: 1.6;
  margin-bottom: 1.25rem;
}

.social-links {
  display: flex;
  gap: 0.75rem;
}

.social-link {
  width: 36px;
  height: 36px;
  border: 1px solid #2a2a2a;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  transition: all 0.2s ease;
}

.social-link:hover {
  background: #95002a;
  border-color: #95002a;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: 0.75rem;
}

.footer-links a {
  color: #9ca3af;
  text-decoration: none;
  transition: color 0.2s ease;
}

.footer-links a:hover {
  color: #95002a;
}

.contact-info {
  list-style: none;
  padding: 0;
  margin: 0;
}

.contact-info li {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.75rem;
  color: #9ca3af;
}

.contact-info i {
  color: #95002a;
  width: 16px;
}

.contact-info a {
  color: #9ca3af;
  text-decoration: none;
  transition: color 0.2s ease;
}

.contact-info a:hover {
  color: #95002a;
}

.footer-bottom {
  background: #0f0f0f;
  padding: 1rem 0;
}

.footer-bottom-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.copyright {
  color: #666;
  font-size: 0.8125rem;
}

.developer-credit {
  color: #666;
  font-size: 0.8125rem;
}

.developer-credit a {
  color: #95002a;
  text-decoration: none;
  transition: color 0.2s ease;
}

.developer-credit a:hover {
  color: #ffffff;
}

@media (max-width: 1024px) {
  .footer-grid {
    grid-template-columns: 1fr 1fr;
  }
  
  .company-info {
    grid-column: span 2;
  }
}

@media (max-width: 640px) {
  .footer-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .company-info {
    grid-column: span 1;
  }
  
  .footer-bottom-content {
    flex-direction: column;
    gap: 0.5rem;
    text-align: center;
  }
}
</style> 