<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import QueueContent from '../Components/QueueContent.vue';

defineProps({
    posts: {
        type: Object,
        required: true
    },
    currentChannelID: {
        required: true
    }
});
</script>

<template>
    <AppLayout title="Queue">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <QueueContent :posts="posts" :currentChannelID="currentChannelID" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
