<script setup>

import { ref, onMounted } from 'vue';
import flatpickr from "flatpickr";
import 'flatpickr/dist/flatpickr.css';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const datePickerInput = ref(null);

onMounted(() => {

    flatpickr(datePickerInput.value, {
        altInput: true,
        altFormat: "F j, Y H:i",
        dateFormat: "Y-m-d",
        enableTime: true,
        defaultDate: new Date(new Date().getTime() + 15000*60),
        minDate: new Date(new Date().getTime() + 15000*60),
        maxDate: new Date().fp_incr(30),
        minuteIncrement: 1
    });

});

</script>

<template>
    <input
        ref="datePickerInput"
        type="datetime-local"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
