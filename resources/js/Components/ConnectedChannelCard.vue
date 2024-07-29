<script setup>

import Dropdown from './Dropdown.vue';
import { router } from '@inertiajs/vue3';
import DropdownLink from './DropdownLink.vue';

defineProps({
    channel: {
        type: Object,
        required: true
    }
});

const refreshConnection = (id) => {
    router.post('/facebook/page/refresh/connection', {
        page_id: id,
        _method: 'PUT'
    });
}

const disconnectChannel = (id) => {
    router.post('/facebook/page/destroy', {
        id,
        _method: 'DELETE'
    });
}

</script>

<template>

    <div class="py-2 flex items-center gap-3">
        <div class="relative w-fil">
            <img class="w-12 aspect-square rounded-full" :src="channel.page_profile_picture" alt="facebook page image" />
            <span class="w-5 h-5 absolute right-0 bottom-0 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fa-brands fa-facebook-f text-xs text-white"></i>
            </span>
        </div>
        <div class="flex-1 flex justify-between items-center">
            <div>
                <h3 class="font-bold">{{ channel.page_name }}</h3>
                <span class="block text-sm text-gray-500">{{ channel.page_category }}</span>
                <span class="block text-xs text-gray-500">Facebook page</span>
            </div>

            <Dropdown>
                <template #trigger>
                    <button type="button">
                        <i class="fa-solid fa-gear text-gray-500"></i>
                    </button>
                </template>
                <template #content>
                    <DropdownLink @click="refreshConnection(channel.page_id)" as="button" :href="route('facebook-page-refresh-connection')">
                        Refresh Connection
                    </DropdownLink>
                    <DropdownLink @click="disconnectChannel(channel.id)" as="button" :href="route('facebook-page-destroy')">
                        Disconnect Channel
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>

</template>

<!-- EAAeKu39phGIBO5qNhP45wHZCYFyBd4V27Xq7ywjoZCijul7cyLfVUSZANP8ZBw8VMsLTtzyTpEfcpVem4yJXiExjZAuMvzaXWoqeiW3ejuT3fun75wECvuX1iR6FPVD2EKj1Ep6CkWhQjF6zeEZCkZChoDQGDZANAhcu9aqgTi0daHvU6GSaowhoXYrODzZCZCLMxZA -->
