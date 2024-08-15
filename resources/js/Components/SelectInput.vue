<script setup>

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" id="timezone"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <slot />
    </select>
</template>
