<script setup>

import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '../Components/ApplicationLogo.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

let showMobileMenu = ref(false);

let paymentOption = ref('monthly');

window.addEventListener('scroll', function() {
    if(this.scrollY >= 750) {
        if(toTopBtn.classList.contains('-right-14')) {
            toTopBtn.classList.remove('-right-14');
            toTopBtn.classList.add('right-5');
        }
    } else {
        if(toTopBtn.classList.contains('right-5')) {
            toTopBtn.classList.remove('right-5');
            toTopBtn.classList.add('-right-14');
        }
    }
});

onMounted(() => {
    toTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0
        });
    });
});

</script>

<template>

        <Head>
            <title>Welcome</title>
            <link rel="icon" type="image/svg+xml" href="/poplanner.svg" />
        </Head>

    <nav class="bg-gray-100 shadow-md">

        <div class="max-w-7xl mx-auto flex justify-between items-center px-3 py-5">
            <ApplicationLogo class="w-24 sm:w-28 h-10" />
            <div class="hidden sm:flex sm:items-center sm:gap-4 md:gap-10">
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#about_us">About Us</a>
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#pricing">Pricing</a>
                <a class="text-gray-500 font-bold hover:underline hover:text-gray-400" href="#contact_us">Contact Us</a>
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
                            <a @click="showMobileMenu = false" class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#about_us">About Us</a>
                            <a @click="showMobileMenu = false" class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#pricing">Pricing</a>
                            <a @click="showMobileMenu = false" class="text-gray-500 font-bold p-2 hover:bg-indigo-500 hover:text-white" href="#contact_us">Contact Us</a>
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

    <button id="toTopBtn" class="block w-14 h-14 rounded-full border border-white bg-pop fixed z-50 bottom-10 -right-14 duration-200 animate-bounce" type="button">
        <i class="fa-solid fa-arrow-up font-black text-white text-xl"></i>
    </button>

    <main>

        <div class="max-w-7xl mx-auto px-3 py-5 flex flex-col-reverse lg:flex-row justify-between items-center gap-16 mt-16">

            <div class="flex-1 space-y-6">
                <h1 class="text-3xl sm:text-4xl font-black leading-9">Expand your reach on social media and beyond</h1>
                <p class="text-gray-500 leading-7">
                    <span class="font-black text-pop text-xl">POPlanner</span> helps you grow your audience naturally. We're a values-driven company offering affordable, user-friendly marketing tools for ambitious individuals and teams.
                </p>
                <p class="flex flex-col sm:flex-row items-center gap-6">
                    <span class="block space-x-2 px-3 py-2 bg-pop rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>Try for free</span>
                    </span>
                    <span class="block space-x-2 px-3 py-2 bg-pop rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>No credit card required</span>
                    </span>
                    <span class="block space-x-2 px-3 py-2 bg-pop rounded-full text-white font-black w-full sm:w-fit">
                        <i class="fa-solid fa-check text-xl"></i>
                        <span>Cancel anytime</span>
                    </span>
                </p>
            </div>

            <img class="w-[450px] aspect-video" src="/images/social_media_channels.png" alt="social media channels">
        </div>

        <div class="mt-32">

            <h1 class="text-3xl sm:text-4xl font-black text-center">Grow your audience without consuming all your time</h1>

            <p class="text-gray-500 text-center w-full px-2 sm:w-3/4 lg:w-1/2 mx-auto mt-8">Creating content is challenging enough, not to mention distributing it across multiple marketing channels. Here are four ways <span class="text-pop font-black">POPlanner</span> can assist you.</p>

            <div class="max-w-7xl mx-auto px-3 flex gap-16 mt-8 py-16">
                <div class="flex-1 space-y-8">
                    <span class="block text-pop font-black">1. Connect to your social media channels</span>
                    <h1 class="font-black text-2xl">Effortlessly Connect and Manage Your Social Media Channels</h1>
                    <p><span class="text-pop font-black leading-7">POPlanner</span> will make it easy for you to connect with all your social media channels, including Facebook pages, Instagram accounts, and more. Whether you're managing multiple profiles or just a few, <span class="text-pop font-black">POPlanner</span> streamlines the process so you can seamlessly integrate and manage your online presence across various platforms.</p>
                    <Link class="block px-6 py-4 bg-blue-500 text-white font-bold w-full text-center sm:w-fit  rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        Start Connecting Your Channels
                    </Link>
                </div>
                <img class="hidden lg:block" src="/images/connect_social_media_channels.png" alt="connect social media channels">
            </div>

            <div class="bg-gray-100">
                <div class="max-w-7xl mx-auto px-3 py-16 flex gap-16">
                    <div class="flex-1 space-y-8">
                        <span class="block text-pop font-black">2. Post to your social media channels</span>
                        <h1 class="font-black text-2xl">Seamlessly Post and Track Basic Social Media Analytics</h1>
                        <p><span class="text-pop font-black leading-7">POPlanner</span> will simplify the process of posting content directly to your connected social media channels, allowing you to effortlessly share updates across platforms like Facebook, Instagram, and more. Additionally, you can track the performance of your posts with our built-in analytics tools, which currently monitor simple metrics like reactions (likes, hearts, etc.), comments, and shares—all from within our application.</p>
                        <Link class="block px-6 py-4 bg-blue-500 text-white font-bold w-full text-center sm:w-fit rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                            Start Posting To Your Channels
                        </Link>
                    </div>
                    <img class="hidden lg:block lg:w-[435px]" src="/images/post_to_social_media_channels.png" alt="post to social media channels">
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-3 py-16 flex gap-16">
                <div class="flex-1 space-y-8">
                    <span class="block text-pop font-black">3. Schedule your posts to your social media channels</span>
                    <h1 class="font-black text-2xl">Easy Scheduling for Your Social Media Posts</h1>
                    <p><span class="text-pop font-black leading-7">POPlanner</span> enables you to schedule posts to your social media channels at any time you choose. Instead of manually posting at various times based on your needs, you can now rely on <span class="text-pop font-black">POPlanner</span> to handle the timing for you with just a few simple clicks. This streamlined scheduling feature ensures your content is shared when it's most effective, allowing you to focus on other important aspects of your strategy.</p>
                    <Link class="block px-6 py-4 bg-blue-500 text-white font-bold w-full text-center sm:w-fit rounded-full hover:bg-blue-600" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        Start Scheduling Your Posts
                    </Link>
                </div>
                <img class="hidden lg:block lg:w-[450px] lg:rounded-full" src="/images/schedule_posts.png" alt="schedule posts">
            </div>

        </div>

        <div id="about_us" class="relative mt-16 h-[700px] overflow-hidden flex items-center">
            <img class="absolute top-0 left-0 w-full h-full object-cover object-right md:object-center" src="/images/about_us.png" alt="about us">
            <div class="absolute top-0 left-0 w-full h-full bg-black/50 md:bg-black/30"></div>
            <div class="relative max-w-7xl mx-auto px-3 py-16 text-white flex flex-col gap-12">
                <h1 class="text-4xl font-black">About Us</h1>
                <div class="space-y-4">
                    <p class="w-full md:w-[65%] leading-7 font-bold">At POPlanner, we are dedicated to simplifying social media management for individuals. We understand that creating and sharing content can be time-consuming, which is why we’ve developed an intuitive app designed to streamline your workflow.</p>
                    <p class="w-full md:w-[65%] leading-7 font-bold">POPlanner allows you to easily connect your social media channels, schedule posts, and track basic analytics, such as reactions, comments, and shares—all from one platform. Whether you're managing multiple accounts or growing your presence on just a few, POPlanner takes the hassle out of staying active and engaged with your audience.</p>
                </div>
                <Link class="relative block w-fit p-5 bg-white text-pop font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-pop after:duration-150 after:rounded-md hover:after:h-full" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                    <span class="relative z-10">Join Us For Free</span>
                </Link>
            </div>
        </div>

        <div id="pricing" class="mt-32">

            <h1 class="text-3xl sm:text-4xl font-black text-center">Budget-Friendly Plans for Every Content Creator</h1>

            <p class="text-gray-500 text-center w-full px-2 sm:w-3/4 lg:w-1/2 mx-auto mt-8">Choose from a range of affordable plans designed to meet the needs of every content creator. Whether you're just starting out or managing multiple social channels, <span class="text-pop font-black">POPlanner</span> offers the perfect solution to help you grow your online presence without breaking the bank.</p>

            <div class="w-fit mx-auto mt-8 space-y-2">
                <h3 class="p-2 text-pop font-bold">Save 2 months with yearly billing</h3>
                <div class="w-fit mx-auto" >
                    <button
                        @click="paymentOption = 'monthly'"
                        class="px-3 py-2 border-r-transparent rounded-l-md"
                        :class="{'border border-pop bg-pop text-white': paymentOption === 'monthly', 'border border-gray-300 text-gray-500': paymentOption === 'yearly'}"
                        type="button">
                            Monthly
                    </button>
                    <button
                        @click="paymentOption = 'yearly'"
                        class="px-3 py-2 rounded-r-md"
                        :class="{'border border-pop bg-pop text-white': paymentOption === 'yearly', 'border border-gray-300 text-gray-500': paymentOption === 'monthly'}"
                        type="button">
                            Yearly
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-7xl mx-auto px-3 py-8">

                <div class="flex flex-col gap-6 relative border border-gray-200 rounded-md shadow-md px-8 py-16 hover:border-pop">
                    <h1 class="text-center text-4xl font-black">Free Plan</h1>
                    <span v-if="paymentOption === 'monthly'" class="block w-fit mx-auto text-3xl font-black">$0 <span class="text-sm text-gray-500">/ month</span></span>
                    <span v-if="paymentOption === 'yearly'" class="block w-fit mx-auto text-3xl font-black">$0 <span class="text-sm text-gray-500">/ year</span></span>
                    <ul class="space-y-4 mt-6">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Connect up to 3 channels</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Enjoy unlimited post publishing to all your channels</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Schedule posts to your connected channels with no limits</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Get full access to basic analytics for all your published posts</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-xmark text-red-500"></i>
                            <span>Customer support</span>
                        </li>
                    </ul>
                    <Link class="relative mt-6 block w-fit mx-auto p-5 border border-pop text-pop font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-pop after:duration-150 after:rounded-md hover:after:h-full" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        <span class="relative z-10">Join Us For Free</span>
                    </Link>
                </div>

                <div class="flex flex-col gap-6 relative border border-gray-200 rounded-md shadow-md px-8 py-16 hover:border-pop">
                    <h1 class="text-center text-4xl font-black">Professional</h1>
                    <span v-if="paymentOption === 'monthly'" class="block w-fit mx-auto text-3xl font-black">$2.99 <span class="text-sm text-gray-500">/ month</span></span>
                    <span v-if="paymentOption === 'yearly'" class="block w-fit mx-auto text-3xl font-black">$29.99 <span class="text-sm text-gray-500">/ year</span></span>
                    <ul class="space-y-4 mt-6">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Connect your channels with no limits</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Enjoy unlimited post publishing to all your connected channels</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Schedule posts to your connected channels with no limits</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Get full access to basic analytics for all your published posts</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-green-500"></i>
                            <span>Customer support</span>
                        </li>
                    </ul>
                    <button type="button" class="relative mt-6 block w-fit mx-auto p-5 border border-pop text-pop font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-pop after:duration-150 after:rounded-md hover:after:h-full" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                        <span class="relative z-10">Start Your Professional Plan</span>
                    </button>
                    <span class="absolute bottom-3 left-1/2 -translate-x-1/2 text-red-500 text-xs text-center">Apologies, this plan is coming soon and isn’t available just yet.</span>
                </div>

            </div>

        </div>

        <div id="contact_us" class="my-32">

            <h1 class="text-3xl sm:text-4xl font-black text-center">Have Questions Or Need Support?</h1>

            <p class="text-gray-500 text-center w-full px-2 sm:w-3/4 lg:w-1/2 mx-auto mt-8">We're here to help! Reach out to us with any inquiries or feedback, and we'll get back to you as soon as possible.</p>

            <div class="max-w-7xl mx-auto px-3 py-5 flex flex-col-reverse sm:flex-row gap-5">

                <form class="flex-1 flex flex-col mt-0 sm:mt-16">

                    <div class="flex flex-col gap-2">
                        <label class="font-black text-pop" for="name">Your Name :</label>
                        <input class="border border-gray-300 rounded-md h-14 focus:outline-none" id="name" type="text" placeholder="Your name is..." />
                    </div>

                    <div class="flex flex-col gap-2 mt-6">
                        <label class="font-black text-pop" for="subject">Subject :</label>
                        <input class="border border-gray-300 rounded-md h-14 focus:outline-none" id="subject" type="text" placeholder="Your message's subject" />
                    </div>

                    <div class="flex flex-col gap-2 mt-6">
                        <label class="font-black text-pop" for="message">Message :</label>
                        <textarea class="border border-gray-300 rounded-md resize-none" id="message" placeholder="Your message" rows="12"></textarea>
                    </div>

                    <button class="self-end relative mt-6 block w-fit p-5 border border-pop text-pop font-bold rounded-md hover:text-white after:absolute after:bottom-0 after:left-0 after:w-full after:h-0 after:bg-pop after:duration-150 after:rounded-md hover:after:h-full" type="button">
                        <span class="block w-fit relative z-10">Send Message</span>
                    </button>

                </form>

                <div class="mt-8 mb-8 sm:mt-20">
                    <h1 class="text-xl font-black flex items-center gap-2 text-green-500">
                        <i class="fa-brands fa-whatsapp text-3xl"></i>
                        <span>Reach Us via WhatsApp</span>
                    </h1>
                    <p class="space-y-2 mt-2">
                        <span class="ml-10 block text-gray-500">+212623102020</span>
                        <span class="ml-10 block text-gray-500">+212623102020</span>
                    </p>
                </div>

            </div>

        </div>

    </main>

    <footer class="relative w-full min-h-[600px] bg-gray-100 mt-32 pt-16 pb-32">

        <div class="max-w-7xl mx-auto px-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-20 gap-y-10">

            <div class="space-y-8">
                <ApplicationLogo class="w-72 h-28" />
                <p class="text-gray-500"><span class="text-pop font-black">POPlanner</span> makes managing your social media easy with features for scheduling posts, tracking basic analytics, and connecting your channels. Streamline your online presence and focus on what matters.</p>
                <Link class="relative block w-full text-center p-5 bg-blue-500 text-white font-bold rounded-full hover:bg-blue-600 sm:w-fit" v-if="!$page.props.auth.user && canRegister" :href="route('register')">
                    Join Us For Free
                </Link>
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-black text-gray-700">QUICK LINKS</h3>
                <ul>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#about_us">About Us</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#pricing">Pricing</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#contact_us">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-black text-gray-700">POLICIES AND TERMS</h3>
                <ul>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#">Privacy Policy</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#">Terms of Service</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#">Cookie Policy</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#">User Agreement</a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2">
                        <a class="block text-gray-500 font-bold py-6 group-hover:text-pop" href="#">Legal Information</a>
                    </li>
                </ul>
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-black text-gray-700">FIND US</h3>
                <ul>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="text-gray-500 font-bold py-6 flex items-center gap-2 group-hover:text-pop" href="#">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                            <span>POPlannerApp</span>
                        </a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="text-gray-500 font-bold py-6 flex items-center gap-2 group-hover:text-pop" href="#">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                            <span>@POPlannerApp</span>
                        </a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2 border-b border-b-gray-300">
                        <a class="text-gray-500 font-bold py-6 flex items-center gap-2 group-hover:text-pop" href="#">
                            <i class="fa-brands fa-x-twitter text-2xl"></i>
                            <span>@POPlannerApp</span>
                        </a>
                    </li>
                    <li class="group ml-0 duration-300 hover:ml-2">
                        <a class="text-gray-500 font-bold py-6 flex items-center gap-2 group-hover:text-pop" href="#">
                            <i class="fa-brands fa-linkedin text-2xl"></i>
                            <span>POPlannerApp</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 px-3 py-6 w-full max-w-[1280px] flex justify-between items-center border-t border-gray-300">
            <span class="block w-fit text-pop font-black">POPlanner</span>
            <span>&copy;2024 All Right Reserved</span>
        </div>

    </footer>

</template>

