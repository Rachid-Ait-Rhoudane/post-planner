<script setup>

import { Link } from '@inertiajs/vue3';

defineProps({
    links: {
        type: Object,
        required: true
    }
});

</script>

<template>

    <div v-if="links.length > 3" class="flex items-center gap-2 text-xs">
        <template v-for="link in links" :key="link.id">
            <Link
                v-if="link.url"
                :href="link.url"
                class="py-2 px-3 border border-gray-300 rounded-md cursor-pointer"
                :class="{'bg-gray-800 text-white': link.active, 'text-gray-500 hover:bg-indigo-500 hover:text-white' : !link.active}"
                v-html="link.label"
            >
            </Link>
            <span
                v-else
                v-html="link.label"
                class="py-2 px-3 border border-gray-300 text-gray-300 rounded-md cursor-not-allowed"
            >
            </span>
        </template>
    </div>

</template>
