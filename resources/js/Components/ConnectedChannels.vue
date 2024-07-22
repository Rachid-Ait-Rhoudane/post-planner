<script setup>

import ChannelCard from './ChannelCard.vue';

</script>

<template>

    <div class="p-4">

        <div class="relative pb-6 flex justify-between items-center gap-10">
            <h3 class="text-gray-500">All connected channels</h3>
            <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600" type="button">Connect</button>
            <hr class="absolute bottom-3 left-0 w-full h-px bg-gray-300">
        </div>

        <div>
            <ChannelCard></ChannelCard>
            <ChannelCard></ChannelCard>
            <ChannelCard></ChannelCard>
        </div>

    </div>

</template>
