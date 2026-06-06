// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: pieLabels,
        datasets: [{
            data: pieData,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#B2C23C', '#C9861E', '#B84F35'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    let dataset = data.datasets[0];
                    let total = dataset.data.reduce((a, b) => a + b, 0);
                    let value = dataset.data[tooltipItem.index];
                    let percent = ((value / total) * 100).toFixed(1);
                    return data.labels[tooltipItem.index] + ": " + percent + "%";
                }
            }
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});
