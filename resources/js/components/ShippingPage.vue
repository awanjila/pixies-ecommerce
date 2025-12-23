<template>
  <section class="shipping-section">
    <div class="container">
     
      <div class="section-header">
        <div class="header-badge">
          <span class="badge-icon">🚚</span>
          <span class="badge-text">Reliable Medical Logistics</span>
        </div>
        <h1 class="section-title">Shipping Information</h1>
        <p class="section-subtitle">
          Safe, compliant, and timely delivery of medical equipment across Kenya and worldwide
        </p>
      </div>

      <div class="region-selector">
        <button
          v-for="region in shippingRegions"
          :key="region.id"
          @click="activeRegion = region.id"
          :class="['region-btn', { active: activeRegion === region.id }]"
        >
          <span class="region-icon">{{ region.icon }}</span>
          <span class="region-name">{{ region.name }}</span>
        </button>
      </div>

    
      <div class="region-details">
        <div class="detail-cards">
          <div class="detail-card timeline">
            <div class="card-icon">⏱️</div>
            <div class="card-label">Delivery Time</div>
            <div class="card-value">{{ selectedRegion.timeline }}</div>
          </div>
          <div class="detail-card cost">
            <div class="card-icon">💰</div>
            <div class="card-label">Shipping Cost</div>
            <div class="card-value">{{ selectedRegion.cost }}</div>
          </div>
          <div class="detail-card coverage">
            <div class="card-icon">📍</div>
            <div class="card-label">Coverage</div>
            <div class="card-value">{{ selectedRegion.details }}</div>
          </div>
        </div>

      
        <div class="shipping-zones">
          <h3 class="zones-title">
            <span>📦</span> Detailed Shipping Zones
          </h3>
          <div class="zones-list">
            <div v-for="(zone, idx) in selectedRegion.zones" :key="idx" class="zone-item">
              <div class="zone-name">{{ zone.name }}</div>
              <div class="zone-info">
                <div class="zone-detail">
                  <div class="detail-label">Delivery</div>
                  <div class="detail-value delivery">{{ zone.days }} days</div>
                </div>
                <div class="zone-detail">
                  <div class="detail-label">Cost</div>
                  <div class="detail-value cost">{{ zone.cost }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
      <div class="courier-section">
        <h2 class="courier-title">Our Trusted Courier Partners</h2>
        <div class="courier-grid">
          <div
            v-for="(courier, idx) in courierPartners"
            :key="idx"
            class="courier-card"
            :style="{ animationDelay: `${idx * 0.1}s` }"
          >
            <div class="courier-logo">{{ courier.logo }}</div>
            <h3 class="courier-name">{{ courier.name }}</h3>
            <div class="courier-badges">
              <span class="courier-badge">{{ courier.speed }}</span>
            </div>
            <div class="courier-regions">{{ courier.regions.join(', ') }}</div>
          </div>
        </div>
      </div>

     
      <div class="special-handling">
        <div class="handling-header">
          <div class="handling-badge">
            <span>⚕️</span>
            <span>Medical Compliance</span>
          </div>
          <h2 class="handling-title">Items Requiring Special Handling</h2>
          <p class="handling-subtitle">Professional logistics for sensitive medical supplies</p>
        </div>
        <div class="handling-grid">
          <div
            v-for="(item, idx) in specialHandling"
            :key="idx"
            class="handling-card"
            :style="{ animationDelay: `${idx * 0.1}s` }"
          >
            <div class="handling-content">
              <div class="handling-icon">{{ item.icon }}</div>
              <div class="handling-info">
                <h3 class="handling-item-title">{{ item.title }}</h3>
                <p class="handling-description">{{ item.description }}</p>
                <div class="handling-note">
                  <span class="note-icon">⚠️</span>
                  <span class="note-text">{{ item.note }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

   
      <div class="faq-section">
        <h2 class="faq-title">Frequently Asked Questions</h2>
        <div class="faq-list">
          <div v-for="(faq, idx) in faqs" :key="idx" class="faq-item">
            <button
              @click="toggleFAQ(idx)"
              class="faq-question"
            >
              <span class="question-text">{{ faq.question }}</span>
              <span :class="['question-icon', { expanded: expandedFAQ === idx }]">⌄</span>
            </button>
            <div :class="['faq-answer', { expanded: expandedFAQ === idx }]">
              <div class="answer-text">{{ faq.answer }}</div>
            </div>
          </div>
        </div>
      </div>

     
      <div class="contact-cta">
        <h2 class="cta-title">Need Custom Shipping Solutions?</h2>
        <p class="cta-subtitle">
          Large orders, specialized equipment, or urgent deliveries? Our logistics team is here to help.
        </p>
        <div class="cta-buttons">
          <a href="tel:+254710909198" class="cta-btn primary">
            📞 Call: +254 710 909 198
          </a>
          <a href="mailto:shipping@medical.com" class="cta-btn secondary">
            ✉️ Email: shipping@wabegadgets.co.ke
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ShippingInformation',
  data() {
    return {
      activeRegion: 'kenya',
      expandedFAQ: null,
      shippingRegions: [
        {
          id: 'kenya',
          name: 'Kenya',
          icon: '🇰🇪',
          timeline: '1-3 Business Days',
          cost: 'Ksh 300 - 1,500',
          details: 'Free shipping on orders over Ksh 10,000',
          zones: [
            { name: 'Nairobi & Surroundings', days: '1-2', cost: 'Ksh 300' },
            { name: 'Major Cities (Mombasa, Kisumu, Nakuru)', days: '2-3', cost: 'Ksh 500' },
            { name: 'Remote Areas', days: '3-5', cost: 'Ksh 1,500' }
          ]
        },
        {
          id: 'eastafrica',
          name: 'East Africa',
          icon: '🌍',
          timeline: '5-10 Business Days',
          cost: 'Calculated at checkout',
          details: 'Uganda, Tanzania, Rwanda, Burundi',
          zones: [
            { name: 'Uganda & Tanzania', days: '5-7', cost: 'From Ksh 3,000' },
            { name: 'Rwanda & Burundi', days: '7-10', cost: 'From Ksh 4,500' }
          ]
        },
        {
          id: 'international',
          name: 'International',
          icon: '✈️',
          timeline: '10-21 Business Days',
          cost: 'Calculated at checkout',
          details: 'Worldwide shipping available',
          zones: [
            { name: 'Europe & North America', days: '10-15', cost: 'From USD 50' },
            { name: 'Asia & Middle East', days: '12-18', cost: 'From USD 40' },
            { name: 'Rest of World', days: '15-21', cost: 'Contact us for quote' }
          ]
        }
      ],
      courierPartners: [
        { name: 'DHL Express', logo: '📦', speed: 'Express', regions: ['Kenya', 'International'] },
        { name: 'G4S Courier', logo: '🚚', speed: 'Standard', regions: ['Kenya', 'East Africa'] },
        { name: 'Fargo Courier', logo: '🏪', speed: 'Economy', regions: ['Kenya'] },
        { name: 'FedEx', logo: '✈️', speed: 'Express', regions: ['International'] }
      ],
      specialHandling: [
        {
          icon: '❄️',
          title: 'Temperature-Sensitive Items',
          description: 'Vaccines, medications, and biological samples require cold chain logistics',
          note: '2-4°C or -20°C storage during transit'
        },
        {
          icon: '⚠️',
          title: 'Fragile Medical Equipment',
          description: 'Imaging equipment, diagnostic tools, and glass instruments',
          note: 'Custom crating and shock-proof packaging'
        },
        {
          icon: '📋',
          title: 'Regulated Medical Devices',
          description: 'Items requiring permits, licenses, or compliance documentation',
          note: 'Additional 3-5 days for customs clearance'
        },
        {
          icon: '🔒',
          title: 'Controlled Substances',
          description: 'Scheduled drugs and controlled medical supplies',
          note: 'Requires valid prescription and documentation'
        }
      ],
      faqs: [
        {
          question: 'How are shipping costs calculated?',
          answer: 'Shipping costs are based on package weight, dimensions, destination, and delivery speed. You\'ll see the exact cost at checkout before confirming your order. We offer free shipping within Kenya for orders over Ksh 10,000.'
        },
        {
          question: 'Do you ship hazardous medical materials?',
          answer: 'Yes, but with strict compliance. We handle WHO Class A and B biological substances, following IATA regulations. Additional documentation and specialized packaging are required. Contact our compliance team for specific items.'
        },
        {
          question: 'Can I track my medical equipment shipment?',
          answer: 'Absolutely! Once your order ships, you\'ll receive a tracking number via email and SMS. Track in real-time through our website or the courier\'s platform. Temperature-sensitive shipments include data loggers for monitoring.'
        },
        {
          question: 'What if my equipment arrives damaged?',
          answer: 'All shipments are insured. If damage occurs, photograph the package and contact us within 48 hours. We\'ll arrange inspection, replacement, or repair at no cost to you. Our packaging is designed to withstand standard handling.'
        },
        {
          question: 'Do you offer installation services?',
          answer: 'Yes! For large medical equipment (imaging systems, surgical tables, etc.), we provide professional installation, calibration, and staff training. This is included in the delivery cost for qualifying items.'
        }
      ]
    };
  },
  computed: {
    selectedRegion() {
      return this.shippingRegions.find(r => r.id === this.activeRegion);
    }
  },
  methods: {
    toggleFAQ(idx) {
      this.expandedFAQ = this.expandedFAQ === idx ? null : idx;
    }
  }
};
</script>

<style scoped>
.shipping-section {
  min-height: 100vh;
  background: linear-gradient(to bottom, #f9fafb 0%, #ffffff 100%);
  padding: 80px 0;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* Header */
.section-header {
  text-align: center;
  margin-bottom: 64px;
  animation: fadeInDown 0.6s ease-out;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.header-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: linear-gradient(135deg, rgba(10, 154, 115, 0.1) 0%, rgba(6, 64, 43, 0.1) 100%);
  border: 1px solid rgba(10, 154, 115, 0.2);
  border-radius: 50px;
  margin-bottom: 16px;
}

.badge-icon {
  font-size: 1.5rem;
}

.badge-text {
  color: #0a609d;
  font-weight: 600;
  font-size: 0.875rem;
}

.section-title {
  font-size: 3rem;
  font-weight: 700;
  color: #084c74;
  margin: 0 0 16px 0;
  letter-spacing: -0.02em;
}

.section-subtitle {
  color: #6b7280;
  font-size: 1.25rem;
  margin: 0;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

/* Region Selector */
.region-selector {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 16px;
  margin-bottom: 48px;
}

.region-btn {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px 32px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 1.125rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  background: white;
  color: #374151;
  border: 2px solid #e5e7eb;
  cursor: pointer;
}

.region-btn:hover {
  border-color: #0a609d;
  background: #f0fdf4;
}

.region-btn.active {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  color: white;
  border-color: transparent;
  box-shadow: 0 8px 20px rgba(10, 154, 115, 0.3);
  transform: scale(1.05);
}

.region-icon {
  font-size: 1.875rem;
}

.region-name {
  font-weight: 600;
}

/* Region Details */
.region-details {
  background: white;
  border-radius: 24px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  padding: 32px;
  margin-bottom: 48px;
  animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.detail-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 24px;
  margin-bottom: 32px;
}

.detail-card {
  text-align: center;
  padding: 24px;
  border-radius: 16px;
  transition: transform 0.3s ease;
}

.detail-card:hover {
  transform: translateY(-4px);
}

.detail-card.timeline {
  background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
}

.detail-card.cost {
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
}

.detail-card.coverage {
  background: linear-gradient(135deg, #fae8ff 0%, #f3e8ff 100%);
}

.card-icon {
  font-size: 2.5rem;
  margin-bottom: 12px;
}

.card-label {
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
  margin-bottom: 8px;
}

.card-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #084c74;
}

/* Shipping Zones */
.shipping-zones {
  background: #f9fafb;
  border-radius: 16px;
  padding: 24px;
}

.zones-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111827;
  margin: 0 0 16px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.zones-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.zone-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  background: white;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
  transition: all 0.3s ease;
}

.zone-item:hover {
  border-color: #0a609d;
  box-shadow: 0 4px 12px rgba(10, 154, 115, 0.1);
}

.zone-name {
  font-weight: 600;
  color: #111827;
  flex: 1;
}

.zone-info {
  display: flex;
  gap: 24px;
}

.zone-detail {
  text-align: right;
}

.detail-label {
  font-size: 0.75rem;
  color: #6b7280;
  margin-bottom: 4px;
}

.detail-value {
  font-weight: 700;
}

.detail-value.delivery {
  color: #0a609d;
}

.detail-value.cost {
  color: #111827;
}

/* Courier Section */
.courier-section {
  margin-bottom: 64px;
}

.courier-title {
  font-size: 2rem;
  font-weight: 700;
  color: #084c74;
  text-align: center;
  margin-bottom: 32px;
}

.courier-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 24px;
}

.courier-card {
  background: white;
  border-radius: 16px;
  padding: 24px;
  border: 1px solid #e5e7eb;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  animation: fadeIn 0.6s ease-out;
  animation-fill-mode: both;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.courier-card:hover {
  border-color: #0a609d;
  box-shadow: 0 12px 24px rgba(10, 154, 115, 0.15);
  transform: translateY(-8px);
}

.courier-logo {
  font-size: 3rem;
  text-align: center;
  margin-bottom: 16px;
}

.courier-name {
  font-size: 1.125rem;
  font-weight: 700;
  color: #111827;
  text-align: center;
  margin: 0 0 12px 0;
}

.courier-badges {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-bottom: 12px;
}

.courier-badge {
  padding: 6px 16px;
  background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
  color: #0a609d;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

.courier-regions {
  font-size: 0.875rem;
  color: #6b7280;
  text-align: center;
}

/* Special Handling */
.special-handling {
  margin-bottom: 64px;
}

.handling-header {
  text-align: center;
  margin-bottom: 32px;
}

.handling-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 20px;
  background: #fff7ed;
  color: #c2410c;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.875rem;
  margin-bottom: 16px;
}

.handling-title {
  font-size: 2rem;
  font-weight: 700;
  color: #084c74;
  margin: 0 0 8px 0;
}

.handling-subtitle {
  color: #6b7280;
  font-size: 1rem;
  margin: 0;
}

.handling-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
  gap: 24px;
}

.handling-card {
  background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
  border-radius: 16px;
  padding: 24px;
  border: 2px solid #e5e7eb;
  transition: all 0.4s ease;
  animation: slideUp 0.6s ease-out;
  animation-fill-mode: both;
}

.handling-card:hover {
  border-color: #0a609d;
  box-shadow: 0 8px 20px rgba(10, 154, 115, 0.1);
}

.handling-content {
  display: flex;
  gap: 16px;
}

.handling-icon {
  font-size: 3rem;
  flex-shrink: 0;
}

.handling-info {
  flex: 1;
}

.handling-item-title {
  font-size: 1.125rem;
  font-weight: 700;
  color: #111827;
  margin: 0 0 8px 0;
}

.handling-description {
  color: #6b7280;
  margin: 0 0 12px 0;
  line-height: 1.6;
}

.handling-note {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  background: #fef3c7;
  border: 1px solid #fbbf24;
  border-radius: 8px;
  font-size: 0.875rem;
}

.note-icon {
  color: #d97706;
}

.note-text {
  color: #92400e;
  font-weight: 500;
}

/* FAQ Section */
.faq-section {
  margin-bottom: 64px;
}

.faq-title {
  font-size: 2rem;
  font-weight: 700;
  color: #084c74;
  text-align: center;
  margin-bottom: 32px;
}

.faq-list {
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.faq-item {
  background: white;
  border-radius: 16px;
  border: 1px solid #e5e7eb;
  overflow: hidden;
  transition: all 0.3s ease;
}

.faq-item:hover {
  border-color: #0a609d;
}

.faq-question {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 24px;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: background 0.3s ease;
  text-align: left;
}

.faq-question:hover {
  background: #f9fafb;
}

.question-text {
  font-weight: 600;
  color: #111827;
  font-size: 1.125rem;
  padding-right: 16px;
}

.question-icon {
  font-size: 1.5rem;
  color: #0a609d;
  transition: transform 0.3s ease;
  flex-shrink: 0;
}

.question-icon.expanded {
  transform: rotate(180deg);
}

.faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-answer.expanded {
  max-height: 500px;
}

.answer-text {
  padding: 0 24px 24px;
  color: #6b7280;
  line-height: 1.7;
  border-top: 1px solid #f3f4f6;
  padding-top: 16px;
  margin: 0 24px 24px;
}

/* Contact CTA */
.contact-cta {
  background: linear-gradient(135deg, #0a609d 0%, #084c74 100%);
  border-radius: 24px;
  padding: 48px 32px;
  text-align: center;
  color: white;
  box-shadow: 0 20px 40px rgba(10, 154, 115, 0.3);
}

.cta-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0 0 16px 0;
}

.cta-subtitle {
  font-size: 1.25rem;
  margin: 0 0 32px 0;
  color: #d1fae5;
}

.cta-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 16px;
}

.cta-btn {
  padding: 16px 32px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 1.125rem;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.cta-btn.primary {
  background: white;
  color: #0a609d;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.cta-btn.primary:hover {
  background: #f0fdf4;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.cta-btn.secondary {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  border: 2px solid white;
}

.cta-btn.secondary:hover {
  background: rgba(255, 255, 255, 0.25);
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 1024px) {
  .handling-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .shipping-section {
    padding: 60px 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-subtitle {
    font-size: 1rem;
  }

  .region-selector {
    flex-direction: column;
  }

  .region-btn {
    width: 100%;
    justify-content: center;
  }

  .detail-cards {
    grid-template-columns: 1fr;
  }

  .zone-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }

  .zone-info {
    width: 100%;
    justify-content: space-between;
  }

  .courier-grid {
    grid-template-columns: 1fr;
  }

  .cta-title {
    font-size: 1.75rem;
  }

  .cta-subtitle {
    font-size: 1rem;
  }

  .cta-buttons {
    flex-direction: column;
  }

  .cta-btn {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 16px;
  }

  .section-header {
    margin-bottom: 48px;
  }
}
</style>