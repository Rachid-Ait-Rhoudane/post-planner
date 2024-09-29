<script setup>

import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

let paymentOption = ref('monthly');

</script>

<template>

    <div class="space-y-4">

        <h1 class="text-3xl sm:text-4xl font-black text-center">Upgrade Your Plan</h1>

        <div class="w-fit mx-auto space-y-2">
            <h3 class="p-2 text-pop font-bold">Save 2 months with yearly billing</h3>
            <div class="w-fit mx-auto" >
                <button
                    @click="paymentOption = 'monthly'"
                    class="px-3 py-2 border-r-transparent rounded-l-md"
                    :class="{'border border-pop bg-pop text-white': paymentOption === 'monthly', 'border border-gray-300 text-gray-500': paymentOption === 'yearly'}"
                    type="button">
                        Monthly
                </button>
                <button
                    @click="paymentOption = 'yearly'"
                    class="px-3 py-2 rounded-r-md"
                    :class="{'border border-pop bg-pop text-white': paymentOption === 'yearly', 'border border-gray-300 text-gray-500': paymentOption === 'monthly'}"
                    type="button">
                        Yearly
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-7xl mx-auto px-3">

            <div class="flex flex-col gap-6 relative border border-gray-200 rounded-md shadow-md p-8 hover:border-pop">
                <h1 class="text-center text-4xl font-black">Free Plan</h1>
                <span v-if="paymentOption === 'monthly'" class="block w-fit mx-auto text-3xl font-black">$0 <span class="text-sm text-gray-500">/ month</span></span>
                <span v-if="paymentOption === 'yearly'" class="block w-fit mx-auto text-3xl font-black">$0 <span class="text-sm text-gray-500">/ year</span></span>
                <ul class="space-y-4 mt-6">
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Connect up to 3 channels</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Enjoy unlimited post publishing to all your channels</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Schedule posts to your connected channels with no limits</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Get full access to basic analytics for all your published posts</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-xmark text-red-500"></i>
                        <span>Customer support</span>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col gap-6 relative border border-gray-200 rounded-md shadow-md p-8 hover:border-pop">
                <h1 class="text-center text-4xl font-black">Professional</h1>
                <span v-if="paymentOption === 'monthly'" class="block w-fit mx-auto text-3xl font-black">$2.99 <span class="text-sm text-gray-500">/ month</span></span>
                <span v-if="paymentOption === 'yearly'" class="block w-fit mx-auto text-3xl font-black">$29.99 <span class="text-sm text-gray-500">/ year</span></span>
                <ul class="space-y-4 mt-6">
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Connect your channels with no limits</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Enjoy unlimited post publishing to all your connected channels</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Schedule posts to your connected channels with no limits</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Get full access to basic analytics for all your published posts</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-green-500"></i>
                        <span>Customer support</span>
                    </li>
                </ul>
                <Link type="button" class="relative mt-6 block w-fit mx-auto p-5 border border-pop text-pop font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-pop after:duration-150 after:rounded-md hover:after:h-full" href="#">
                    <span class="relative z-10">Upgrade Your Plan</span>
                </Link>
            </div>

        </div>

    </div>

</template>
