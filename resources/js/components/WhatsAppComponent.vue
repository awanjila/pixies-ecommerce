<template>
  <div>
    <div v-if="isMobile" class="whatsapp-btn whatsapp-btn-mobile" @click="sendMessage">
      <i class="bi bi-whatsapp"></i>
    </div>
    <div v-else class="whatsapp-btn-desktop" @click="sendMessage">
      <i class="bi bi-whatsapp"></i> How can We Help You Today?
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isMobile: false
    };
  },
  mounted() {
    this.checkIsMobile();
    window.addEventListener('resize', this.checkIsMobile);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.checkIsMobile);
  },
  methods: {
    checkIsMobile() {
      this.isMobile = window.innerWidth <= 768; // Adjust breakpoint as needed
    },
    sendMessage() {
      const phoneNumber = '+254711682744';
      const message = encodeURIComponent("Hi wabegadgets, I would like to know more about the products that you have.");
      const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
      window.open(whatsappUrl, '_blank');
    }
  }
};
</script>

<style scoped>
.whatsapp-btn {
  position: fixed;
  bottom: 20px;
  background-color: #25d366; /* WhatsApp green color */
  color: #fff;
  padding: 20px; /* Increase padding to make the button larger */
  border-radius: 50%; /* Rounded shape */
  border: 2px solid #25d366; /* Green border */
  cursor: pointer;
  transition: background-color 0.3s; /* Smooth color transition */
  z-index: 9999; /* Make the button float on top of other elements */
  display: flex; /* Center the icon vertically and horizontally */
  justify-content: center;
  align-items: center;
}

.whatsapp-btn-mobile {
  left: 20px; /* Move to the right on mobile */
}

.whatsapp-btn-desktop {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #25d366; /* WhatsApp green color */
  color: #fff;
  padding: 10px 20px; /* Adjust padding for rectangle shape */
  border-radius: 20px; /* Rounded edges for rectangle shape */
  border: 2px solid #25d366; /* Green border */
  cursor: pointer;
  transition: background-color 0.3s; /* Smooth color transition */
  z-index: 9999; /* Make the button float on top of other elements */
}

.whatsapp-btn-desktop i {
  margin-left: 5px;
}

.whatsapp-btn:hover, .whatsapp-btn-desktop:hover {
  background-color: #128c7e; /* Darker shade on hover */
}

@media (min-width: 769px) {
  .whatsapp-btn {
    display: none; /* Hide on mobile */
  }
  
  .whatsapp-btn-desktop {
    display: flex; /* Show on desktop */
  }
}
</style>
