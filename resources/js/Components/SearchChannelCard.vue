<script setup>

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
        <div class="relative w-fil">
            <img class="w-8 aspect-square rounded-full" :src="channel.page_profile_picture" alt="facebook page image" />
            <span class="w-4 h-4 absolute right-0 bottom-0 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fa-brands fa-facebook-f text-xs text-white"></i>
            </span>
        </div>
        <div>
            <h3 class="text-sm font-bold">{{ channel.page_name }}</h3>
            <span class="block text-xs" :class="{'text-gray-500': !active}">Facebook Page</span>
        </div>
    </div>

</template>
