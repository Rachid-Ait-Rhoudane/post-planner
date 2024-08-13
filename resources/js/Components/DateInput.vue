<script setup>

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

</script>

<template>
    <input
        type="datetime-local"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
