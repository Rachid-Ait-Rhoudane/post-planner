<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
    target: String
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="flex items-center gap-1 w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            <slot />
        </button>

        <a v-else-if="as =='a'" :target="target" :href="href" class="flex items-center gap-1 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            <slot />
        </a>

        <Link v-else :href="href" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            <slot />
        </Link>
    </div>
</template>
