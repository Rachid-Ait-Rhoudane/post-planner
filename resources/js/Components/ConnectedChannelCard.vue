<script setup>

import { ref } from 'vue';
import Dropdown from './Dropdown.vue';
import { router } from '@inertiajs/vue3';
import DropdownLink from './DropdownLink.vue';
import ConfirmationModal from './ConfirmationModal.vue';
import PrimaryButton from './PrimaryButton.vue';

defineProps({
    channel: {
        type: Object,
        required: true
    }
});

let show = ref(false);

const refreshConnection = (id) => {
    router.put(`/facebook/page/refresh/connection/${id}`);
}

const disconnectChannel = (id) => {
    router.delete(`/facebook/page/destroy/${id}`);
}

</script>

<template>

    <div class="py-2 flex items-center gap-3">
        <div class="relative w-fil">
            <img class="w-12 aspect-square border border-gray-300 rounded-full" :src="channel.page_profile_picture" alt="facebook page image" />
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
                    <DropdownLink @click="refreshConnection(channel.id)" as="button">
                        Refresh Connection
                    </DropdownLink>
                    <DropdownLink @click="show = true" as="button">
                        Disconnect Channel
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>

    <ConfirmationModal :show="show">
        <template #title>
            Disconnect Channel Confirmation
        </template>
        <template #content>
            <p class="font-bold text-lg">Are you sure you want to disconnect this channel ?</p>
            <ul class="ml-4 list-disc my-2">
                <li class="text-red-500 text-sm">Once disconnected you'll lose all its related published and queued posts !</li>
            </ul>
        </template>
        <template #footer>
            <PrimaryButton @click="show = false" >Cancel</PrimaryButton>
            <PrimaryButton @click="disconnectChannel(channel.id)">Confirm</PrimaryButton>
        </template>
    </ConfirmationModal>

</template>
