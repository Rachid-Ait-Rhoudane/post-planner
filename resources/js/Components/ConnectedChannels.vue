<script setup>

import { ref } from 'vue';
import Paginator from './Paginator.vue';
import TextInput from './TextInput.vue';
import DialogModal from './DialogModal.vue';
import ChannelCard from './ChannelCard.vue';
import PrimaryButton from './PrimaryButton.vue';
import ConnectedChannelCard from './ConnectedChannelCard.vue';

defineProps({
    channels: {
        type: Object,
        required: true
    }
});

let show = ref(false);


</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-10">
            <h3 class="text-gray-500">All connected channels</h3>
            <button type="button" @click="show=true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600 text-sm sm:text-base">New channel</button>
        </div>

        <div class="relative w-full my-6">
            <i class="fa-solid fa-magnifying-glass text-xl text-gray-400 absolute top-1/2 -translate-y-1/2 left-2"></i>
            <TextInput class="w-full pl-8" placeholder="Search for a channel" />
        </div>

        <div class="divide-y divide-gray-200">
            <ConnectedChannelCard
                v-for="channel in channels.data"
                :key="channel.id"
                :channel="channel"
            />
        </div>

        <Paginator class="mt-6" />

    </div>

    <DialogModal :show="show">

        <template #title>
            All channels
        </template>

        <template #content>
            <div class="divide-y divide-gray-200">
                <ChannelCard />
            </div>
        </template>

        <template #footer>
            <PrimaryButton @click="show = false">Cancel</PrimaryButton>
        </template>

    </DialogModal>

</template>
