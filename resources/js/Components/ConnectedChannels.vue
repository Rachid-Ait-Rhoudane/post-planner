<script setup>

import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import Paginator from './Paginator.vue';
import TextInput from './TextInput.vue';
import { router } from '@inertiajs/vue3';
import DialogModal from './DialogModal.vue';
import ChannelCard from './ChannelCard.vue';
import PrimaryButton from './PrimaryButton.vue';
import NoChannelsFound from './NoChannelsFound.vue';
import ConnectedChannelCard from './ConnectedChannelCard.vue';

let props = defineProps({
    channels: {
        type: Object,
        required: true
    },
    filters: {
        type: Object,
        required: true
    }
});

let show = ref(false);

let search = ref(props.filters.search);

watch(search, (newValue) => {

    router.get('/channels', {
        search: newValue
    }, {
        preserveState: true
    });
});

</script>

<template>

    <div class="p-4 space-y-4">

        <div class="relative flex justify-between items-center gap-10">
            <h3 class="text-gray-500">All connected channels</h3>
            <button type="button" @click="show=true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer capitalize hover:bg-blue-600 text-sm sm:text-base">connect channel</button>
        </div>

        <div v-if="$page.props.auth.user.plan == 'free'">
            <p class="text-xs sm:text-sm text-red-500">You’re on the Free Plan. Connect up to 3 channels for free. To add additional channels, you will need to upgrade to the Professional plan. <Link :href="route('plans')" class="text-pop font-bold hover:underline">upgrade your plan</Link></p>
        </div>

        <div v-if="channels.data.length > 0" class="relative w-full my-6">
            <i class="fa-solid fa-magnifying-glass text-xl text-gray-400 absolute top-1/2 -translate-y-1/2 left-2"></i>
            <TextInput v-model="search" class="w-full pl-8" placeholder="Search for a channel" />
        </div>

        <div class="divide-y divide-gray-200">
            <ConnectedChannelCard
                v-if="channels.data.length > 0"
                v-for="channel in channels.data"
                :key="channel.id"
                :channel="channel"
            />
            <NoChannelsFound v-else />
        </div>

        <Paginator v-if="channels.links >= 2" class="mt-6" :links="channels.links" />

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
