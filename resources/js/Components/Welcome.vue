<script setup>

import WeeklyPostsChart from './WeeklyPostsChart.vue';
import ActiveChannelsChart from './ActiveChannelsChart.vue';

</script>

<template>

    <div class="p-4 space-y-4">

        <h1 class="text-3xl font-black mx-4 mb-4 text-gray-800">Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-file text-6xl text-blue-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Today Posts</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-blue-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>Your published posts today</span>
                </div>
            </div>

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-file text-6xl text-blue-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Total Posts</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-blue-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>All your published posts</span>
                </div>
            </div>

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-calendar-days text-6xl text-green-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Today Scheduling</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-green-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>Your scheduled posts today</span>
                </div>
            </div>

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-calendar-days text-6xl text-green-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Total Scheduling</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-green-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>All your scheduled posts</span>
                </div>
            </div>

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-circle-nodes text-6xl text-orange-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Today Channels</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-orange-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>Channels you connected today</span>
                </div>
            </div>

            <div class="bg-gray-100 rounded-md shadow-md p-4 space-y-3">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-circle-nodes text-6xl text-orange-500"></i>
                    <p class="flex flex-col gap-0.5">
                        <span class="text-xl font-bold text-gray-800">Total Channels</span>
                        <span class="text-3xl font-bold text-gray-800">0</span>
                    </p>
                </div>
                <div class="text-orange-500 font-bold flex items-baseline gap-2 text-sm">
                    <i class="fa-solid fa-chevron-up"></i>
                    <span>All your connected channels</span>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <WeeklyPostsChart />
            <ActiveChannelsChart />
        </div>

    </div>

</template>
