<template>
  <div v-if="activeProduct" class="material-form">
    <h1>Buy {{ activeProduct.product_name }}</h1>
    <p>Quantity: <input v-model="quantity" type="number" /></p>
    <button @click="addToCart" :disabled="isAddedToCart" :class="{ 'grey-button': isAddedToCart }">
      {{ isAddedToCart ? 'Added to Cart' : 'Add to Cart' }}
    </button>
    <p class="total-price" v-if="quantity > 0">
      Total Price: <span class="total-price-value">{{ calculateTotalPrice() }}</span>
    </p>
    <button @click="checkoutOrClose" :class="{ 'red-button': isAddedToCart }">
      {{ isAddedToCart ? 'Proceed to Checkout' : 'Close' }}
    </button>
    <button v-if="isAddedToCart" class="other-vapes-button" @click="goToCatalog">
      Continue Shopping
    </button>
  </div>
</template>

<script>
import toastr from 'toastr';
import axios from 'axios';
import { useCartStore } from '../store/cart';

export default {
  props: {
    isOpen: Boolean,
    activeProduct: Object,
    checkoutUrl: String, // Define checkoutUrl prop
  },
  data() {
    return {
      quantity: 1,
      isAddedToCart: false,
      messageType: null,
      store: useCartStore(),
    };
  },
  methods: {
    addToCart() {
      if (this.activeProduct && this.quantity > 0 && !this.isAddedToCart) {
        let sellingPrice = this.activeProduct.selling_price;
        if (this.quantity >= 10) {
          sellingPrice = 1500;
        }

        const cartItem = {
          product_id: this.activeProduct.id,
          product_name: this.activeProduct.product_name,
          selling_price: sellingPrice,
          quantity: this.quantity,
        };

        axios.post("/pos/add-to-cart", cartItem)
          .then((response) => {
            console.log(response.data);
            this.messageType = 'success';
            this.store.getCartItems();
          })
          .catch((error) => {
            console.error(error);
            this.messageType = 'error';
          })
          .finally(() => {
            this.isAddedToCart = true;
            toastr[this.messageType]('Product added to cart successfully');
          });
      }
    },

    calculateTotalPrice() {
      let totalPrice = this.quantity * this.activeProduct.selling_price;
      // if (this.quantity >= 10 && this.quantity < 90) {
      //   totalPrice = this.quantity * 1500;
      // } else if (this.quantity >= 90) {
      //   totalPrice = this.quantity * 1300;
      // }
      return totalPrice;
    },

    goToCatalog() {
  axios.get("/")
    .then((response) => {
      // Check if the response is HTML
      if (response.headers['content-type'].includes('text/html')) {
        // If it's HTML, you might want to handle it differently, such as opening it in a new tab
        window.open('/', '_blank');
      } else {
        // If it's JSON, try to extract the catalog route URL
        const data = response.data;
        if (data && data.catalogUrl) {
          window.location.href = data.catalogUrl;
        } else {
          console.error("Catalog URL not found in response:", response);
        }
      }
    })
    .catch((error) => {
      console.error("Error fetching catalog URL:", error);
    });
},

    checkoutOrClose() {
      if (this.isAddedToCart) {
        axios.get("/checkout")
          .then((response) => {
            // Check if the response is HTML
            if (response.headers['content-type'].includes('text/html')) {
              // If it's HTML, you might want to handle it differently, such as opening it in a new tab
              window.open('/checkout', '_blank');
            } else {
              // If it's JSON, try to extract the checkoutUrl
              const data = response.data;
              if (data && data.checkoutUrl) {
                window.location.href = data.checkoutUrl;
              } else {
                console.error("Checkout URL not found in response:", response);
              }
            }
          })
          .catch((error) => {
            console.error("Error fetching checkout URL:", error);
          });
      } else {
        this.closeModal();
      }
    },

    closeModal() {
      this.isAddedToCart = false;
      this.messageType = null;
      this.$emit('close');
    },
  },
};
</script>

<style scoped>
.material-form {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1000;
  box-sizing: border-box;
  width: 350px;
  margin: 100px auto 0;
  box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.2);
  padding-bottom: 40px;
  border-radius: 3px;
  background-color: white;
  padding: 20px;
}

.total-price {
  color: red;
  margin-top: 10px;
}

.total-price-value {
  font-weight: bold;
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

.material-form p {
  margin: 0;
}

.material-form input {
  margin: 20px 0;
  width: 100%;
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
  padding: 10px;
  width: 100%;
  color: white;
  margin: 20px 0;
  box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.2);
}

.material-form button:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
}

.red-button {
  background-color: red !important;
}

.grey-button {
  background-color: rgba(235, 226, 226, 0.892) !important;
}

</style>
