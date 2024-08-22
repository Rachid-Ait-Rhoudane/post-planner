<script setup>

defineProps({
    src: {
        type: String,
        required: true
    }
});

</script>

<template>

    <div class="relative">
        <img class="w-8 aspect-square rounded-full border border-gray-300" :src="src" alt="facebook page profile picture" />
        <span class="w-3 h-3 absolute right-0 bottom-0 bg-blue-500 rounded-full flex items-center justify-center">
            <i class="fa-brands fa-facebook-f text-[8px] text-white"></i>
        </span>
    </div>

</template>
