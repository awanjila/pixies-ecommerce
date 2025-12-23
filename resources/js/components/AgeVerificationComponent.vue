<!-- AgeVerificationComponent.vue -->

<template>
    <div id="age-verify" :class="{ 'hidden': store.ageCheckIsPassed, 'under': underBoxVisible }">
      <div class="window">
        <span class="title">Welcome to FoxTrot UC!</span>
        <span class="subtitle">To ensure a great Vaping experience, we need to know:</span>
        <span class="age-question">Are you over 18?</span>
        <button class="yes" @click="overAge">Yes, I am</button>
        <button class="no" @click="underAge">No, I'm not</button>
        <div class="underBox">
          <span class="title">Oops!</span>
          <span class="subtitle">You must be at least 18 to access our site.</span>
          <button class="back" @click="goBack">Go Back</button>
        </div>
      </div>
    </div>
  </template>
  
<script setup>
import { ref } from 'vue';
import { onMounted } from "vue";
import { useAgeCheckerStore } from "../store/ageCheck"

const store = useAgeCheckerStore();
const underBoxVisible = ref(false)

const overAge = () =>{
  store.verifyAge(true)
}

const underAge = () =>{
  store.verifyAge(false)
}


const goBack = () =>{
  underBoxVisible.value = false;
  store.verifyAge(false)
}


</script>
  
  <style scoped>
  /* Your component-specific styles */
  
  #age-verify {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    transition: 500ms;
    z-index: 1000; /* Set a higher z-index */
  
    .window {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      height: 250px;
      overflow: hidden;
      padding: 40px;
      margin-left: -200px;
      margin-top: -125px;
      background-color: #fff;
      border: 6px solid #ED6A5A;
      box-sizing: border-box;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      transition: 500ms;
  
      span {
        display: block;
        text-align: center;
        margin-bottom: 10px;
        font-family: 'Source Sans Pro', sans-serif;
  
        &.title {
          color: #ED6A5A;
          font-size: 24px;
        }
      }
  
      button {
        border: 0;
        margin: 0;
        padding: 0;
        width: 48%;
        height: 60px;
        color: #FFF;
        font-size: 18px;
        background-color: #ED6A5A;
        margin-top: 20px;
        font-family: 'Source Sans Pro', sans-serif;
        transform: scale(1);
        transition: 0.2s;
  
        &.back {
          display: block;
          float: none;
          margin: auto;
          background-color: #fff;
          color: #ED6A5A !important;
          margin-top: 20px;
        }
  
        &.yes {
          float: left;
        }
  
        &.no {
          float: right;
        }
  
        &:hover {
          transform: scale(1.1);
          box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
          background-color: lighten(#ED6A5A, 10%);
        }
      }
  
      .underBox {
        position: absolute;
        width: 400px;
        height: 250px;
        padding: 40px;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #ED6A5A;
        transition: 500ms;
        box-sizing: border-box;
  
        * {
          color: #FFF !important;
        }
      }
    }
  
    &.hidden {
      opacity: 0;
      visibility: hidden;
  
      .window {
        transform: scale(0.5);
      }
    }
  
    &.under {
      .window .underBox {
        top: 0%;
      }
    }
  }
  </style>