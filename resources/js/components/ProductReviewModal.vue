<template>
  <div v-if="isVisible" class="product-review-modal">
    <div class="modal-overlay" @click="closeReviewModal"></div>
    <div class="modal-container">
      <form @submit.prevent="submitReview" class="custom-form">
        <div class="form-group">
          <label for="user_name">Name:</label>
          <input v-model="reviewData.user_name" type="text" id="user_name" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="rating">Rating: (1 - Poor, 5 - Excellent)</label>
          <input v-model="reviewData.rating" type="number" id="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group">
          <label for="review_text">Review:</label>
          <textarea v-model="reviewData.review_text" id="review_text" class="form-control" required></textarea>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn-submit" :disabled="isSubmitting">
            {{ isSubmitting ? 'Submitting Review...' : 'Submit Review' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    isVisible: Boolean,
    productId: Number,
  },
  emits: ['submit-review', 'close-modal'],
  setup(props, { emit }) {
    const reviewData = ref({
      user_name: '',
      rating: null,
      review_text: '',
      product_id: props.productId,
    });
    const isSubmitting = ref(false);

    const submitReview = async () => {
  try {
    // Include the product_id in the reviewData
    reviewData.value.product_id = props.productId;

    // Update the isSubmitting flag to show the loading state
    isSubmitting.value = true;

    // Make an Axios POST request to your backend endpoint
    const response = await axios.post('/submit-review', reviewData.value, {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        // Include any additional headers if needed
      },
    });

    // Assuming your backend returns the newly created review, you can emit an event
    // with the new review data to update the UI
    emit('submit-review', response.data);

    // Close the modal after emitting the event
    closeReviewModal();
  } catch (error) {
    // Handle errors
  } finally {
    // Reset the isSubmitting flag after submission (whether success or error)
    isSubmitting.value = false;
  }
};

    const closeReviewModal = () => {
      emit('close-modal');
    };

    return {
      reviewData,
      isSubmitting,
      submitReview,
      closeReviewModal,
    };
  },
};
</script>



<style scoped>
/* Add your existing styles here */

.product-review-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 100;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 10;
}

.modal-container {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  z-index: 11;
  max-width: 400px;
  width: 100%;
}

.form-group {
  margin-bottom: 1rem;
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 0.25rem;
  outline: none;
}

/* Style the submit button */
.btn-submit {
  background-color: #ff0000;
  color: #fff;
  padding: 0.75rem;
  border: none;
  border-radius: 0.25rem;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.btn-submit:hover {
  background-color: #cc0000;
}
</style>
