<script setup>

import { ref } from 'vue';
import TextInput from './TextInput.vue';
import SearchChannelCard from './SearchChannelCard.vue';


let open = ref(false);

let arrow = ref(null);

const filterDropdown = () => {
    open.value = !open.value;
    if(arrow.value.classList.contains('rotate-180')) {
        arrow.value.classList.remove('rotate-180');
    } else {
        arrow.value.classList.add('rotate-180');
    }
}

</script>

<template>

    <div class="p-4">

        <div class="relative flex justify-between items-center gap-4">
            <h3 class="text-gray-500" >All About Publish</h3>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <button @click="filterDropdown" type="button" class="text-gray-500 px-3 py-2 border border-gray-500 rounded-md flex items-center gap-3">
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
                        <div v-show="open" class="absolute z-50 rounded-md bg-white border border-gray-100 shadow-md py-2 px-1 w-72 top-10 right-0">
                            <div class="w-full">
                                <TextInput class="h-7 w-full" placeholder="Search for channel"/>
                            </div>
                            <div class="w-full mt-2 h-36 overflow-auto">
                                <SearchChannelCard />
                                <SearchChannelCard />
                                <SearchChannelCard />
                                <SearchChannelCard />
                                <SearchChannelCard />
                                <SearchChannelCard />
                            </div>
                        </div>
                    </transition>
                </div>
                <button class="px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-2 hover:bg-blue-600" type="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Post</span>
                </button>
            </div>
        </div>

        <div class="mt-6">
            <div class="rounded-md shadow-md border border-gray-200">
                <div class="p-2 text-gray-500">
                    <span class="flex items-center gap-2">
                        <i class="fa-brands fa-facebook"></i>
                        <span class="text-xs">Shared via Facebook on July 13th at 4:55 PM (GMT+1)</span>
                    </span>
                </div>
                <div class="bg-gray-100 p-2 flex flex-col-reverse sm:flex-row gap-5">
                    <p class="text-sm">🌍 Greetings, Global Coffee Lovers! 🌍<br><br>Welcome to our international community of coffee enthusiasts! No matter where you’re from, we all share the same passion for that perfect cup. Here, we celebrate the diversity of coffee cultures from around the world.<br><br>Share your favorite coffee traditions, unique brewing methods, and regional specialties. Let’s learn from each other and discover new ways to enjoy our beloved beverage.<br><br>How do you enjoy your coffee in your part of the world? Share with us below! ☕️🌎<br><br>#CoffeeLovers #GlobalCoffeeCulture #CoffeeAroundTheWorld</p>
                    <!-- <img class="w-52 aspect-square" src="https://espresso-works.com/cdn/shop/articles/espresso-works-blog-a-valentines-gift-guide-for-coffee-lovers-1_1080x.jpg?v=1612171091" alt="test post"> -->
                    <video class="w-56 aspect-video self-center"  controls>
                        <source src="https://scontent.frba3-2.fna.fbcdn.net/o1/v/t2/f2/m69/An_YBmim_nMBRGslqshEe12hcHaMrlotGkCcO4-QQEXK_UYbWgAzJOJbKSjHa1fOZWGNqb2DeS5LiIbIXaJwHj0n.mp4?efg=eyJ2ZW5jb2RlX3RhZyI6Im9lcF9oZCJ9&_nc_ht=scontent.frba3-2.fna.fbcdn.net&_nc_cat=100&strext=1&vs=4177ef7e52405be2&_nc_vs=HBkcFQIYOnBhc3N0aHJvdWdoX2V2ZXJzdG9yZS9HRWVWQmh0aFZTLWhPcjBCQU4wbUdMTVRTWmhYYm1kakFBQUYVAALIAQBLB4gScHJvZ3Jlc3NpdmVfcmVjaXBlATENc3Vic2FtcGxlX2ZwcwAQdm1hZl9lbmFibGVfbnN1YgAgbWVhc3VyZV9vcmlnaW5hbF9yZXNvbHV0aW9uX3NzaW0AKGNvbXB1dGVfc3NpbV9vbmx5X2F0X29yaWdpbmFsX3Jlc29sdXRpb24AHXVzZV9sYW5jem9zX2Zvcl92cW1fdXBzY2FsaW5nABFkaXNhYmxlX3Bvc3RfcHZxcwAVACUAHIwXQAAAAAAAAAAREQAAACbsyJOvvISvBBUCKAJDMxgLdnRzX3ByZXZpZXccF0BBQo9cKPXDGBlkYXNoX2gyNjQtYmFzaWMtZ2VuMl83MjBwEgAYGHZpZGVvcy52dHMuY2FsbGJhY2sucHJvZDgSVklERU9fVklFV19SRVFVRVNUGwqIFW9lbV90YXJnZXRfZW5jb2RlX3RhZwZvZXBfaGQTb2VtX3JlcXVlc3RfdGltZV9tcwEwDG9lbV9jZmdfcnVsZQd1bm11dGVkE29lbV9yb2lfcmVhY2hfY291bnQBMRFvZW1faXNfZXhwZXJpbWVudAAMb2VtX3ZpZGVvX2lkEDEwODkyMTg5Mzk1OTMzNTESb2VtX3ZpZGVvX2Fzc2V0X2lkEDE1MTkzNzUyMjIwNDEzMDIVb2VtX3ZpZGVvX3Jlc291cmNlX2lkEDEyMjkzMzA4MjE4MzczNjYcb2VtX3NvdXJjZV92aWRlb19lbmNvZGluZ19pZA8zNjQxODk1MTk4NDg1NzQOdnRzX3JlcXVlc3RfaWQAJQIcACXEARsHiAFzBDM2NDQCY2QKMjAyNC0wNy0yOQNyY2IBMANhcHAGVmlkw6lvAmN0GUNPTlRBSU5FRF9QT1NUX0FUVEFDSE1FTlQTb3JpZ2luYWxfZHVyYXRpb25fcwUzNC41MgJ0cxVwcm9ncmVzc2l2ZV9lbmNvZGluZ3MA&ccb=9-4&oh=00_AYDLLl0VOCmrp08sEX8S3Grfp0VlSZziWP7xQa1qixPwqQ&oe=66A9C536&_nc_sid=1d576d&_nc_rid=408706033157077&_nc_store_type=1" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="bg-gray-200 p-2 flex items-center justify-between gap-10">
                    <div class="flex items-center gap-5 text-gray-500">
                        <span class="flex flex-col gap-0.5">
                            <i class="fa-solid fa-thumbs-up text-3xl"></i>
                            <span class="text-sm">0</span>
                        </span>
                        <span class="flex flex-col gap-1">
                            <i class="fa-solid fa-comment text-3xl"></i>
                            <span class="text-sm">0</span>
                        </span>
                        <span class="flex flex-col gap-1">
                            <i class="fa-solid fa-share text-3xl"></i>
                            <span class="text-sm">0</span>
                        </span>
                    </div>
                    <button class="text-gray-500 flex items-center gap-2 hover:text-gray-600" type="button">
                        <span class="text-sm font-bold">View Post</span>
                        <i class="fa-solid fa-eye text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

</template>
