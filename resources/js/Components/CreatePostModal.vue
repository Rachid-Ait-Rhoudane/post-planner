<script setup>

import { ref, watch } from 'vue';
import Modal from './Modal.vue';
import TextInput from './TextInput.vue';
import FileInput from './FileInput.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';
import TextAreaInput from './TextAreaInput.vue';
import SelectChannel from './SelectChannel.vue';

const emit = defineEmits(['close']);

let props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    currentChannelID: {
        required: true
    }
});

const close = () => {
    emit('close');
};

const form = useForm({
    channelID: props.currentChannelID,
    description: null,
    file: null,
    fileTitle: null
});

</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >

        <div class="px-6 pt-4 text-lg font-medium text-gray-900">
            Create new post
        </div>
        <form @submit.prevent="form.post('/publish/post')">
            <div class="px-6 pb-4 mt-4 text-sm text-gray-600 space-y-4">
                <SelectChannel @changeChannel="(id) => form.channelID = id" :currentChannelID="form.channelID" />
                <TextAreaInput v-model="form.description" placeholder="Write a description" rows="10"></TextAreaInput>
                <FileInput v-model="form.file" />
                <TextInput v-if="form.file" v-model="form.fileTitle" placeholder="file title" class="w-full" />
            </div>

            <div class="flex flex-row justify-end items-center gap-2 px-6 py-4 bg-gray-100 text-right rounded-b-md">
                <PrimaryButton type="button" @click="close">Cancel</PrimaryButton>
                <PrimaryButton type="submit" :disabled="form.processing" >Create</PrimaryButton>
            </div>
        </form>
    </Modal>
</template>
