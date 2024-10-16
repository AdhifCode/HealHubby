<template>
    <button @click="toggleNightMode" class="p-2 rounded-md bg-gray-200 dark:bg-gray-800">
      <svg v-if="isNightMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-4 4-4-4"></path>
      </svg>
    </button>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isNightMode: false
      };
    },
    methods: {
      toggleNightMode() {
        this.isNightMode = !this.isNightMode;
        if (this.isNightMode) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      }
    }
  };
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  