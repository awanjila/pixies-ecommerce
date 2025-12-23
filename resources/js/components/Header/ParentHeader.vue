<template>
    <div>
      <!-- Mobile Header -->
      <MobileHeader v-if="isMobile" />
  
      <!-- Desktop Header -->
      <DesktopHeader v-else />
    </div>
  </template>
  
  <script>
  import DesktopHeader from './DesktopHeader.vue';
  import MobileHeader from './MobileHeader.vue';
  
  export default {
    components: {
      DesktopHeader,
      MobileHeader,
    },
    data() {
      return {
        isMobile: window.innerWidth <= 768,
      };
    },
    mounted() {
      window.addEventListener('resize', this.checkScreenSize);
    },
    beforeDestroy() { // For Vue 2
      window.removeEventListener('resize', this.checkScreenSize);
    },
    beforeUnmount() { // For Vue 3
      window.removeEventListener('resize', this.checkScreenSize);
    },
    methods: {
      checkScreenSize() {
        this.isMobile = window.innerWidth <= 768;
      },
    },
  };
  </script>
  
  <style scoped>
  .main-content {
    padding: 20px;
    background-color: #f7f7f7;
  }
  </style>
  