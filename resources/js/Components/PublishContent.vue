<script setup>

import { ref } from 'vue';
import TextInput from './TextInput.vue';
import PublishSent from './PublishSent.vue';
import PublishQueue from './PublishQueue.vue';
import SearchChannelCard from './SearchChannelCard.vue';

let Pages = {
    'queue': PublishQueue,
    'sent': PublishSent
};

let currentPage = ref('queue');

let open = ref(false);

let arrow = ref(null);

const changePage = (page) => {
    currentPage.value = page;
}

const filterDropdown = () => {
    open.value = !open.value;
    if(arrow.value.classList.contains('rotate-180')) {
        arrow.value.classList.remove('rotate-180');
    } else {
        arrow.value.classList.add('rotate-180');
    }
}

</script>

<template>

    <div class="p-4">

        <div class="flex items-center justify-between">
            <h3 class="text-gray-500" >All About Publish</h3>
            <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600" type="button">New Post</button>
        </div>

        <div class="relative mt-6 flex justify-between items-center gap-10">
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

            <div class="relative">
                <button @click="filterDropdown" type="button" class="text-gray-500 w-28 p-1 border border-gray-500 rounded-md flex items-center justify-between">
                    Channels
                    <i ref="arrow" class="fa-solid fa-angle-down duration-300"></i>
                </button>
                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
                >
                    <div v-show="open" class="absolute z-50 rounded-md bg-white border border-gray-100 shadow-md py-2 px-1 w-72 top-10 right-0">
                        <div class="w-full">
                            <TextInput class="h-7 w-full" placeholder="Search for channel"/>
                        </div>
                        <div class="w-full mt-2 h-36 overflow-auto">
                            <SearchChannelCard />
                            <SearchChannelCard />
                            <SearchChannelCard />
                            <SearchChannelCard />
                            <SearchChannelCard />
                            <SearchChannelCard />
                        </div>
                    </div>
                </transition>
            </div>

            <hr class="absolute bottom-0 left-6 w-[calc(100%-48px)] h-px bg-gray-300">
        </div>

        <div class="mb-16">
            <component :is="Pages[currentPage]" />
        </div>

    </div>

</template>
