<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import QueueContent from '../Components/QueueContent.vue';

defineProps({
    currentChannelID: {
        required: true
    }
});
</script>

<template>
    <AppLayout title="Publish">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <QueueContent :currentChannelID="currentChannelID" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
