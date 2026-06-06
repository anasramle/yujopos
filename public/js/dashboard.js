// AREA CHART
const ctx = document.getElementById('areaChart').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, "#644d3c");
gradient.addColorStop(1, "#a19c8a");

const areaChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales',
            data: data,
            fill: true,
            backgroundColor: gradient,
            borderColor: '#644d3c',
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#644d3c'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: value => 'RM ' + value
                }
            }
        }
    }
});


// PIE CHART
const pieCtx = document.getElementById('pieChart').getContext('2d');

const pieChart = new Chart(pieCtx, {
    type: 'doughnut',
    data: {
        labels: pieLabels,
        datasets: [{
            data: pieData,
            backgroundColor: [
                '#6e6456',
                '#948363',
                '#a39170',
                '#b0a384',
                '#c9c1a7',
                '#dfdac4'
            ],
            borderWidth: 2,
            hoverOffset: 12
        }]
    },
    options: {

        responsive: true,
        cutout: '70%',
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let data = context.dataset.data.map(Number);

                        let total = data.reduce((a, b) => a + b, 0);
                        let value = Number(context.raw);

                        let percentage = total > 0
                            ? ((value / total) * 100).toFixed(1)
                            : 0;

                        return `${context.label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});





