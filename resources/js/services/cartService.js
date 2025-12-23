import axios from 'axios';

const CartService = {
    getCartItems() {
        return axios.get('/cart-items'); // Adjust the API endpoint based on your routes
    },
};

export default CartService;