<script setup>

import { ref } from 'vue';

defineProps({
    defaultFileURL: {
        type: String,
        default: '#'
    },
    defaultFileType: {
        type: String,
        default: 'none'
    }
});

const emit = defineEmits(['update:modelValue']);

let fileName = ref('choose a file');

let image = ref(null);

let video = ref(null);

let file = ref(null);

let fileInput = ref(null);

const uploadFile = (e) => {
    file.value = e.target.files[0];
    if(file.value) {
        let reader = new FileReader();
        reader.readAsDataURL(file.value);
        reader.onload = function() {
            if(file.value.type.split('/')[0] === 'image') {
                image.value.src = reader.result;
            } else if(file.value.type.split('/')[0] === 'video') {
                console.log(video.value);
                video.value.src = reader.result;
            }
        };
        fileName.value = file.value.name;
    }
    fileName.value = 'choose a file';
    emit('update:modelValue', file.value);
}

const cancelUpload = () => {
    file.value = null;
    fileInput.value.value = null;
    fileName.value = 'choose a file';
    emit('update:modelValue', file.value);
}

</script>

<template>

    <div class="relative mt-6 bg-indigo-100 rounded-md h-28 border-2 border-dashed border-indigo-500">
        <input ref="fileInput" type="file" @input="uploadFile" class="relative z-10 h-full w-full text-transparent focus:outline-none file:bg-transparent file:border-transparent file:text-transparent" />
        <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
            <span class="flex justify-center items-center gap-2 text-xl text-indigo-500">
                <i class="fa-solid fa-image"></i>
                <span class="text-sm">or</span>
                <i class="fa-solid fa-video"></i>
            </span>
            <span class="block mt-2 text-sm">{{ fileName }}</span>
        </div>
        <button v-if="file" @click="cancelUpload" type="button" class="absolute top-2 right-2 z-20">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div v-if="file" class="absolute top-1/2 -translate-y-1/2 left-2">
            <img ref="image" class="relative w-20 aspect-square rounded-md" src="#" alt="test image">
            <video class="w-20 aspect-video rounded-md"  controls>
                <source ref="video" src="https://www.youtube.com/watch?v=CH50zuS8DD0&t=1s" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

</template>
