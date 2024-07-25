<script setup>

import { ref } from 'vue';
import Paginator from './Paginator.vue';
import TextInput from './TextInput.vue';
import DialogModal from './DialogModal.vue';
import ChannelCard from './ChannelCard.vue';
import PrimaryButton from './PrimaryButton.vue';
import ConnectedChannelCard from './ConnectedChannelCard.vue';

let show = ref(false);


</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-10">
            <h3 class="text-gray-500">All connected channels</h3>
            <button type="button" @click="show=true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600 text-sm sm:text-base">New channel</button>
        </div>

        <div class="w-full my-6">
            <TextInput class="w-full" placeholder="Search for a channel" />
        </div>

        <div class="divide-y divide-gray-200">
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
            <ConnectedChannelCard />
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
