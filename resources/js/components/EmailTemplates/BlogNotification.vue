<template>
  <div class="email-container">
    <div class="header">
      <img :src="'/front-assets/img/brand-logo/logo.png'" alt="WabeGadgets Logo" class="logo">
    </div>

    <div class="blog-content">
      <img v-if="blog.image" :src="blog.image" :alt="blog.name" class="blog-image">

      <h1 class="blog-title">{{ blog.name }}</h1>
      
      <div class="blog-description">
        {{ truncateDescription(blog.description, 200) }}
      </div>

      <a :href="blogUrl" class="read-more-btn">Read More</a>
    </div>

    <div class="social-links">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>

    <div class="footer">
      <p>© {{ currentYear }} wabegadgets. All rights reserved.</p>
      <p>If you no longer wish to receive these emails, you can <a href="/unsubscribe">unsubscribe here</a></p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BlogNotification',
  props: {
    blog: {
      type: Object,
      required: true
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear();
    },
    blogUrl() {
      return `/blog/${this.blog.slug}`;
    }
  },
  methods: {
    truncateDescription(text, length) {
      if (!text) return '';
      text = text.replace(/<[^>]*>/g, ''); // Remove HTML tags
      return text.length > length ? text.substring(0, length) + '...' : text;
    }
  }
}
</script>

<style scoped>
.email-container {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.header {
  text-align: center;
  margin-bottom: 30px;
}

.logo {
  max-width: 150px;
  height: auto;
}

.blog-image {
  width: 100%;
  max-height: 300px;
  object-fit: cover;
  margin-bottom: 20px;
}

.blog-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 15px;
}

.blog-description {
  margin-bottom: 25px;
}

.read-more-btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #333;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  margin-bottom: 30px;
}

.social-links {
  text-align: center;
  margin-bottom: 20px;
}

.social-links a {
  margin: 0 10px;
  color: #333;
  text-decoration: none;
}

.footer {
  text-align: center;
  font-size: 12px;
  color: #666;
  border-top: 1px solid #eee;
  padding-top: 20px;
}

.footer a {
  color: #333;
  text-decoration: underline;
}
</style> 