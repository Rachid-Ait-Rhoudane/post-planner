<script setup>

import { ref } from 'vue';
import TextInput from './TextInput.vue';
import SearchChannelCard from './SearchChannelCard.vue';
import FacebookPost from './FacebookPost.vue';

let open = ref(false);

let arrow = ref(null);

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

        <div class="relative flex justify-between items-center gap-4">
            <h3 class="text-gray-500" >All About Publish</h3>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <button @click="filterDropdown" type="button" class="text-gray-500 px-3 py-2 border border-gray-500 rounded-md flex items-center gap-3">
                        <span>Channels</span>
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
                        <div v-show="open" class="absolute z-50 rounded-md bg-white border border-gray-100 shadow-md py-2 px-1 w-72 top-12 right-0">
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
                <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-2 hover:bg-blue-600" type="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Post</span>
                </button>
            </div>
        </div>

        <div class="mt-6 space-y-8">
            <FacebookPost file="image" />
            <FacebookPost file="video" />
            <FacebookPost file="image" />
        </div>

    </div>

</template>
