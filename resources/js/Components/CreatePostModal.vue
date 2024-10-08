<script setup>

import Modal from './Modal.vue';
import TextInput from './TextInput.vue';
import FileInput from './FileInput.vue';
import FormError from './FormError.vue';
import { useForm } from '@inertiajs/vue3';
import CKTextEditor from './CKTextEditor.vue';
import PrimaryButton from './PrimaryButton.vue';
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

const form = useForm({
    channelID: props.currentChannelID,
    description: null,
    file: null,
    fileTitle: null
});

const close = () => {
    form.reset();
    emit('close');
};

const sendData = async () => {
    form.post('/publish/post', {
        onSuccess: (page) => {
            close();
        }
    });
}

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
        <form @submit.prevent="sendData">
            <div class="px-6 pb-4 mt-4 text-sm text-gray-600 space-y-4">
                <SelectChannel :showCurrentChannelName="true" @changeChannel="(id) => form.channelID = id" :currentChannelID="form.channelID" />
                <div class="space-y-1">
                    <CKTextEditor v-model="form.description" placeholder="Write a description" />
                    <FormError v-if="form.errors.description">{{ form.errors.description }}</FormError>
                </div>
                <div class="space-y-1">
                    <FileInput v-model="form.file" />
                    <FormError v-if="form.errors.file">{{ form.errors.file }}</FormError>
                </div>
                <div v-if="form.file" class="space-y-1">
                    <TextInput v-model="form.fileTitle" placeholder="file title" class="w-full" />
                    <FormError v-if="form.errors.fileTitle">{{ form.errors.fileTitle }}</FormError>
                </div>
            </div>
            <div class="flex flex-row justify-end items-center gap-2 px-6 py-4 bg-gray-100 text-right rounded-b-md">
                <PrimaryButton type="button" @click="close" :disabled="form.processing">Cancel</PrimaryButton>
                <PrimaryButton type="submit" :disabled="form.processing" >Create</PrimaryButton>
            </div>
        </form>
    </Modal>
</template>
