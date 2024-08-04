<script setup>

import { ref } from 'vue';

const emit = defineEmits(['update:modelValue']);

let fileName = ref('choose a file');

let file = ref(null);

const uploadFile = (e) => {
    file.value = e.target.files[0];
    fileName.value = file.value ? file.value.name : 'choose a file';
    emit('update:modelValue', file.value);
}

// const cancelUpload = () => {
//     file.value = null;
//     fileName.value = 'choose a file';
//     emit('update:modelValue', file.value);
// }

</script>

<template>

    <div class="relative mt-6 bg-indigo-100 rounded-md h-28 border-2 border-dashed border-indigo-500">
        <input type="file" @input="uploadFile" class="relative z-10 h-full w-full text-transparent focus:outline-none file:bg-transparent file:border-transparent file:text-transparent" />
        <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
            <span class="flex justify-center items-center gap-2 text-xl text-indigo-500">
                <i class="fa-solid fa-image"></i>
                <span class="text-sm">or</span>
                <i class="fa-solid fa-video"></i>
            </span>
            <span class="block mt-2 text-sm">{{ fileName }}</span>
        </div>
        <!-- <button v-if="file" @click="cancelUpload" type="button" class="absolute top-2 right-2 z-20">
            <i class="fa-solid fa-xmark"></i>
        </button> -->
    </div>

</template>
