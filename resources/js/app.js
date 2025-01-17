import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;


Alpine.start();

import {Chart} from 'chart.js';

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
        datasets: [{
            label: 'Zásilka #2341-12-2024',
            data: [17, 18.3, 21.3, 11.3, 4, 13.1],
            borderWidth: 2,
            borderColor: '#1b4332',
            backgroundColor: '#2d6a4f',
        }],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },

});