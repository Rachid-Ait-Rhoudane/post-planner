<script setup>

import axios from 'axios';
import { ref, computed } from 'vue';
import Dropdown from './Dropdown.vue';
import DialogModal from './DialogModal.vue';
import DropdownLink from './DropdownLink.vue';
import SpinnerLoader from './SpinnerLoader.vue';
import PrimaryButton from './PrimaryButton.vue';

let props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const postMessage = computed(() => {
    return props.post.description?.split('\n').join('<br/>');
});

let show = ref(false);

let analytics = ref({});

let loading = ref(false);

const showAnalytics = async (id) => {
    show.value = true ;
    loading.value = true;
    let results = await axios.get(`/api/analytics/${id}`);
    analytics.value = results.data;
    loading.value = false;
}

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500 flex items-center justify-between gap-4">
            <span class="flex items-center gap-2">
                <i class="fa-brands fa-facebook text-blue-500"></i>
                <span class="text-xs">Created on {{ new Date(post.created_at) }}</span>
            </span>
            <Dropdown>
                <template #trigger>
                    <button type="button">
                        <i class="fa-solid fa-ellipsis text-xl hover:text-gray-600"></i>
                    </button>
                </template>
                <template #content>
                    <DropdownLink @click="showAnalytics(post.id)" as="button">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Analytics</span>
                    </DropdownLink>
                    <DropdownLink as="button">
                        <i class="fa-solid fa-copy"></i>
                        <span>Duplicate</span>
                    </DropdownLink>
                    <DropdownLink as="a" target="_blank" :href="post.original_link">
                        <i class="fa-solid fa-eye"></i>
                        <span>Visit</span>
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
        <div class="bg-gray-100 p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postMessage ?? ''"></p>
            <img v-if="post.file_type === 'image'" class="w-52 aspect-square" :src="post.file_url" alt="post image">
            <video v-else-if="post.file_type === 'video'" class="w-56 aspect-video self-center"  controls>
                <source :src="post.file_url" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <DialogModal :show="show">
        <template #title>
            <h1 class="flex items-center justify-between gap-2">
                <span class="space-x-2">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Post Analytics</span>
                </span>
                <PrimaryButton :disabled="loading" @click="showAnalytics(post.id)">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </PrimaryButton>
            </h1>
        </template>
        <template #content>
            <div v-if="! loading" class="flex items-center justify-around gap-4 mt-8">
                <div class="flex flex-col items-center gap-3">
                    <i class="fa-solid fa-thumbs-up text-6xl text-blue-500"></i>
                    <span class="text-gray-500">{{ analytics?.reactions ?? 0}} Reactions</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <i class="fa-solid fa-comment text-6xl text-amber-500"></i>
                    <span class="text-gray-500">{{ analytics?.comments ?? 0}} Comments</span>
                </div>
                <div class="flex flex-col items-center gap-3">
                    <i class="fa-solid fa-share text-6xl text-gray-700"></i>
                    <span class="text-gray-500">{{ analytics?.shares ?? 0}} Shares</span>
                </div>
            </div>
            <SpinnerLoader v-else />
        </template>
        <template #footer>
            <PrimaryButton @click="show = false">Close</PrimaryButton>
        </template>
    </DialogModal>

</template>
