<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import Timezones from './Partials/Timezones.vue';

let props = defineProps({
    timezones: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <AppLayout title="Settings">
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <Timezones :timezones="timezones" />

                    <SectionBorder />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
