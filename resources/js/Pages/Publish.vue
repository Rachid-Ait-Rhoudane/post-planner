<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PublishContent from '@/Components/PublishContent.vue';

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

Echo.private(`refresh-posts-${props.currentChannelID}`).listen('RefreshPublishedPosts', (e) => {
    if(e.pageID == props.currentChannelID) {
        refreshedPosts.value = e.publishedPosts;
    }
});

</script>

<template>
    <AppLayout title="Publish">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <PublishContent :posts="refreshedPosts ?? posts" :channelsExists="channelsExists" :currentChannelID="currentChannelID" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
