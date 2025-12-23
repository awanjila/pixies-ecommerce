import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";

export const useCartStore = defineStore('cart', {
    state: ()=>({
        cart: useLocalStorage('cart', []),
        cartTotal: useLocalStorage('cart_total', 0),
    }), 
    actions: {

        addToCart(product){
            this.cart.push(product);
            this.calculateTotalCost();
        }, 

        incrementQuantityInCart(id){
            let itemIndex = this.cart.findIndex(item => item.id == id);
            this.cart[itemIndex].quantity++;
            this.calculateTotalCost();
        },
        decrementQuantityInCart(id){
            let itemIndex = this.cart.findIndex(item => item.id == id);
            if(this.cart[itemIndex].quantity<2)
            {
                this.removeFromCart(id);
            }
            else{
                this.cart[itemIndex].quantity--;
            }
            this.calculateTotalCost();
        },
        removeFromCart(id){
            this.cart = this.cart.filter(item => item.id != id);
            this.calculateTotalCost();
        },
   
        clearCart(){
            this.cart = [];
        },

        submitOrder(){
            axios.post('/save-cart', {cart: this.cart})
            .then(response => console.log(response))
            .catch(error => console.error(error));
        },

        calculateTotalCost(){
            let sum = 0;
            for(const item of this.cart){
                sum += parseInt(item.price * item.quantity);
            }
            this.cartTotal = sum;
        }, 

        applyCoupon(promoCode) {
            // Check if the promo code is "AMORE"
            if (promoCode === "AMORE") {
              let hasSameItems = false;
              let assortedItemsCount = 0;
      
              // Loop through the cart to check for same items and assorted items
              for (const item of this.cart) {
                if (!hasSameItems && item.quantity > 1) {
                  hasSameItems = true; // Set flag if same items are found
                }
                if (item.type === "assorted") {
                  assortedItemsCount += item.quantity; // Accumulate assorted items count
                }
              }
      
              // Apply discount based on the conditions
              if (hasSameItems) {
                // Apply 20% discount on the total price
                this.cartTotal *= 0.8; // Multiply by 0.8 to apply 20% discount
              } else if (assortedItemsCount >= 10) {
                // Apply 33% discount on the total price
                this.cartTotal *= 0.67; // Multiply by 0.67 to apply 33% discount
              }
            }
          },
      
          calculateTotalCost() {
            // Recalculate cart total after applying coupon (if any)
            let sum = 0;
            for (const item of this.cart) {
              sum += parseInt(item.price * item.quantity);
            }
            this.cartTotal = sum;
          }

    }
})