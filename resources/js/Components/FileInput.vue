<script setup>

import axios from 'axios';
import { ref } from 'vue';

defineProps(['modelValue'])

const emit = defineEmits(['update:modelValue']);

let fileName = ref('');

let progress = ref('0%');

let fileType = ref('');

let loadedSize = ref(0);

let totalSize = ref(0);

let file = ref(null);

let fileInput = ref(null);

const uploadFile = async (e) => {
    progress.value = 0;
    file.value = e.target.files[0];
    if(file.value) {
        fileName.value =  file.value.name;
        fileType.value = file.value.type.split('/')[0];
        const formData = new FormData();
        formData.append('file', file.value);
        await axios.post('/api/upload', formData, {
            onUploadProgress: ({loaded, total}) => {
                totalSize.value = total/(1024*1024);
                loadedSize.value = loaded/(1024*1024);
                progress.value = Math.floor((loaded/total)*100);
            }
        });
    } else {
        fileType.value = '';
        fileName.value = '';
        progress.value = 0;
    }
    emit('update:modelValue', file.value);
}

const cancelUpload = () => {
    file.value = null;
    fileInput.value.value = null;
    fileName.value = '';
    fileType.value = '';
    progress.value = 0;
    emit('update:modelValue', file.value);
}
</script>

<template>

    <div class="space-y-4">
        <div class="relative mt-6 bg-indigo-100 rounded-md h-28 border-2 border-dashed border-indigo-500">
            <input ref="fileInput" type="file" @input="uploadFile" class="relative z-10 h-full w-full text-transparent focus:outline-none file:bg-transparent file:border-transparent file:text-transparent" />
            <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
                <span class="flex justify-center items-center gap-2 text-xl text-indigo-500">
                    <i class="fa-solid fa-image"></i>
                    <span class="text-sm">or</span>
                    <i class="fa-solid fa-video"></i>
                </span>
                <span class="block mt-2 text-sm text-center">Upload an Image or a Video</span>
            </div>
        </div>
        <div v-if="file" class="relative flex items-center gap-3 border border-gray-300 bg-gray-200 rounded-md px-4 py-3 text-gray-800">
            <div>
                <i v-if="fileType == 'image'" class="fa-solid fa-image text-gray-500 text-5xl sm:text-6xl"></i>
                <i v-else-if="fileType == 'video'" class="fa-solid fa-video text-gray-500 text-5xl sm:text-6xl"></i>
                <i v-else class="fa-solid fa-file text-gray-500 text-5xl sm:text-6xl"></i>
            </div>
            <div class="flex flex-col gap-2 flex-1">
                <span class="block mt-2">{{ fileName }}</span>
                <progress class="h-3 w-full text-white rounded-md overflow-hidden" :value="progress" max="100"></progress>
                <span class="tetx-gray-500 text-xs self-end space-x-2">
                    <span>{{ loadedSize.toFixed(3) }} MB / {{ totalSize.toFixed(3) }} MB</span>
                    <span>{{ progress }}% / 100%</span>
                </span>
            </div>
            <button @click="cancelUpload" type="button" class="absolute top-1 right-3 z-20 text-gray-800 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    </div>

</template>

<style scoped>

progress::-webkit-progress-value {
  background-color: #6875f5;
}

progress::-moz-progress-bar {
  background-color: #6875f5;
}
</style>
