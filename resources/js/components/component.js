const applyCoupon = () => {
      console.log("Applying coupon...");
      if (cartItems.value) {
        console.log("Cart items:", cartItems.value);

        const itemCount = Object.keys(cartItems.value).length;
        console.log("Number of items in cart:", itemCount);

        let totalPrice = 0;

        if (itemCount === 1) {
          console.log("Applying coupon for single item");
          // If there is only one item in the cart, set the total price to 1500
          totalPrice = 1500;
        } else if (itemCount >= 10) {
          console.log("Applying coupon for 10 or more items");
          let assortedItemsCount = 0;
          let nonAssortedItemsCount = 0;

          for (const key in cartItems.value) {
            if (cartItems.value[key].qty === 1) {
              assortedItemsCount++;
            } else {
              nonAssortedItemsCount += cartItems.value[key].qty;
            }
          }

          totalPrice = assortedItemsCount * 1400 + nonAssortedItemsCount * 1800;
        } else {
          console.log("No coupon applied");
          for (const key in cartItems.value) {
            totalPrice += cartItems.value[key].subtotal;
          }
        }

        console.log("Total price before applying coupon:", totalPrice);

        // Update the total price in the cart
        store.updateTotalPrice(totalPrice);
      }
    };