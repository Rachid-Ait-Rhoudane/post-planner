<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';
</script>

<template>
    <Link :href="'/'">
       <ApplicationLogo class="w-44 h-20" />
    </Link>
</template>
