<template>
  <section class="promo-section">
    <div class="container">
      <div class="promo-card">
        <div class="promo-image">
          <img 
            src="/front-assets/img/gallery/TandemVu-PTZZ_1.webp" 
            alt="Hikvision TandemVu PTZ Cameras"
            loading="lazy"
          />
        </div>
        <div class="promo-content">
          <h2 class="promo-title">Hikvision All New TandemVu PTZ Cameras Range</h2>
          <p class="promo-description">
            The TandemVu PTZ cameras feature Hikvision's next-generation camera design, integrating multiple lenses in one security camera to provide big picture and small details in tandem.
          </p>
          <p class="promo-description">
            Equipped with this technology, Hikvision's new TandemVu PTZ cameras display a broad view even when panning, tilting, or zooming. Users will see everything and miss nothing at any given moment, getting situational awareness from the moment they set up the camera.
          </p>
          <a href="/category/cctv-systems" class="promo-btn">View Range</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>

<style scoped>
.promo-section {
  padding: 0;
  background: #fff;
  width: 100%;
}

.container {
  max-width: 100%;
  margin: 0 auto;
  padding: 0 1rem;
}

.promo-card {
  display: grid;
  grid-template-columns: 1fr 1fr;
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  overflow: hidden;
}

.promo-image {
  background: #f9fafb;
  display: flex;
  align-items: center;
  justify-content: center;
}

.promo-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.promo-content {
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  background: #fff;
}

.promo-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #171616;
  margin: 0 0 1rem;
  line-height: 1.3;
}

.promo-description {
  font-size: 0.9375rem;
  color: #666;
  margin: 0 0 0.75rem;
  line-height: 1.6;
}

.promo-btn {
  display: inline-block;
  width: fit-content;
  margin-top: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: #171616;
  color: #ffffff;
  text-decoration: none;
  border-radius: 4px;
  font-weight: 600;
  font-size: 0.9375rem;
  transition: background 0.2s ease;
}

.promo-btn:hover {
  background: #95002a;
}

@media (max-width: 992px) {
  .promo-card {
    grid-template-columns: 1fr;
  }
  
  .promo-image {
    height: 300px;
  }
  
  .promo-content {
    padding: 1.5rem;
  }
  
  .promo-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 540px) {
  .promo-image {
    height: 220px;
  }
  
  .promo-content {
    padding: 1.25rem;
  }
  
  .promo-title {
    font-size: 1.125rem;
  }
  
  .promo-description {
    font-size: 0.875rem;
  }
  
  .promo-btn {
    width: 100%;
    text-align: center;
  }
}
</style>