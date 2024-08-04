<script setup>

import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import FacebookPost from './FacebookPost.vue';
import PrimaryButton from './PrimaryButton.vue';
import SelectChannel from './SelectChannel.vue';
import CreatePostModal from './CreatePostModal.vue';

let props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    paging: {
        type: Object,
        required: true
    },
    currentPageID: {
        required: true
    }
});


let show = ref(false);

const changePage = (pageID) => {
    router.get('/publish', {
        pageID
    })
}

const previousPage = (cursor) => {
    router.get('/publish', {
        before: cursor
    }, {
        preserveScroll: true
    })
};

const nextPage = (cursor) => {
    router.get('/publish', {
        after: cursor
    }, {
        preserveScroll: true
    })
};
</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-4">
            <h3 class="text-gray-500 text-sm sm:text-base" >All Published Posts</h3>
            <div class="flex items-center gap-4">
                <SelectChannel @changeChannel="changePage" :currentChannelID="currentPageID" />
                <button @click="show = true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-2 hover:bg-blue-600 text-sm sm:text-base" type="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Post</span>
                </button>
                <CreatePostModal :show="show" @close="show = false" :currentChannelID="currentPageID" />
            </div>
        </div>

        <div class="mt-6 space-y-8">
            <FacebookPost v-for="post in posts" :key="post.id" :post="post"></FacebookPost>
            <div class="mt-8 flex items-center justify-between gap-10">
                <PrimaryButton @click="previousPage(paging.cursors.before)" :disabled="! paging.previous">Previous</PrimaryButton>
                <PrimaryButton @click="nextPage(paging.cursors.after)" :disabled="! paging.next">Next</PrimaryButton>
            </div>
        </div>

        <p v-if="false" class="mt-6 flex flex-col items-center gap-2">
            <span class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center">
                <i class="fa-solid fa-ban text-xl text-white"></i>
            </span>
            <span class="font-bold">No posts found</span>
            <span class="text-sm text-gray-500 italic">There are no posts with chosen channels, try changing channels</span>
        </p>

    </div>

</template>
