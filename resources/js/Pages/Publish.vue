<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PublishContent from '@/Components/PublishContent.vue';

defineProps({
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

</script>

<template>
    <AppLayout title="Publish">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <PublishContent :posts="posts" :paging="paging" :currentPageID="currentPageID" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
