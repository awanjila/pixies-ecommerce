<template>
    <div class="blog-container">
      <div class="meta-info">
        <p class="author">By <span class="bold">{{ blog.author }}</span></p>
        <div class="separator"></div> <!-- Vertical line -->
        <p>{{ formatDate(blog.created_at) }}</p>
      </div>
  
      <!-- Share section -->
      <div class="share-section">
        <p class="share-text">Share:</p>
        <div class="social-icons">
            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>

          <a href="https://www.facebook.com/sharer/sharer.php?u={{ encodeURIComponent(window.location.href) }}" class="social-icon"><i class="bi bi-facebook"></i></a>
          <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ encodeURIComponent(window.location.href) }}" class="social-icon"><i class="bi bi-linkedin"></i></a>
          <a href="https://www.instagram.com/?url={{ encodeURIComponent(window.location.href) }}" class="social-icon"><i class="bi bi-instagram"></i></a>
          <a href="whatsapp://send?text={{ encodeURIComponent(window.location.href) }}" class="social-icon"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      blog: {
        type: Object,
        required: true
      }
    },
    methods: {
      formatDate(date) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(date).toLocaleDateString('en-US', options); // Convert date to "Aug 31, 2018" format
      }
    }
  }
  </script>
  
  <style scoped>
  .blog-container {
    position: absolute;
    top: 20px;
    left: 40px; /* Adjust left positioning */
    
    padding: 10px;
    
  }
  
  .meta-info {
    font-size: 14px;
  }
  
  .author {
    display: flex;
    align-items: center; /* Align items vertically */
  }
  
  .bold {
    font-weight: bold; /* Make text bold */
    margin-left: 5px; /* Add margin for spacing */
  }
  
  .separator {
    width: 1px; /* Width of the vertical line */
    height: 20px; /* Height of the line */
    background-color: #ccc; /* Color of the line */
    margin: 0 5px; /* Adjust spacing */
  }
  
  .share-section {
    margin-top: 20px; /* Adjust spacing */
    display: flex;
    align-items: center; /* Align items horizontally */
  }
  
  .share-text {
    margin-right: 10px; /* Adjust spacing */
  }
  
  .social-icons {
    display: flex;
  }
  
  .social-icon {
    margin-right: 10px; /* Adjust spacing */
    text-decoration: none;
  }
  
  </style>