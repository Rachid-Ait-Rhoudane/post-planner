<script setup>

import FacebookPageProfilePicture from './FacebookPageProfilePicture.vue';

defineProps({
    channel: {
        type: Object,
        required: true
    },
    active: {
        type: Boolean,
        required: true
    }
});

</script>

<template>

    <div class="p-1 flex items-center gap-2 hover:cursor-pointer" :class="{'bg-indigo-500 text-white': active, 'hover:bg-gray-100': !active}">
        <FacebookPageProfilePicture :src="channel.channel_profile_picture" />
        <div>
            <h3 class="text-sm font-bold">{{ channel.channel_name }}</h3>
            <span class="block text-xs" :class="{'text-gray-500': !active}">Facebook Page</span>
        </div>
    </div>

</template>
