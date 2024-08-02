<script setup>

import { ref } from 'vue';

const emit = defineEmits(['update:modelValue']);

let fileName = ref('choose a file')

const uploadFile = (e) => {
    let file = e.target.files[0];
    fileName.value = file ? file.name : 'choose a file';
    emit('update:modelValue', file);
}

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
    </div>

</template>
