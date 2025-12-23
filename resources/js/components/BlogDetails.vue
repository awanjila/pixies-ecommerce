<template> 
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ blog.name }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>{{ blog.name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PAGE DETAILS AREA START (blog-details) -->
    <div class="ltn__page-details-area ltn__blog-details-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__blog-details-wrap">
                        <div class="ltn__page-details-inner ltn__blog-details-inner">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Dealers in Medical Supplies & Equipments</a>
                                    </li>
                                </ul>
                            </div>
                            <h2 class="ltn__blog-title">{{ blog.name }}
                            </h2>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><img src="img/blog/author.jpg" alt="#">By: {{ blog.author }}</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>{{ formatDate(blog.created_at) }}
                                    </li>

                                </ul>
                            </div>
                            <div v-html="blog.description" class="blog-description"></div>
                          
                            <img :src="getImageUrl(blog.image)" :alt="blog.name">
                            
                           
                        </div>
                        <!-- blog-tags-social-media -->
                        <div class="ltn__blog-tags-social-media mt-80 row">
                        
                            <div class="ltn__social-media text-right text-end col-lg-4">
                                <h4>Social Share</h4>
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    
                                    <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <!-- prev-next-btn -->
                        <div class="ltn__prev-next-btn row mb-50">
                            <div class="blog-prev col-lg-6" v-if="previousPost">
                                <h6>Prev Post</h6>
                                <h3 class="ltn__blog-title">
                                    <a :href="`/blogs/${previousPost.slug}`">{{ previousPost.name }}</a>
                                </h3>
                            </div>
                            <div class="blog-prev blog-next text-right text-end col-lg-6" v-if="nextPost">
                                <h6>Next Post</h6>
                                <h3 class="ltn__blog-title">
                                    <a :href="`/blogs/${nextPost.slug}`">{{ nextPost.name }}</a>
                                </h3>
                            </div>
                        </div>
                        <hr>
                        <!-- related-post -->
                        <div class="related-post-area mb-50">
                            <h4 class="title-2">Related Posts</h4>
                            <div class="row" v-if="relatedBlogs && relatedBlogs.length > 0">
                                <div class="col-md-6" v-for="relatedBlog in relatedBlogs" :key="relatedBlog.id">
                                    <!-- Blog Item -->
                                    <div class="ltn__blog-item ltn__blog-item-6">
                                        <div class="ltn__blog-img">
                                            <a :href="`/blogs/${relatedBlog.slug}`">
                                                <img :src="getImageUrl(relatedBlog.image)" :alt="relatedBlog.name">
                                            </a>
                                        </div>
                                        <div class="ltn__blog-brief">
                                            <div class="ltn__blog-meta">
                                                <ul>
                                                    <li class="ltn__blog-date ltn__secondary-color">
                                                        <i class="far fa-calendar-alt"></i>{{ formatDate(relatedBlog.created_at) }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <h3 class="ltn__blog-title">
                                                <a :href="`/blogs/${relatedBlog.slug}`">{{ relatedBlog.name }}</a>
                                            </h3>
                                            <p>{{ truncateText(relatedBlog.description, 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="no-related-posts">
                                <p>No related posts available at the moment.</p>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
                        <!-- Author Widget -->
                        <!-- Popular Post Widget -->
                        <div class="widget ltn__popular-post-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Latest Blogs</h4>
                            <ul v-if="latestBlogs && latestBlogs.length > 0">
                                <li v-for="blog in latestBlogs" :key="blog.id">
                                    <div class="popular-post-widget-item clearfix">
                                        <div class="popular-post-widget-img">
                                            <a :href="`/blogs/${blog.slug}`">
                                                <img :src="getImageUrl(blog.image)" :alt="blog.name">
                                            </a>
                                        </div>
                                        <div class="popular-post-widget-brief">
                                            <h6>
                                                <a :href="`/blogs/${blog.slug}`">{{ blog.name }}</a>
                                            </h6>
                                            <div class="ltn__blog-meta">
                                                <ul>
                                                    <li class="ltn__blog-date">
                                                        <i class="far fa-calendar-alt"></i>{{ formatDate(blog.created_at) }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div v-else class="no-blogs-message">
                                <p>No blogs available at the moment.</p>
                            </div>
                        </div>
                    
                        <!-- Social Media Widget -->
                        <div class="widget ltn__social-media-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
                            <div class="ltn__social-media-2">
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                       
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget d-none">
                            <a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>
                        </div>
                        <!-- Instagram Widget -->
                        <div class="widget ltn__instagram-widget d-none">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Instagram Feeds</h4>
                            <div class="ltn__instafeed ltn__instafeed-grid insta-grid-gutter"></div>
                        </div>
                        
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE DETAILS AREA END -->
</template>

<script>
import axios from 'axios';
export default {
  props: {
    blog: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      showModal: false,
      subscribeForm: {
        name: '',
        email: ''
      },
      relatedBlogs: [],
      previousPost: null,
      nextPost: null,
      latestBlogs: [],
    }
  },
  methods: {
    getImageUrl(url) {
      return url.startsWith('http') ? url : `/${url}`;
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    },
    openModal() {
      this.showModal = true;
      document.body.style.overflow = 'hidden';
    },
    closeModal() {
      this.showModal = false;
      document.body.style.overflow = '';
    },
    handleSubscribe() {
      // Handle subscription logic here
      console.log('Form submitted:', this.subscribeForm);
      this.closeModal();
    },
    truncateText(text, length) {
      // Remove HTML tags and truncate text
      const strippedText = text.replace(/<[^>]*>/g, '');
      return strippedText.length > length 
        ? strippedText.substring(0, length) + '...' 
        : strippedText;
    },

    async fetchRelatedBlogs() {
      try {
        const response = await axios.get(`/api/blogs/related/${this.blog.id}`);
        if (response.data.status === 200) {
          this.relatedBlogs = response.data.blogs;
        }
      } catch (error) {
        console.error('Error fetching related blogs:', error);
      }
    },

    async fetchPrevNextPosts() {
      try {
        const response = await axios.get(`/api/blogs/navigation/${this.blog.id}`);
        if (response.data.status === 200) {
          this.previousPost = response.data.previous;
          this.nextPost = response.data.next;
        }
      } catch (error) {
        console.error('Error fetching previous/next posts:', error);
      }
    },

    async fetchLatestBlogs() {
      try {
        const response = await axios.get('/api/blogs/latest');
        if (response.data.status === 200) {
          this.latestBlogs = response.data.blogs;
        }
      } catch (error) {
        console.error('Error fetching latest blogs:', error);
      }
    }
  },
  mounted() {
    this.fetchRelatedBlogs();
    this.fetchPrevNextPosts();
    this.fetchLatestBlogs();
  }
}
</script>

<style scoped>
/* ... existing styles ... */

.related-post-area {
  margin-top: 50px;
  padding: 30px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.title-2 {
  font-size: 24px;
  margin-bottom: 30px;
  color: #333;
  position: relative;
  padding-bottom: 15px;
}

.title-2:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 50px;
  height: 2px;
  background: #28a745;
}

.ltn__blog-item {
  margin-bottom: 30px;
  transition: transform 0.3s ease;
}

.ltn__blog-item:hover {
  transform: translateY(-5px);
}

.ltn__blog-img {
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 15px;
}

.ltn__blog-img img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.ltn__blog-img img:hover {
  transform: scale(1.05);
}

.ltn__blog-brief {
  padding: 15px;
}

.ltn__blog-meta ul {
  padding: 0;
  margin: 0 0 10px;
  list-style: none;
}

.ltn__blog-date {
  font-size: 14px;
  color: #666;
}

.ltn__blog-date i {
  margin-right: 5px;
  color: #28a745;
}

.ltn__blog-title {
  font-size: 18px;
  margin-bottom: 10px;
}

.ltn__blog-title a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s ease;
}

.ltn__blog-title a:hover {
  color: #28a745;
}

.no-related-posts {
  text-align: center;
  padding: 30px;
  background: #f8f9fa;
  border-radius: 8px;
  color: #666;
}

.ltn__prev-next-btn {
  margin: 40px 0;
  padding: 20px 0;
  border-top: 1px solid #eee;
  border-bottom: 1px solid #eee;
}

.blog-prev h6,
.blog-next h6 {
  color: #666;
  margin-bottom: 10px;
  font-size: 14px;
}

.blog-prev .ltn__blog-title,
.blog-next .ltn__blog-title {
  margin: 0;
}

.blog-prev .ltn__blog-title a,
.blog-next .ltn__blog-title a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s ease;
  font-size: 18px;
  line-height: 1.4;
}

.blog-prev .ltn__blog-title a:hover,
.blog-next .ltn__blog-title a:hover {
  color: #28a745;
}

.blog-next {
  text-align: right;
}

.popular-post-widget-item {
  display: flex;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
}

.popular-post-widget-img {
  flex: 0 0 80px;
  margin-right: 15px;
}

.popular-post-widget-img img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 5px;
}

.popular-post-widget-brief {
  flex: 1;
}

.popular-post-widget-brief h6 {
  margin: 0 0 5px;
  font-size: 14px;
  line-height: 1.4;
}

.popular-post-widget-brief h6 a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s ease;
}

.popular-post-widget-brief h6 a:hover {
  color: #28a745;
}

.ltn__blog-meta ul {
  padding: 0;
  margin: 0;
  list-style: none;
}

.ltn__blog-date {
  font-size: 12px;
  color: #666;
}

.ltn__blog-date i {
  margin-right: 5px;
  color: #28a745;
}

.no-blogs-message {
  padding: 20px;
  text-align: center;
  background: #f8f9fa;
  border-radius: 5px;
  color: #666;
}

@media (max-width: 768px) {
  .related-post-area {
    padding: 20px;
  }

  .ltn__blog-img img {
    height: 160px;
  }

  .ltn__blog-title {
    font-size: 16px;
  }

  .blog-prev,
  .blog-next {
    margin-bottom: 20px;
  }

  .blog-prev .ltn__blog-title a,
  .blog-next .ltn__blog-title a {
    font-size: 16px;
  }

  .popular-post-widget-img {
    flex: 0 0 60px;
    margin-right: 10px;
  }

  .popular-post-widget-img img {
    width: 60px;
    height: 60px;
  }

  .popular-post-widget-brief h6 {
    font-size: 13px;
  }
}
</style>

