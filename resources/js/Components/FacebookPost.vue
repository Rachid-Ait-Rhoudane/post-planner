<script setup>

import { ref, computed } from 'vue';
import moment from 'moment-timezone';
import Dropdown from './Dropdown.vue';
import { router } from '@inertiajs/vue3';
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

let loadingAnalytics = ref(false);

let loadingPostDuplication = ref(false);

const showAnalytics = async (id) => {
    show.value = true ;
    loadingAnalytics.value = true;
    let results = await axios.get(`/api/analytics/${id}`);
    analytics.value = results.data;
    loadingAnalytics.value = false;
}

const duplicatePost = (postID) => {
    router.post('/duplicate/post', {
        postID
    }, {
        onStart: visit => {
            loadingPostDuplication.value = true;
        },
        onFinish: visit => {
            loadingPostDuplication.value = false;
        }
    });
}

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500 flex items-center justify-between gap-4 border-b border-b-gray-200">
            <span class="flex items-center gap-2">
                <i class="fa-brands fa-facebook text-blue-500"></i>
                <span v-if="post.is_published" class="text-xs font-bold">Created on {{ post.scheduled_time ? moment.tz(post.scheduled_time, moment.tz.guess()).format("dddd DD MMMM YYYY HH:mm:ss Z") : moment.tz(post.created_at, moment.tz.guess()).format("YYYY-MM-DD HH:mm:ss Z") }}</span>
                <span v-else class="text-xs font-bold">Scheduled to {{ moment.tz(post.scheduled_time, moment.tz.guess()).format("dddd DD MMMM YYYY HH:mm:ss Z") }}</span>
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
                    <DropdownLink :disabled="loadingPostDuplication" @click="duplicatePost(post.id)" as="button">
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
        <div class="p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postMessage ?? ''"></p>
            <img v-if="post.file_type === 'image'" class="w-60 aspect-square mx-auto sm:mx-0" :src="'/storage/' + post.file_path" alt="post image">
            <video v-else-if="post.file_type === 'video'" class="w-72 aspect-video self-center"  controls>
                <source :src="'/storage/' + post.file_path" type="video/mp4">
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
                <PrimaryButton :disabled="loadingAnalytics" @click="showAnalytics(post.id)">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </PrimaryButton>
            </h1>
        </template>
        <template #content>
            <div v-if="! loadingAnalytics" class="flex items-center justify-around gap-4 mt-8">
                <div class="flex flex-col items-center gap-3">
                    <img class="w-28 aspect-video" src="/images/facebook_reactions.png" alt="facebook reactions">
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
