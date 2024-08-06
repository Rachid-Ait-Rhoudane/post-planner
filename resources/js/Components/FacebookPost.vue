<script setup>

import { computed } from 'vue';

let props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const postMessage = computed(() => {
    return props.post.description?.split('\n').join('<br/>');
});

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500">
            <span class="flex items-center gap-2">
                <i class="fa-brands fa-facebook text-blue-500"></i>
                <span class="text-xs">Shared via Post Planner App on {{ new Date(post.created_at) }}</span>
            </span>
        </div>
        <div class="bg-gray-100 p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postMessage ?? ''"></p>
            <img v-if="post.file_type === 'image'" class="w-52 aspect-square" :src="post.file_url" alt="post image">
            <video v-else-if="post.file_type === 'video'" class="w-56 aspect-video self-center"  controls>
                <source :src="post.file_url" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="bg-gray-200 p-2 flex items-center justify-between gap-10">
            <div class="flex items-center gap-5 text-gray-500">
                <span class="flex flex-col gap-0.5">
                    <span class="text-xs">
                        <i class="fa-solid fa-thumbs-up text-xl"></i>
                        Likes
                    </span>
                    <span class="text-xs">{{ post.likes ?? 0 }}</span>
                </span>
                <span class="flex flex-col gap-1">
                    <span class="text-xs">
                        <i class="fa-solid fa-comment text-xl"></i>
                        Comments
                    </span>
                    <span class="text-xs">{{ post.comments ?? 0 }}</span>
                </span>
                <span class="flex flex-col gap-1">
                    <span class="text-xs">
                        <i class="fa-solid fa-share text-xl"></i>
                        Shares
                    </span>
                    <span class="text-xs">{{ post.shares ?? 0 }}</span>
                </span>
            </div>
            <a class="text-gray-500 flex items-center gap-2 hover:text-gray-600" target="_blank" :href="post.original_link ?? '#'">
                <span class="text-xs font-bold">View Post</span>
                <i class="fa-solid fa-eye"></i>
            </a>
        </div>
    </div>

</template>
