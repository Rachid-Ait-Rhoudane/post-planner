<script setup>

import { computed } from 'vue';

const photoTypes = ['photo', 'profile_media', 'cover_photo'];

let props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const postMessage = computed(() => {
    return props.post.message?.split('\n').join('<br/>');
});

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500">
            <span class="flex items-center gap-2">
                <i class="fa-brands fa-facebook"></i>
                <span class="text-xs">Shared via {{ post.application?.name ?? 'Facebook' }} on {{ new Date(post.created_time) }}</span>
            </span>
        </div>
        <div class="bg-gray-100 p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postMessage ?? ''"></p>
            <img v-if="photoTypes.includes(post.attachments?.data[0].type)" class="w-52 aspect-square" :src="post.attachments?.data[0].media.image.src" alt="post image">
            <video v-else-if="post.attachments?.data[0].type == 'video_inline'" class="w-56 aspect-video self-center"  controls>
                <source :src="post.attachments?.data[0].media.source" type="video/mp4">
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
                    <span class="text-xs">{{ post.likes?.data.length ?? 0 }}</span>
                </span>
                <span class="flex flex-col gap-1">
                    <span class="text-xs">
                        <i class="fa-solid fa-comment text-xl"></i>
                        Comments
                    </span>
                    <span class="text-xs">{{ post.comments?.data.length ?? 0 }}</span>
                </span>
                <span class="flex flex-col gap-1">
                    <span class="text-xs">
                        <i class="fa-solid fa-share text-xl"></i>
                        Shares
                    </span>
                    <span class="text-xs">{{ post.shares?.count ?? 0 }}</span>
                </span>
            </div>
            <a class="text-gray-500 flex items-center gap-2 hover:text-gray-600" target="_blank" :href="post.permalink_url">
                <span class="text-xs font-bold">View Post</span>
                <i class="fa-solid fa-eye text-xl"></i>
            </a>
        </div>
    </div>

</template>
