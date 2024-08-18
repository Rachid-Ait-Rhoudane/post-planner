<script setup>
import { ref } from 'vue';
import Paginator from './Paginator.vue';
import { router } from '@inertiajs/vue3';
import NoPostsFound from './NoPostsFound.vue';
import FacebookPost from './FacebookPost.vue';
import SelectChannel from './SelectChannel.vue';
import SchedulePostModal from './SchedulePostModal.vue';

defineProps({
    posts: {
        type: Object,
        required: true
    },
    currentChannelID: {
        required: true
    }
});

let show = ref(false);

const changeChannel = (pageID) => {
    router.get('/queue', {
        pageID
    })
}
</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-4">
            <h3 class="text-gray-500 text-sm sm:text-base" >All Queued Posts</h3>
            <div class="flex items-center gap-4">
                <SelectChannel @changeChannel="changeChannel" :currentChannelID="currentChannelID" />
                <button @click="show = true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-2 hover:bg-blue-600 text-sm sm:text-base" type="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Post</span>
                </button>
                <SchedulePostModal :show="show" @close="show = false" :currentChannelID="currentChannelID" />
            </div>
        </div>

        <div class="mt-6 space-y-8">
            <FacebookPost v-for="post in posts['data']" :key="post.id" :post="post"></FacebookPost>
            <Paginator :links="posts['links']" />
        </div>

        <NoPostsFound v-if="! posts['data'].length" />

    </div>

</template>
