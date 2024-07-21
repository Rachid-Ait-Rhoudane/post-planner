<script setup>

import { ref } from 'vue';
import PublishQueue from './PublishQueue.vue';
import PublishSent from './PublishSent.vue';

let Pages = {
    'queue': PublishQueue,
    'sent': PublishSent
};

let currentPage = ref('queue');

const changePage = (page) => {
    currentPage.value = page;
}

</script>

<template>

    <div class="max-w-7xl mx-auto h-1/2 bg-white rounded-md shadow-ld">

        <div class="relative px-6 pt-6  flex justify-between items-center gap-10">
            <div class="relative z-10 flex items-center">
                <button
                    @click="changePage('queue')"
                    class="px-3 py-4"
                    :class="{'border-b-2 border-b-blue-500 font-bold': currentPage === 'queue'}"
                    type="button"
                    >
                    Queue
                </button>
                <button
                    @click="changePage('sent')"
                    class="px-3 py-4"
                    :class="{'border-b-2 border-b-blue-500 font-bold': currentPage === 'sent'}"
                    type="button"
                    >
                    Sent
                </button>
            </div>
            <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600" type="button">New Post</button>
            <hr class="absolute bottom-0 left-6 w-[calc(100%-48px)] h-px bg-gray-300">
        </div>

        <div class="mb-16">
            <component :is="Pages[currentPage]" />
        </div>

    </div>

</template>
