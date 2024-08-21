<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import QueueContent from '../Components/QueueContent.vue';

let props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    channelsExists: {
        type: Boolean
    },
    currentChannelID: {
        required: true
    }
});

let refreshedPosts = ref(null);

Echo.private(`refresh-posts-${props.currentChannelID}`).listen('RefreshQueuedPosts', (e) => {
    if(e.pageID == props.currentChannelID) {
        refreshedPosts.value = e.queuedPosts
    };
});

</script>

<template>
    <AppLayout title="Queue">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <QueueContent :posts="refreshedPosts ?? posts" :channelsExists="channelsExists" :currentChannelID="currentChannelID" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
