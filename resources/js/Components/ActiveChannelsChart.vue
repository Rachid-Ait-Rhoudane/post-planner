<script setup>

import { ref, onMounted } from 'vue';
import { Chart, DoughnutController, ArcElement, Tooltip, Legend } from 'chart.js';

Chart.register(DoughnutController, ArcElement, Tooltip, Legend);

let chartCanvas = ref(null);

onMounted(() => {

    (async function() {
        const labels = [
        'green', 'blue', 'red'
        ];

        new Chart(
            chartCanvas.value,
            {
                type: 'doughnut',
                data: {
                labels,
                datasets: [
                    {
                    label: 'Your active channels',
                    data: [33, 25, 10],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                    }
                ]
                }
            }
        );
    })();

});

</script>

<template>

    <div class="min-w-full bg-gray-100 p-2 rounded-md shadow-md space-y-4 flex flex-col items-center">
        <h1 class="text-xl font-bold text-gray-800">Your Active Channels This Week</h1>
        <canvas class="max-w-[300px] max-h-[300px]" ref="chartCanvas"></canvas>
    </div>

</template>
