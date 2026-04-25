<template>
    <div class="modal fade" id="whatsappCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <!-- Your modal content goes here -->
      <form class="material-form" @submit.prevent="placeOrder">
    <h1>Order {{ product.product_name }} Through Whatsapp</h1>
    <input v-model="deliveryLocation" placeholder="Where should your order be delivered?" type="text" required>
    <input v-model.number="quantity" placeholder="How Many pieces do you need?" type="number" required>
    <button type="submit">Place Your Order</button>

    <p class="text-right text-sm font-weight-bold text-primary-1 mb-3">
      <span>{{ product.product_name }} ({{ product.selling_price }} KES each) x {{ quantity }} = {{ totalPrice }} KES</span>
    </p>
    <button @click="closeModal">Close</button>
  </form>
      
    </div>
  </template>
  
  <script>
  export default {
    props: {
      product: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        deliveryLocation: '',
        quantity: 1
      };
    },
    computed: {
      totalPrice() {
        return this.quantity * this.product.selling_price;
      }
    },
    methods: {
      placeOrder() {
    // Get the current URL
    const currentUrl = window.location.href;

    // Construct the WhatsApp message
    const whatsappMessage = `Hi, I'd like to order ${this.quantity} ${this.product.product_name}(s). Deliver to: ${this.deliveryLocation}. Total cost: ${this.totalPrice} KES. Order from: ${currentUrl}`;

    // Construct the WhatsApp link
    const whatsappLink = `https://wa.me/+254798742543?text=${encodeURIComponent(whatsappMessage)}`;

    // Open the WhatsApp link in a new window
    window.open(whatsappLink, '_blank');

    // Close the modal after placing the order
    this.closeModal();
  },
      closeModal() {
        // Emit a custom event to notify the parent component to close the modal
        this.$emit('close');
      }
    }
  };
  </script>
  
  
  <style scoped>
            
  .material-form {
    box-sizing: border-box;
    width: 350px; /* Increase the width to your desired value */
    margin: 100px auto 0;
    box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.2);
    padding-bottom: 40px;
    border-radius: 3px;
    background-color: white;
    padding: 20px;
  }

  .material-form h1 {
    box-sizing: border-box;
    padding: 20px;
    height: 100px;
    width: 100%;
    font-size: 18px;
    background: #25D366;
    color: white;
    line-height: 150%;
    border-radius: 3px 3px 0 0;
    box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.2);
  }

  .material-form input {
    margin: 40px 25px;
    width: 250px; /* Adjusted width for the input */
    display: block;
    border: none;
    padding: 10px 0;
    border-bottom: solid 1px #25D366;
    transition: all 0.3s cubic-bezier(.64, .09, .08, 1);
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #25D366 4%);
    background-position: -200px 0;
    background-size: 200px 100%;
    background-repeat: no-repeat;
    color: darken(#25D366, 20%);
  }

  .material-form input:focus,
  .material-form input:valid {
    box-shadow: none;
    outline: none;
    background-position: 0 0;
  }

  .material-form input::-webkit-input-placeholder {
    color: #25D366;
    font-size: 11px;
    transform: translateY(-20px);
    visibility: visible !important;
  }

  .material-form button {
    border: none;
    background: #25D366;
    cursor: pointer;
    border-radius: 3px;
    padding: 6px;
    width: 250px; /* Adjusted width for the button */
    color: white;
    margin-left: 25px;
    box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.2);
  }

  .material-form button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
  }

  .material-form p {
    color: red;
    margin-top: 10px;
  }
</style>
 
