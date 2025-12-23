import { defineStore } from 'pinia';

export const useReviewStore = defineStore({
  id: 'review', // Make sure you have a unique store id
  state: () => ({
    isReviewModalVisible: false,
    reviews: [], // Initial reviews array
  }),
  actions: {
    toggleReviewModal() {
      this.isReviewModalVisible = !this.isReviewModalVisible;
    },
    submitReview(reviewData) {
      // Handle submitting review logic here
      console.log('Review submitted:', reviewData);
      this.reviews.push(reviewData); // Update reviews array (replace this with your logic)
      this.closeReviewModal();
    },
    closeReviewModal() {
      this.isReviewModalVisible = false;
    },

    setReviews(reviews) {
      this.reviews = reviews;
    },
  },
});


