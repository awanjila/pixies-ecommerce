<template>
  <div class="shipping-page">
    <div class="page-header">
      <div class="container">
        <h1>Shipping Information</h1>
        <p>Delivery options and policies for Pixies Technologies</p>
      </div>
    </div>
    <div class="container">
      <div class="content">
        <div class="info-card">
          <h2>Delivery Areas</h2>
          <ul>
            <li><span class="label">Nairobi</span> - Delivery within 1-2 business days</li>
            <li><span class="label">Major Cities</span> - Delivery within 2-3 business days</li>
            <li><span class="label">Remote Areas</span> - Delivery within 3-5 business days</li>
          </ul>
        </div>
        
        <div class="info-card">
          <h2>Shipping Costs</h2>
          <ul>
            <li><span class="label">Nairobi</span> - KES 300</li>
            <li><span class="label">Major Cities</span> - KES 500</li>
            <li><span class="label">Remote Areas</span> - KES 1,500</li>
          </ul>
        </div>
        
        <div class="info-card">
          <h2>Contact Us</h2>
          <p>For shipping inquiries:</p>
          <p><a href="tel:+254798742543">+254 798 742 543</a></p>
          <p><a href="mailto:info@pixies.co.ke">info@pixies.co.ke</a></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.shipping-page {
  min-height: 100vh;
  background: #f9fafb;
}

.page-header {
  background: #171616;
  padding: 3rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

h1 {
  color: #ffffff;
  margin: 0 0 0.5rem;
  font-size: 2rem;
  font-weight: 700;
}

.page-header p {
  color: #999;
  margin: 0;
}

.content {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

.info-card {
  background: #ffffff;
  padding: 1.5rem;
  border-radius: 8px;
  border: 1px solid #e5e5e5;
}

.info-card h2 {
  margin: 0 0 1rem;
  font-size: 1.25rem;
  font-weight: 600;
  color: #171616;
}

.info-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.info-card li {
  padding: 0.625rem 0;
  border-bottom: 1px solid #f3f4f6;
  color: #666;
}

.info-card li:last-child {
  border-bottom: none;
}

.info-card .label {
  font-weight: 600;
  color: #171616;
}

.info-card a {
  color: #95002a;
  text-decoration: none;
}

.info-card a:hover {
  text-decoration: underline;
}

@media (max-width: 768px) {
  .content {
    grid-template-columns: 1fr;
  }
}
</style>