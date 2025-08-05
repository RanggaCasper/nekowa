<template>
    <div class="flex flex-col min-h-screen bg-light lg:flex-row-reverse">
        <div class="absolute z-10 right-4 top-4">
            <Link href="/" class="inline-flex items-center justify-center text-sm font-medium transition-all rounded-lg shadow-md hover:ring-2 hover:ring-blue-500 hover:border-none hover:text-blue-600 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-9 w-9 text-gray-600 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </Link>
        </div>
        
        <div class="hidden lg:flex lg:w-7/12 fixed top-0 left-0 h-screen">
            <div class="relative w-full h-screen overflow-hidden">
                <img src="https://w.wallhaven.cc/full/ly/wallhaven-ly9qzq.jpg" class="w-full h-full" alt="">
            </div>
        </div>

        <div class="w-full lg:w-5/12 lg:ml-auto flex flex-col min-h-screen">
            
            <div class="flex-1 flex flex-col justify-center p-8 lg:p-16 bg-gray-50">
                <div class="w-full max-w-md mx-auto">
                    <div class="mb-8">
                        <h2 class="text-4xl font-bold text-gray-900 mb-2">{{ pageTitle }}</h2>
                        <p class="text-gray-600 font-medium">{{ pageDescription }}</p>
                    </div>

                    <slot />
                </div>
            </div>

            <div class="bg-white border-t border-gray-200 p-4">
                <p class="text-center text-sm text-gray-500">
                    © {{ new Date().getFullYear() }} {{ title }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

export default {
  name: "AuthLayout",
  components: {
    Link
  },
  props: {
    title: {
      type: String,
      default: import.meta.env.VITE_APP_NAME,
    },
    pageTitle: {
      type: String,
      default: 'Welcome'
    },
    pageDescription: {
      type: String,
      default: 'Please sign in to your account'
    }
  },    
};
</script>