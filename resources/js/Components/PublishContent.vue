<script setup>

import { ref, watch } from 'vue';
import TextInput from './TextInput.vue';
import FileInput from './FileInput.vue';
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import DialogModal from './DialogModal.vue';
import FacebookPost from './FacebookPost.vue';
import PrimaryButton from './PrimaryButton.vue';
import TextAreaInput from './TextAreaInput.vue';
import SearchChannelCard from './SearchChannelCard.vue';

let props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    paging: {
        type: Object,
        required: true
    },
    pages: {
        type: Object,
        required: true
    },
    currentPageID: {
        required: true
    }
});

let open = ref(false);

let arrow = ref(null);

let search = ref('');

let show = ref(false);

const filterDropdown = () => {
    open.value = !open.value;
    if(arrow.value.classList.contains('rotate-180')) {
        arrow.value.classList.remove('rotate-180');
    } else {
        arrow.value.classList.add('rotate-180');
    }
};

const changePage = (pageID) => {
    router.get('/publish', {
        pageID
    }, {
        preserveState: true
    })
}

const previousPage = (cursor) => {
    router.get('/publish', {
        before: cursor
    }, {
        preserveScroll: true
    })
};

const nextPage = (cursor) => {
    router.get('/publish', {
        after: cursor
    }, {
        preserveScroll: true
    })
};

watch(search, (newValue) => {
    router.get('/publish', {
        pageID: props.currentPageID,
        search: newValue
    }, {
        preserveState: true,
        only: ['pages']
    })
});

const form = useForm({
  description: null,
  file: null,
});

const send = () => {
    console.log(form.description);
    console.log(form.file.name);
}
</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-4">
            <h3 class="text-gray-500 text-sm sm:text-base" >All Published Posts</h3>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <button @click="filterDropdown" type="button" class="text-gray-500 px-3 py-2 border border-gray-500 rounded-md flex items-center gap-3 text-sm sm:text-base">
                        <span>Channels</span>
                        <i ref="arrow" class="fa-solid fa-angle-down duration-300"></i>
                    </button>
                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <div v-show="open" class="absolute z-50 rounded-md bg-white border border-gray-100 shadow-md py-2 w-72 top-12 -right-10">
                            <div class="mx-1">
                                <TextInput v-model="search" class="h-7 w-full" placeholder="Search for channel"/>
                            </div>
                            <div class="w-full mt-2 max-h-36 overflow-auto">
                                <SearchChannelCard @click="changePage(page.id)" v-for="page in pages" :key="page.id" :page="page" :active="page.id == currentPageID" />
                            </div>
                        </div>
                    </transition>
                </div>
                <button @click="show = true" class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-2 hover:bg-blue-600 text-sm sm:text-base" type="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Post</span>
                </button>
                <DialogModal :show="show">
                    <template #title>
                        Create new post
                    </template>
                    <template #content>
                        <form @submit.prevent="send">
                            <TextAreaInput v-model="form.description" placeholder="Write a description" rows="10"></TextAreaInput>
                            <FileInput v-model="form.file"  />
                        </form>
                    </template>
                    <template #footer>
                        <PrimaryButton @click="show = false">Cancel</PrimaryButton>
                        <PrimaryButton>Create</PrimaryButton>
                    </template>
                </DialogModal>
            </div>
        </div>

        <div class="mt-6 space-y-8">
            <FacebookPost v-for="post in posts" :key="post.id" :post="post"></FacebookPost>
            <div class="mt-8 flex items-center justify-between gap-10">
                <PrimaryButton @click="previousPage(paging.cursors.before)" :disabled="! paging.previous">Previous</PrimaryButton>
                <PrimaryButton @click="nextPage(paging.cursors.after)" :disabled="! paging.next">Next</PrimaryButton>
            </div>
        </div>

        <p v-if="false" class="mt-6 flex flex-col items-center gap-2">
            <span class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center">
                <i class="fa-solid fa-ban text-xl text-white"></i>
            </span>
            <span class="font-bold">No posts found</span>
            <span class="text-sm text-gray-500 italic">There are no posts with chosen channels, try changing channels</span>
        </p>

    </div>

</template>
