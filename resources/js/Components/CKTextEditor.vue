<script setup>

import 'ckeditor5/ckeditor5.css';
import 'ckeditor5-premium-features/ckeditor5-premium-features.css';

import emoji from 'emoji.json';
import { ref, watch } from 'vue';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import { ClassicEditor, Essentials, Paragraph, SpecialCharacters, SpecialCharactersEssentials } from 'ckeditor5';

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

let description = ref(`<p>${props.modelValue}</p>`);

let emojis = emoji.map((e) => {
    return {title: e.name, character: e.char};
});

function SpecialCharactersEmoji( editor ) {
    editor.plugins.get('SpecialCharacters').addItems( 'Emoji', emojis, { label: 'Emoticons' } );
}

const editor = ref(ClassicEditor);

const editorConfig = ref({
    plugins: [ Essentials, Paragraph, SpecialCharacters, SpecialCharactersEssentials, SpecialCharactersEmoji],
    toolbar: [ 'undo', 'redo', 'specialCharacters']
});

watch(description, (newVal) => {
    emit('update:modelValue', newVal);
});

</script>

<template>

    <ckeditor
        v-model="description"
        :editor="editor"
        :config="editorConfig"
        tag-name="textarea"
    />

</template>

<style>

p[data-placeholder]{
    min-height: 150px !important;
}

.ck-rounded-corners {
    border-bottom-left-radius: 6px !important;
    border-bottom-right-radius: 6px !important;
}

</style>
