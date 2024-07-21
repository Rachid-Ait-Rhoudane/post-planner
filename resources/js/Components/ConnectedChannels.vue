<script setup>

import ChannelCard from './ChannelCard.vue';

</script>

<template>

    <div class="max-w-7xl mx-auto h-1/2 bg-white rounded-md shadow-ld">

        <div class="relative p-6 flex justify-between items-center gap-10">
            <h3 class="text-gray-500">All connected channels</h3>
            <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600" type="button">Connect</button>
            <hr class="absolute bottom-4 left-6 w-[calc(100%-48px)] h-px bg-gray-300">
        </div>

        <div class="space-y-2 mb-16">
            <ChannelCard></ChannelCard>
            <ChannelCard></ChannelCard>
            <ChannelCard></ChannelCard>
        </div>

    </div>

</template>
