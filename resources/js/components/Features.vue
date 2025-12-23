<template>
  <div class="features-section">
    <div class="container">
      <div class="features-wrapper">
        <!-- Fast Delivery -->
        <div class="feature-item">
          <div class="feature-icon delivery">
            <font-awesome-icon :icon="['fas', 'truck-fast']" />
          </div>
          <div class="feature-info">
            <h4>Fast Delivery</h4>
            <p>1-3 days nationwide delivery</p>
          </div>
          <div class="feature-badge">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>

        <!-- Secure Payment -->
        <div class="feature-item">
          <div class="feature-icon payment">
            <font-awesome-icon :icon="['fas', 'hand-holding-dollar']" />
          </div>
          <div class="feature-info">
            <h4>Flexible Payment</h4>
            <p>M-Pesa, card & cash before delivery</p>
          </div>
          <div class="feature-badge">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>

        <!-- Bulk Orders -->
        <div class="feature-item">
          <div class="feature-icon wholesale">
            <font-awesome-icon :icon="['fas', 'tags']" />
          </div>
          <div class="feature-info">
            <h4>Bulk Discounts</h4>
            <p>Special prices for institutions</p>
          </div>
          <div class="feature-badge">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>

        <!-- 24/7 Support -->
        <div class="feature-item">
          <div class="feature-icon support">
            <font-awesome-icon :icon="['fas', 'headset']" />
          </div>
          <div class="feature-info">
            <h4>24/7 Support</h4>
            <p>Expert medical equipment advice</p>
          </div>
          <div class="feature-badge">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>

       
        
      </div>
    </div>
  </div>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
</script>

<style scoped>
.features-section {
  padding: 0 24px 48px;
  position: relative;
  z-index: 10;
  background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
}

.container {
  max-width: 1280px;
  margin: 0 auto;
}

.features-wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  background: white;
  padding: 32px;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  transform: translateY(-32px);
  position: relative;
  overflow: hidden;
}

.features-wrapper::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #0a609d 0%, #084c74 100%);
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 20px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 12px;
  position: relative;
  background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
  border: 2px solid transparent;
}

.feature-item:hover {
  background: linear-gradient(135deg, #f0fdf4 0%, #B0E0E6 100%);
  border-color: #0a609d;
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(10, 154, 115, 0.15);
}

.feature-item.highlight {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border-color: #fbbf24;
}

.feature-item.highlight:hover {
  background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
  transform: translateY(-4px) scale(1.02);
}

.feature-icon {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 14px;
  color: white;
  font-size: 1.5rem;
  flex-shrink: 0;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.feature-icon::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.2);
  opacity: 0;
  transition: opacity 0.4s ease;
}

.feature-item:hover .feature-icon::before {
  opacity: 1;
}

.feature-icon.delivery {
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.feature-icon.payment {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.feature-icon.wholesale {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.feature-icon.support {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.feature-icon.certified {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.4);
}

.feature-icon.warranty {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.feature-item:hover .feature-icon {
  transform: scale(1.1) rotate(5deg);
}

.feature-info {
  flex: 1;
  min-width: 0;
}

.feature-info h4 {
  font-size: 1.0625rem;
  font-weight: 700;
  color: #111827;
  margin: 0 0 6px 0;
  letter-spacing: -0.01em;
  transition: color 0.3s ease;
}

.feature-item:hover .feature-info h4 {
  color: #0a609d;
}

.feature-item.highlight .feature-info h4 {
  color: #92400e;
}

.feature-info p {
  font-size: 0.875rem;
  color: #6b7280;
  margin: 0;
  line-height: 1.4;
}

.feature-badge {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #B0E0E6;
  color: #0a609d;
  border-radius: 50%;
  font-size: 0.875rem;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.feature-item:hover .feature-badge {
  background: #0a609d;
  color: white;
  transform: scale(1.15);
}

.feature-badge.premium {
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  color: white;
}

.feature-item.highlight:hover .feature-badge.premium {
  transform: scale(1.15) rotate(360deg);
}

/* Responsive */
@media (max-width: 1024px) {
  .features-wrapper {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .features-section {
    padding: 0 16px 32px;
  }

  .features-wrapper {
    padding: 24px;
    gap: 16px;
    transform: translateY(-24px);
  }

  .feature-item {
    padding: 16px;
  }

  .feature-icon {
    width: 48px;
    height: 48px;
    font-size: 1.25rem;
  }

  .feature-info h4 {
    font-size: 0.9375rem;
  }

  .feature-info p {
    font-size: 0.8125rem;
  }

  .feature-badge {
    width: 28px;
    height: 28px;
    font-size: 0.75rem;
  }
}

@media (max-width: 480px) {
  .features-wrapper {
    grid-template-columns: 1fr;
    padding: 20px;
  }

  .feature-item {
    padding: 14px;
    gap: 12px;
  }

  .feature-icon {
    width: 44px;
    height: 44px;
    font-size: 1.125rem;
  }
}

/* Animation on scroll (optional) */
@media (prefers-reduced-motion: no-preference) {
  .feature-item {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
  }

  .feature-item:nth-child(1) { animation-delay: 0.1s; }
  .feature-item:nth-child(2) { animation-delay: 0.2s; }
  .feature-item:nth-child(3) { animation-delay: 0.3s; }
  .feature-item:nth-child(4) { animation-delay: 0.4s; }
  .feature-item:nth-child(5) { animation-delay: 0.5s; }
  .feature-item:nth-child(6) { animation-delay: 0.6s; }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
}
</style>