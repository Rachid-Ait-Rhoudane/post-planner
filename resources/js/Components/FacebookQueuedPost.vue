<script setup>

import { ref, computed } from 'vue';
import moment from 'moment-timezone';
import Dropdown from './Dropdown.vue';
import { router } from '@inertiajs/vue3';
import DropdownLink from './DropdownLink.vue';
import SpinnerLoader from './SpinnerLoader.vue';
import PrimaryButton from './PrimaryButton.vue';

let props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const postDescription = computed(() => {
    return props.post.description?.split('\n').join('<br/>');
});

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500 flex items-center justify-between gap-4">
            <span class="flex items-center gap-2">
                <i class="fa-brands fa-facebook text-blue-500"></i>
                <span class="text-xs font-bold">Scheduled to {{ moment.tz(post.scheduled_time, moment.tz.guess()).format("dddd DD MMMM YYYY HH:mm:ss Z") }}</span>
            </span>
            <Dropdown>
                <template #trigger>
                    <button type="button">
                        <i class="fa-solid fa-ellipsis text-xl hover:text-gray-600"></i>
                    </button>
                </template>
                <template #content>
                    <DropdownLink as="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit</span>
                    </DropdownLink>
                    <DropdownLink as="button">
                        <i class="fa-solid fa-trash"></i>
                        <span>Delete</span>
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
        <div class="bg-gray-100 p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postDescription ?? ''"></p>
            <img v-if="post.file_type === 'image'" class="w-52 aspect-square mx-auto sm:mx-0" :src="'/storage/' + post.file_path" alt="post image">
            <video v-else-if="post.file_type === 'video'" class="w-56 aspect-video self-center"  controls>
                <source :src="'/storage/' + post.file_path" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

</template>
