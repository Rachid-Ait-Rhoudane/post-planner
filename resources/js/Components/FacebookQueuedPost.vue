<script setup>

import { ref, computed } from 'vue';
import moment from 'moment-timezone';
import Dropdown from './Dropdown.vue';
import { router } from '@inertiajs/vue3';
import DropdownLink from './DropdownLink.vue';
import SpinnerLoader from './SpinnerLoader.vue';
import PrimaryButton from './PrimaryButton.vue';
import ConfirmationModal from './ConfirmationModal.vue';
import UpdateFacebookPostModal from './UpdateFacebookPostModal.vue';

let props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

let showUpdateModal = ref(false);

let showDeleteConfirmation = ref(false);

const postDescription = computed(() => {
    return props.post.description?.split('\n').join('<br/>');
});

const deletePost = (id) => {
    router.delete(route('queue-delete-post', id));
}

</script>

<template>

    <div class="rounded-md shadow-md border border-gray-200">
        <div class="p-2 text-gray-500 flex items-center justify-between gap-4 border-b border-b-gray-200">
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
                    <DropdownLink @click="showUpdateModal = true" as="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit</span>
                    </DropdownLink>
                    <DropdownLink @click="showDeleteConfirmation = true" as="button">
                        <i class="fa-solid fa-trash"></i>
                        <span>Delete</span>
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
        <div class="p-2 flex flex-col-reverse sm:flex-row gap-5">
            <p class="text-sm flex-1" v-html="postDescription ?? ''"></p>
            <img v-if="post.file_type === 'image'" class="w-60 aspect-square mx-auto sm:mx-0" :src="'/storage/' + post.file_path" alt="post image">
            <video v-else-if="post.file_type === 'video'" class="w-72 aspect-video self-center"  controls>
                <source :src="'/storage/' + post.file_path" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <UpdateFacebookPostModal :show="showUpdateModal" @close="showUpdateModal = false" :post="post" />

    <ConfirmationModal :show="showDeleteConfirmation">
        <template #title>
            Delete Post Confirmation
        </template>
        <template #content>
            <p class="font-bold text-lg">Are you sure you want to delete this post ?</p>
            <ul class="ml-4 list-disc my-2">
                <li class="text-red-500 text-sm">Once deleted you won't be able to recover it in our app !</li>
            </ul>
        </template>
        <template #footer>
            <PrimaryButton @click="showDeleteConfirmation = false" >Cancel</PrimaryButton>
            <PrimaryButton @click="deletePost(post.id)">Confirm</PrimaryButton>
        </template>
    </ConfirmationModal>

</template>
