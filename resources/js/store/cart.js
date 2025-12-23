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
            const existingProduct = this.cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
            this.calculateTotalCost();
        }, 

        incrementQuantityInCart(id){
            const item = this.cart.find(item => item.id === id);
            if (item) {
                item.quantity += 1;
                this.calculateTotalCost();
            }
        },
        decrementQuantityInCart(id){
            const item = this.cart.find(item => item.id === id);
            if (item && item.quantity > 1) {
                item.quantity -= 1;
            } else {
                this.removeFromCart(id);
            }
            this.calculateTotalCost();
        },
        removeFromCart(id){
            this.cart = this.cart.filter(item => item.id !== id);
            this.calculateTotalCost();
        },
   
        clearCart(){
            this.cart = [];
            this.cartTotal = 0;
        },

        submitOrder(){
            axios.post('/save-cart', {cart: this.cart})
            .then(response => console.log(response))
            .catch(error => console.error(error));
        },

        calculateTotalCost(){
            this.cartTotal = this.cart.reduce((total, item) => {
                return total + (item.selling_price * item.quantity); // Changed from item.price to item.selling_price
            }, 0);
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
            this.cartTotal = this.cart.reduce((total, item) => {
                return total + (item.selling_price * item.quantity); // Changed from item.price to item.selling_price
            }, 0);
          },

          updateQuantity(id, quantity) {
            const item = this.cart.find(item => item.id === id);
            if (item) {
              // Ensure minimum quantity is 1
              item.quantity = Math.max(1, parseInt(quantity) || 1);
              this.updateTotals();
            }
          },

          incrementQuantityInCart(id) {
            const item = this.cart.find(item => item.id === id);
            if (item) {
              item.quantity++;
              this.updateTotals();
            }
          },

          decrementQuantityInCart(id) {
            const item = this.cart.find(item => item.id === id);
            if (item && item.quantity > 1) {
              item.quantity--;
              this.updateTotals();
            }
          },

          updateTotals() {
            // Recalculate cart total
            this.cartTotal = this.cart.reduce((total, item) => {
              return total + (item.selling_price * item.quantity);
            }, 0);
          }

    }
})
