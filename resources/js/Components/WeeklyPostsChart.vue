<script setup>

import { ref, onMounted } from 'vue';
import { Chart, LineController, LineElement, PointElement, LinearScale, CategoryScale, Title, Tooltip, Legend } from 'chart.js';

Chart.register(LineController, LineElement, PointElement, LinearScale, CategoryScale, Title, Tooltip, Legend);

let chartCanvas = ref(null);

onMounted(() => {

(async function() {

  const data = [
    { day: 'Mon', count: 10 },
    { day: 'Tue', count: 20 },
    { day: 'Wed', count: 15 },
    { day: "Thu", count: 25 },
    { day: "Fri", count: 22 },
    { day: "Sat", count: 30 },
    { day: "Sun", count: 28 },
  ];

  new Chart(
    chartCanvas.value,
    {
      type: 'line',
      data: {
        labels: data.map(row => row.day),
        datasets: [
          {
            label: 'Number of posts',
            data: data.map(row => row.count),
            backgroundColor: '#6d7af5',
            borderColor: '#6d7af5'
          }
        ]
      },
      options: {
        plugins: {
            customCanvasBackgroundColor: {
              color: '#374151',
            }
        },
        scales: {
          x: {
              ticks: {
                  color: '#1f2937'
              },
              grid: {
                color: 'transparent'
              }
          },
          y: {
              ticks: {
                  color: '#1f2937'
              }
          }
      }
      }
    }
  );
})();

});

</script>

<template>

    <div class="min-w-full bg-gray-100 p-2 rounded-md shadow-md space-y-4">
        <h1 class="w-fit mx-auto text-xl font-bold text-gray-800">Your Weekly Posting Activity</h1>
        <canvas ref="chartCanvas"></canvas>
    </div>

</template>
