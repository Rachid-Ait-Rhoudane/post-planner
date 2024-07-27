<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ConnectedChannels from '@/Components/ConnectedChannels.vue';

defineProps({
    channels: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <AppLayout title="Channels">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <ConnectedChannels :channels="channels" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
