import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";

export const useAgeCheckerStore = defineStore('agecheck', {
    state: ()=>({
        ageCheckIsPassed: useLocalStorage('agepassed', false),
    }), 
    actions: {
        async verifyAge(value){
            this.ageCheckIsPassed = value;
        },  
    }
})