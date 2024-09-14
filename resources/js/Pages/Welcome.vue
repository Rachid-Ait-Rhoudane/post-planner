<script setup>

import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

let showMobileMenu = ref(false);

</script>

<template>

    <Head title="Welcome" />

    <nav class="bg-gray-100 shadow-md">

        <div class="max-w-7xl mx-auto flex justify-between items-center px-3 py-5">
            <img class="w-20 sm:w-28" src="https://poplanner.online/images/POPlanner.png" alt="app logo">
            <div class="hidden sm:flex sm:items-center sm:gap-4 md:gap-10">
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#about_us">About Us</a>
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#">Pricing</a>
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#">Contact</a>
            </div>
            <div v-if="canLogin" class="hidden sm:block">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-blue-500 font-bold hover:text-blue-600 hover:underline">Dashboard</Link>

                <div class="flex items-center gap-6" v-else>
                    <Link :href="route('login')" class="text-blue-500 font-bold hover:text-blue-600 hover:underline">Log in</Link>

                    <Link v-if="canRegister" :href="route('register')" class="block px-6 py-3 bg-blue-500 text-white font-bold rounded-full hover:bg-blue-600">Join Us For Free</Link>
                </div>
            </div>

            <div class="relative block sm:hidden">
                <button @click="showMobileMenu = !showMobileMenu" type="button">
                    <i class="fa-solid fa-bars text-2xl font-bold text-gray-500 hover:text-gray-400"></i>
                </button>

                <div v-show="showMobileMenu" @click="showMobileMenu = false" class="fixed top-0 left-0 bg-black/20 w-full h-full z-10"></div>

                <Transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
                >
                    <div v-show="showMobileMenu" class="absolute z-20 right-0 bg-white rounded-md border border-gray-100 shadow-md min-w-52 py-2">
                        <div class="flex flex-col md:gap-10">
                            <a class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#about_us">About Us</a>
                            <a class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#">Pricing</a>
                            <a class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#">Contact</a>
                        </div>
                        <hr class="h-0.5 bg-gray-100 mx-2 my-1" />
                        <div v-if="canLogin">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="block text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white">Dashboard</Link>

                            <div class="flex flex-col" v-else>
                                <Link :href="route('login')" class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white">Log in</Link>

                                <Link v-if="canRegister" :href="route('register')" class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white">Join Us For Free</Link>
                            </div>
                        </div>
                    </div>
                </Transition>

            </div>

        </div>

    </nav>

    <main>

        <div class="max-w-7xl mx-auto px-3 py-5 flex flex-col-reverse lg:flex-row justify-between items-center gap-16 mt-16">

            <div class="flex-1 space-y-6">
                <h1 class="text-3xl sm:text-4xl font-black leading-9">Expand your reach on social media and beyond</h1>
                <p class="text-gray-500 leading-7">
                    <span class="font-black text-[#6875f5] text-xl">POPlanner</span> helps you grow your audience naturally. We're a values-driven company offering affordable, user-friendly marketing tools for ambitious individuals and teams.
                </p>
                <p class="flex flex-col sm:flex-row items-center gap-6">
                    <span class="block space-x-2 px-3 py-2 bg-[#6875f5] rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>Try for free</span>
                    </span>
                    <span class="block space-x-2 px-3 py-2 bg-[#6875f5] rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>No credit card required</span>
                    </span>
                    <span class="block space-x-2 px-3 py-2 bg-[#6875f5] rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>Cancel anytime</span>
                    </span>
                </p>
            </div>

            <img class="w-[450px] aspect-video" src="https://poplanner.online/images/social_media_channels.png" alt="social media channels">
        </div>

        <div class="mt-32">

            <h1 class="text-3xl sm:text-4xl font-black text-center">Grow your audience without consuming all your time</h1>

            <p class="text-gray-500 text-center w-full sm:w-3/4 lg:w-1/2 mx-auto mt-8">Creating content is challenging enough, not to mention distributing it across multiple marketing channels. Here are four ways <span class="text-[#6875f5] font-black">POPlanner</span> can assist you.</p>

            <div class="max-w-7xl mx-auto px-3 flex gap-16 mt-8 py-16">
                <div class="flex-1 space-y-8">
                    <span class="block text-[#6875f5] font-black">1. Connect to your social media channels</span>
                    <h1 class="font-black text-2xl">Effortlessly Connect and Manage Your Social Media Channels</h1>
                    <p><span class="text-[#6875f5] font-black leading-7">POPlanner</span> will make it easy for you to connect with all your social media channels, including Facebook pages, Instagram accounts, and more. Whether you're managing multiple profiles or just a few, <span class="text-[#6875f5] font-black">POPlanner</span> streamlines the process so you can seamlessly integrate and manage your online presence across various platforms.</p>
                    <Link class="block px-6 py-2 bg-blue-500 text-white font-bold w-fit rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        Start Connecting Your Channels
                    </Link>
                </div>
                <img class="hidden lg:block" src="https://poplanner.online/images/connect_social_media_channels.png" alt="connect social media channels">
            </div>

            <div class="bg-gray-100">
                <div class="max-w-7xl mx-auto px-3 py-16 flex gap-16">
                    <div class="flex-1 space-y-8">
                        <span class="block text-[#6875f5] font-black">2. Post to your social media channels</span>
                        <h1 class="font-black text-2xl">Seamlessly Post and Track Basic Social Media Analytics</h1>
                        <p><span class="text-[#6875f5] font-black leading-7">POPlanner</span> will simplify the process of posting content directly to your connected social media channels, allowing you to effortlessly share updates across platforms like Facebook, Instagram, and more. Additionally, you can track the performance of your posts with our built-in analytics tools, which currently monitor simple metrics like reactions (likes, hearts, etc.), comments, and shares—all from within our application.</p>
                        <Link class="block px-6 py-2 bg-blue-500 text-white font-bold w-fit rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                            Start Posting To Your Channels
                        </Link>
                    </div>
                    <img class="hidden lg:block lg:w-[435px]" src="https://poplanner.online/images/post_to_social_media_channels.png" alt="post to social media channels">
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-3 py-16 flex gap-16">
                <div class="flex-1 space-y-8">
                    <span class="block text-[#6875f5] font-black">3. Schedule your posts to your social media channels</span>
                    <h1 class="font-black text-2xl">Easy Scheduling for Your Social Media Posts</h1>
                    <p><span class="text-[#6875f5] font-black leading-7">POPlanner</span> enables you to schedule posts to your social media channels at any time you choose. Instead of manually posting at various times based on your needs, you can now rely on <span class="text-[#6875f5] font-black">POPlanner</span> to handle the timing for you with just a few simple clicks. This streamlined scheduling feature ensures your content is shared when it's most effective, allowing you to focus on other important aspects of your strategy.</p>
                    <Link class="block px-6 py-2 bg-blue-500 text-white font-bold w-fit rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        Start Scheduling Your Posts
                    </Link>
                </div>
                <img class="hidden lg:block lg:w-[450px] lg:rounded-full" src="https://poplanner.online/images/schedule_posts.png" alt="schedule posts">
            </div>

        </div>

        <div id="about_us" class="relative my-16 h-[500px] overflow-hidden flex items-center">
            <img class="absolute top-0 left-0 w-full h-full object-cover object-right md:object-center" src="https://poplanner.online/images/about_us.png" alt="about us">
            <div class="absolute top-0 left-0 w-full h-full bg-black/70 md:bg-black/30"></div>
            <div class="relative max-w-7xl mx-auto px-3 py-16 text-white flex flex-col gap-12">
                <h1 class="text-4xl font-black">About Us</h1>
                <p class="w-full md:w-[65%] leading-7 font-bold">POPlanner is designed to simplify social media management for everyone. Our app lets you easily connect your social channels, schedule posts, and track basic analytics like reactions, comments, and shares—all in one place. With just a few clicks, you can automate your posts and monitor engagement, saving time and helping you grow your online presence more efficiently.</p>
                <Link class="relative block w-fit p-5 bg-white text-[#6875f5] font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-[#6875f5] after:duration-150 after:rounded-md hover:after:h-full" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                    <span class="relative z-10">Join Us For Free</span>
                </Link>
            </div>
        </div>

    </main>

</template>

