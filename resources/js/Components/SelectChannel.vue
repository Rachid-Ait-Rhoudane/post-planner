<script setup>

import TextInput from './TextInput.vue';
import { ref, onMounted, watch } from 'vue';
import SpinnerLoader from './SpinnerLoader.vue';
import SearchChannelCard from './SearchChannelCard.vue';

defineProps({
    currentChannelID: {
        required: true
    }
});

defineEmits(['changeChannel']);

let channels = ref([]);

let open = ref(false);

let arrow = ref(null);

const filterDropdown = () => {
    open.value = !open.value;
    if(arrow.value.classList.contains('rotate-180')) {
        arrow.value.classList.remove('rotate-180');
    } else {
        arrow.value.classList.add('rotate-180');
    }
};

onMounted(async () => {
    let results = await axios.get('/api/channels');
    channels.value = await results.data.data;
});

let search = ref('');

watch(search, async (newValue) => {
    let results = await axios.get('/api/channels', {
        params: {
            search: newValue
        }
    });
    channels.value = await results.data.data;
});

</script>

<template>

    <div class="relative">
        <button
            @click="filterDropdown"
            type="button"
            class="text-gray-500 px-3 py-2 border rounded-md flex items-center justify-between gap-3 text-sm sm:text-base w-full"
            :class="{'border-indigo-500 text-indigo-500' : open, 'border-gray-500': !open}"
        >
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
            <div v-show="open" class="absolute z-50 rounded-md bg-white border border-gray-100 shadow-md py-2 min-w-64 w-full top-12 right-0">
                <div class="mx-1">
                    <TextInput v-model="search" class="h-7 w-full" placeholder="Search for channel"/>
                </div>
                <div class="w-full mt-2 max-h-36 overflow-auto">
                    <SearchChannelCard v-if="channels.length > 0" @click="$emit('changeChannel', channel.id)" v-for="channel in channels" :key="channel.id" :channel="channel" :active="channel.id == currentChannelID" />
                    <SpinnerLoader v-else />
                </div>
            </div>
        </transition>
    </div>

</template>
