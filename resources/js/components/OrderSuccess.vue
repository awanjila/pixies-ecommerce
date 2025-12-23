<template>
   <div>
     <h1>Order Details</h1>
     <div v-if="orderDetails">
       <p>Order ID: {{ orderDetails.invoice_no }}</p>
       <p>Order Date: {{ orderDetails.order_date }}</p>
       <p>Order Status: {{ orderDetails.order_status }}</p>
       <p>Total Products: {{ orderDetails.total_products }}</p>
       <p>Subtotal: {{ orderDetails.sub_total }}</p>
       <p>VAT: {{ orderDetails.vat }}</p>
       <p>Total: {{ orderDetails.total }}</p>
       <p>Payment Status: {{ orderDetails.payment_status }}</p>
       <p>Pay: {{ orderDetails.pay }}</p>
       <p>Due: {{ orderDetails.due }}</p>
     </div>
     <div v-else>
       <p>Loading order details...</p>
     </div>
   </div>
 </template>
 
 <script setup>
 import { ref, onMounted } from 'vue';
 import axios from 'axios';
 import { useRoute } from 'vue-router';
 
 const orderDetails = ref(null);
 const route = useRoute();

 const props = defineProps({
  orderId: {
    type: String,
    required: true
  }
});
 
 const fetchOrderDetails = async (orderId) => {
   try {
     const response = await axios.get(`/order-details/${orderId}`);
     orderDetails.value = response.data.order; // Assuming response.data.order contains the order details
   } catch (error) {
     console.error('Error fetching order details:', error);
   }
 };
 
 onMounted(() => {
  const orderId = route.props.orderId;
  if (orderId) {
    fetchOrderDetails(orderId);
  } else {
    console.error('Order ID not found in route params');
  }
});
 </script>