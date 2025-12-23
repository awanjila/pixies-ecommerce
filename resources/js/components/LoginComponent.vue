<template>
    <form @submit.prevent="submitForm">
        <div class="tp-return-customer-input">
            <input type="email" v-model="user.email" placeholder="Enter Your Email Address">
            <label>Your order details will be sent to this Email Address.</label>
        </div>
        <div class="tp-return-customer-input">
            <input type="password" v-model="user.password" placeholder="Password">
        </div>
        <div class="tp-return-customer-suggestions d-sm-flex align-items-center justify-content-between mb-20">
            <div class="tp-return-customer-forgot">
                <a href="/forgot">Forgot Password?</a>
            </div>
        </div>
        <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Login</button>
        <br>
        <div class="tp-return-customer-forgot">
            New to wabegadgetsTech? <a href="/register">Sign Up</a>
        </div>
    </form>
</template>

<<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            loginError: null
        };
    },
    methods: {
        submitForm() {
            axios.post('/client/login', this.user)
                .then(response => {
                    console.log('Login successful:', response);
                    // Perform the redirect or reload the page
                    window.location.href = '/checkout'; // Redirect to a specific path
                    // OR
                    window.location.reload(); // If you just want to reload the current page
                })
                .catch(error => {
                    console.log('Login error:', error.response);
                    this.loginError = error.response.data.message || 'An error occurred during login.';
                    // Display this error message on the form
                });
        }
    }
}
</script>

