<template>
  <div class="product-review-section">
    <h3 class="tp-product-details-review-number-title">What Customers Say about {{ productName }}</h3>
    <div class="product-reviews">
      <div v-for="review in latestTwoReviews" :key="review.id" class="review">
        <div class="review-header">
          <div class="name-date">
            <p class="name">{{ review.user_name }}</p>
            <p class="date">{{ formatReviewDate(review.created_at) }}</p>
          </div>
          <div class="review-rating">
            <ion-icon
              v-for="i in 5"
              :key="i"
              :name="i <= review.rating ? 'star' : 'star-outline'"
            ></ion-icon>
          </div>
        </div>
        <p class="review-text">{{ review.review_text }}</p>
      </div>
    </div>

    <button @click.prevent="toggleReviewModal" class="write-review-btn custom-width center-button">
      Write a Product Review
    </button>

    <product-review-modal
      :is-visible="isReviewModalVisible"
      @submit-review="submitReview"
      @close-modal="closeReviewModal"
      :product-id="productId"
    />
  </div>
</template>

<script>
import ProductReviewModal from './ProductReviewModal.vue';
import { ref, onMounted, computed } from 'vue';
import { useReviewStore } from '../store/reviewStore';
import dayjs from 'dayjs';

export default {
  props: {
    productName: String,
    reviews: Array,
    productId: Number,
  },
  components: {
    ProductReviewModal,
  },
  setup(props) {
    const store = useReviewStore();
    const isReviewModalVisible = ref(false);
    const productId = ref(props.productId); // Making productId reactive

    const toggleReviewModal = () => {
      isReviewModalVisible.value = !isReviewModalVisible.value;
    };

    const submitReview = (reviewData) => {
      store.submitReview(reviewData);
      closeReviewModal();
    };

    const closeReviewModal = () => {
      isReviewModalVisible.value = false;
    };

    const formatReviewDate = (date) => {
      return dayjs(date).format('MMMM D, YYYY');
    };

    const latestTwoReviews = computed(() => store.reviews.slice(0, 4));

    const fetchReviewsFromDatabase = async () => {
    try {
        const response = await fetch(`/reviews/${productId.value}`);
        const data = await response.json();
        return data.reviews;
    } catch (error) {
        console.error('Error fetching reviews:', error);
        return [];
    }
};

    onMounted(async () => {
      try {
        const response = await fetchReviewsFromDatabase();
        store.setReviews(response);
        latestTwoReviews.value = store.reviews.slice(0, 2);
      } catch (error) {
        console.error('Error fetching reviews:', error);
      }
    });

    return {
      isReviewModalVisible,
      toggleReviewModal,
      submitReview,
      closeReviewModal,
      formatReviewDate,
      latestTwoReviews,
    };
  },
};
</script>
