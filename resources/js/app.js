import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const doughnutCtx = document.getElementById('doughnutChart');
    const pieCtx = document.getElementById('pieChart');

    if (doughnutCtx) {
        const productosData = {
            labels: window.topProductosLabels,
            datasets: [{
                label: 'Cantidad Salida',
                data: window.topProductosValores,
                backgroundColor: ['#60a5fa', '#34d399', '#f87171', '#facc15', '#c084fc'],
                borderWidth: 1
            }]
        };

        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: productosData,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    if (pieCtx) {
        const materialesData = {
            labels: window.topMaterialesLabels,
            datasets: [{
                label: 'Cantidad Salida',
                data: window.topMaterialesValores,
                backgroundColor: ['#f97316', '#14b8a6', '#a78bfa', '#ef4444', '#10b981'],
                borderWidth: 1
            }]
        };

        new Chart(pieCtx, {
            type: 'pie',
            data: materialesData,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }
});
