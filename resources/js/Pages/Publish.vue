<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PublishContent from '@/Components/PublishContent.vue';
</script>

<template>
    <AppLayout title="Publish">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Publish
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <PublishContent />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
