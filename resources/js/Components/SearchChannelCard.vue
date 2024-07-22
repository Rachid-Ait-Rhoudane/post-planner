<script setup>

import { ref } from 'vue';
import Checkbox from './Checkbox.vue';

let check = ref(false);

</script>

<template>

    <div @click="check = !check" class="p-1 flex items-center gap-2 hover:bg-gray-100">
        <Checkbox :checked="check" />
        <div class="relative w-fil">
            <img class="w-10 aspect-square rounded-full" src="https://prairievillagedentist.com/wp-content/uploads/2019/02/iu-1-1200x800.jpeg" alt="facebook page image" />
            <span class="w-4 h-4 absolute right-0 bottom-0 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fa-brands fa-facebook-f text-xs text-white"></i>
            </span>
        </div>
        <div>
            <h3 class="text-sm font-bold">Page Name</h3>
            <span class="block text-xs text-gray-500">Facebook Page</span>
        </div>
    </div>

</template>
