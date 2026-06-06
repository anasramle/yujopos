@include('layout.header')

<style>
    body {
        background: #dfdac4;
        color: #644d3c;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
    }

    /* Main layout container */
    #layoutSidenav {
        display: flex;
        min-height: 100vh;
        position: relative;
        width: 100%;
    }

    /* Content area - only this scrolls */
    #layoutSidenav_content {
        flex: 1;
        position: relative;
    }

    .luxury-container {
        padding: 1.5rem;
        flex: 1;
        height: auto;
        min-height: 100%;
    }

    .page-title-luxury {
        font-size: 1.8rem;
        font-weight: 600;
        color: #644d3c;
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
        margin-top: 0.5rem;
        border-left: 5px solid #644d3c !important;
        padding-left: 0.5rem !important;
    }

    .stat-card {
        background: #c9c2ae;
        border: 1px solid #644d3c;
        border-radius: 24px;
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(100, 77, 60, 0.25);
    }

    .stat-card-body {
        padding: 1.25rem;
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #524a3f;
        margin-bottom: 0.5rem;
        
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #4a3629;
        margin-bottom: 0;
        line-height: 1.2;
    }

    .stat-trend {
        font-size: 0.7rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .trend-up {
        color: #644d3c;
    }

    .trend-down {
        color: #644d3c;
    }

    /*  Card for Charts */
    .luxury-card {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 24px;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .luxury-card:hover {
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.35);
    }

    .card-header-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        padding: 0.9rem 1.5rem;
        border-bottom: 2px solid #644d3c;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        min-height: 60px;
    }

    .card-header-luxury h5 {
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 1rem;
    }

    .card-header-luxury i {
        margin-right: 8px;
        color: #dfdac4;
    }

    .card-body-luxury {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 300px;
        flex: 1;
    }

    canvas {
        max-height: 300px;
        width: 100% !important;
    }

    .alert-luxury {
        background: #644d3c;
        border-left: 4px solid #a18466;
        color: #dfdac4;
        border-radius: 16px;
        padding: 12px 20px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .alert-luxury i {
        margin-right: 8px;
    }


    .btn-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        border: none;
        color: #dfdac4;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px; */
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3);
        color: #dfdac4;
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
        text-decoration: none;
    }

    /* Dropdown Filter */
    .dropdown-filter {
        position: relative;
        display: inline-block;
    }

    .dropbtn-filter {
        background: rgba(223, 218, 196, 0.2);
        border: 1px solid #dfdac4;
        border-radius: 40px;
        padding: 6px 16px;
        color: #dfdac4;
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .dropbtn-filter:hover {
        background: #dfdac4;
        color: #644d3c;
    }

    .dropdown-content-filter {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        z-index: 100;
        margin-top: 8px;
        min-width: 140px;
    }

    .dropdown-content-filter a {
        color: #644d3c;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
        font-size: 0.8rem;
        transition: all 0.2s ease;
        border-radius: 12px;
        margin: 4px 6px;
    }

    .dropdown-content-filter a:hover {
        background: #c9c2ae;
    }

    .dropdown-filter.show .dropdown-content-filter {
        display: block;
    }

    .low-stock-table {
        width: 100%;
    }

    .low-stock-table tr {
        border-bottom: 1px solid #c9c2ae;
    }

    .low-stock-table tr:last-child {
        border-bottom: none;
    }

    .low-stock-table td {
        padding: 10px 0;
    }

    .stock-badge {
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }

    .stock-badge-danger {
        background: #e74c3c20;
        color: #c0392b;
        border: 1px solid #c0392b;
    }

    .stock-badge-warning {
        background: #f39c1220;
        color: #e67e22;
        border: 1px solid #e67e22;
    }

    .stock-badge-dark {
        background: #644d3c20;
        color: #644d3c;
        border: 1px solid #644d3c;
    }

    .branch-badge {
        background: #644d3c20;
        color: #644d3c;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #a0927e;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .pie-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 5px;
        height: 100%;
        min-height: 300px;
    }

    .pie-chart-area {
        flex: 0 0 55%;
        position: relative;
        height: 280px;
    }

    .pie-chart-area canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .custom-legend {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 12px;
    }

    .legend-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #644d3c;
        font-size: 0.85rem;
        font-weight: 500;
        gap: 12px;
    }

    .legend-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        white-space: nowrap;
    }

    .legend-color {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .legend-percent {
        font-weight: 700;
        color: #4a3629;
    }

    .luxury-card .chartjs-legend,
    .luxury-card .chartjs-legend ul,
    .luxury-card ul:not(.custom-legend),
    .luxury-card .legend:not(.custom-legend),
    canvas+ul {
        display: none !important;
    }


    .custom-legend,
    .custom-legend * {
        display: flex !important;
    }

    /* Responsive */
    @media (max-width: 500px) {
        .luxury-container {
            padding: 0.75rem;
        }

        .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
            padding-left: 225px;
            top: 56px;
        }

        .container-fluid.px-4 .mt-4 {
            margin-top: 0 !important;
        }

        #layoutSidenav_content {
            margin-top: 3px !important;
        }

        .page-title-luxury {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
            max-width: 55%;
            word-break: break-word;
            white-space: normal;
            line-height: 1.3;
            padding-left: 0.3rem !important;
            border-left-width: 5px !important;
            flex-shrink: 1;
        }

        .stat-value {
            font-size: 1.25rem;
        }

        .stat-label {
            font-size: 0.65rem;
        }

        .card-header-luxury h5 {
            font-size: 0.85rem;
        }

        .dropbtn-filter {
            padding: 4px 12px;
            font-size: 0.7rem;
        }

        .chart-container {
            min-height: 220px;
        }

        canvas {
            max-height: 220px;
        }

        .pie-wrapper {
            flex-direction: column;
        }

        .pie-chart-area {
            width: 100%;
            flex: unset;
            height: 220px;
        }

        .custom-legend {
            width: 100%;
        }

        .btn-luxury {
            padding: 6px 12px;
            font-size: 13px;
            gap: 4px;
        }
    }

    @media (min-width: 501px) and (max-width: 950px) {
        .luxury-container {
            padding: 1rem;
        }

        .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
            padding-left: 225px;
            top: 56px;
        }

        .container-fluid.px-4 .mt-4 {
            margin-top: 0 !important;
        }

        #layoutSidenav_content {
            margin-top: 3px !important;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .chart-container {
            min-height: 260px;
        }

        canvas {
            max-height: 260px;
        }

        .pie-chart-area {
            height: 240px;
        }

        .btn-luxury {
            padding: 8px 16px;
            font-size: 13px;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 luxury-container">

            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title-luxury">
                    Business Dashboard
                </h1>
                <a href="{{ route('report') }}" class="btn btn-luxury">
                    <i class="fas fa-file-alt me-2"></i>Create Report
                </a>
            </div>

            <!-- Growth Alert -->
            <div class="alert-luxury">
                <i class="fas fa-chart-line"></i>
                Sales
                @if ($growth >= 0)
                    increased by <strong>{{ round($growth, 1) }}%</strong>
                @else
                    decreased by <strong>{{ round(abs($growth), 1) }}%</strong>
                @endif
                compared to yesterday
            </div>

            <!-- Stats Cards Row -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-card-body">
                            <div class="stat-label">
                                <i class="fas fa-calendar-alt me-1"></i>Monthly Sales
                            </div>
                            <div class="stat-value">RM{{ number_format($monthly_sales, 2) }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-card-body">
                            <div class="stat-label">
                                <i class="fas fa-sun me-1"></i>Daily Sales
                                @if ($daily_sales > $yesterday_sales)
                                    <span class="trend-up ms-1"><i class="fas fa-arrow-up"></i></span>
                                @elseif ($daily_sales < $yesterday_sales)
                                    <span class="trend-down ms-1"><i class="fas fa-arrow-down"></i></span>
                                @endif
                            </div>
                            <div class="stat-value">
                                RM{{ number_format($daily_sales, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-card-body">
                            <div class="stat-label">
                                <i class="fas fa-shopping-cart me-1"></i>Today's Orders
                            </div>
                            <div class="stat-value">{{ number_format($total_orders_today) }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-card-body">
                            <div class="stat-label">
                                <i class="fas fa-box me-1"></i>Items Sold
                            </div>
                            <div class="stat-value">{{ number_format($items_sold) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <!-- Sales Trend Chart -->
                <div class="col-xl-6">
                    <div class="luxury-card">
                        <div class="card-header-luxury">
                            <h5><i class="fas fa-chart-line me-2"></i>Sales Trend</h5>
                        </div>
                        <div class="card-body-luxury">
                            <div class="chart-container">
                                <canvas id="areaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Selling Items Chart -->
                <div class="col-xl-6">
                    <div class="luxury-card">
                        <div class="card-header-luxury">
                            <h5><i class="fas fa-chart-pie me-2"></i>Top Selling</h5>
                            <div class="dropdown-filter" id="topFilterDropdown">
                                <button class="dropbtn-filter" id="topFilterBtn">
                                    <span id="filterText">This Month</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-content-filter">
                                    <a href="#" data-value="today">Today</a>
                                    <a href="#" data-value="week">This Week</a>
                                    <a href="#" data-value="month">This Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-luxury">

                            <div class="pie-wrapper">

                                <div class="pie-chart-area">
                                    <canvas id="pieChart"></canvas>
                                </div>

                                <div id="pieLegend" class="custom-legend"></div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Section -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="luxury-card">
                        <div class="card-header-luxury">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alert</h5>
                        </div>
                        <div class="card-body-luxury">
                            @if ($low_stock->isEmpty())
                                <div class="empty-state">
                                    <i class="fas fa-check-circle"></i>
                                    <p>All items are well stocked! 🎉</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="low-stock-table">
                                        <tbody>
                                            @foreach ($low_stock as $item)
                                                <tr>
                                                    <td style="width: 40%">
                                                        <strong>{{ $item->item_name }}</strong>
                                                    </td>
                                                    @if ($isGlobal ?? false)
                                                        <td style="width: 30%">
                                                            <span class="branch-badge">
                                                                <i
                                                                    class="fas fa-store me-1"></i>{{ $item->branch_name }}
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td style="width: 30%" class="text-end">
                                                        <span
                                                            class="stock-badge
                                                            {{ ($item->qty ?? 0) == 0 ? 'stock-badge-dark' : (($item->qty ?? 0) <= 2 ? 'stock-badge-danger' : 'stock-badge-warning') }}">
                                                            <i class="fas fa-box me-1"></i>Stock: {{ $item->qty ?? 0 }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function cleanText(text) {
        if (!text) return '';
        return String(text).replace(/\s+/g, ' ').trim();
    }
    let labels = @json($sales_7_days->pluck('date'));
    let data = @json($sales_7_days->pluck('total'));
    let pieLabels = @json($top_items->pluck('item_name'));
    let pieData = @json($top_items->pluck('total_qty'));

    let areaChart, pieChart;

    function renderPieLegend(chart) {
        const legendContainer = document.getElementById('pieLegend');
        if (!legendContainer) return;

        const labels = chart.data.labels;
        const values = chart.data.datasets[0].data;
        const colors = chart.data.datasets[0].backgroundColor;
        const total = values.reduce((a, b) => Number(a) + Number(b), 0);

        legendContainer.innerHTML = '';

        labels.forEach((label, index) => {
            const percentage = total > 0 ? ((values[index] / total) * 100).toFixed(1) : 0;

            legendContainer.innerHTML += `
            <div class="legend-item">
                <div class="legend-left">
                    <span class="legend-color" style="background:${colors[index]}"></span>
                    <span>${label}</span>
                </div>
                <span class="legend-percent">${percentage}%</span>
            </div>
            `;
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Area Chart (Sales Trend)
        const ctx1 = document.getElementById('areaChart').getContext('2d');
        areaChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: 'rgba(100, 77, 60, 0.1)',
                    borderColor: '#644d3c',
                    borderWidth: 3,
                    pointBackgroundColor: '#4a3629',
                    pointBorderColor: '#dfdac4',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true,
                    label: 'Sales'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return 'RM ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'RM ' + value;
                            }
                        },
                        title: {
                            display: false
                        }
                    },
                    x: {
                        title: {
                            display: false
                        }
                    }
                }
            }
        });

        const ctx2 = document.getElementById('pieChart').getContext('2d');

        // Handle empty data
        let chartLabels = pieLabels.length ? pieLabels : ["No Data"];
        let chartData = pieData.length ? pieData : [1];

        pieChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: chartLabels,
                datasets: [{
                    data: chartData,
                    backgroundColor: [
                        '#644d3c',
                        '#8b6b55',
                        '#a18466',
                        '#4a3629',
                        '#7a5d4a',
                        '#5e4535',
                        '#c9a88c',
                        '#b8916e'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: '#644d3c',
                        titleColor: '#dfdac4',
                        bodyColor: '#dfdac4',
                        callbacks: {
                            label: function(context) {
                                const value = Number(context.raw);
                                const total = context.dataset.data.reduce((a, b) => Number(a) +
                                    Number(b), 0);
                                const percent = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value} sold (${percent}%)`;
                            }
                        }
                    }
                },
                // Alternative legend config
                legend: {
                    display: false
                }
            }
        });

        // Force hide any default legend elements with JavaScript
        setTimeout(function() {
            const defaultLegends = document.querySelectorAll(
                '.chartjs-legend, canvas + ul, .luxury-card ul:not(.custom-legend)');
            defaultLegends.forEach(el => {
                if (el && el !== document.getElementById('pieLegend')) {
                    el.style.display = 'none';
                    el.style.visibility = 'hidden';
                }
            });
        }, 100);

        renderPieLegend(pieChart);

        // Top Filter Dropdown Functionality
        const topFilterBtn = document.getElementById('topFilterBtn');
        const topFilterDropdown = document.getElementById('topFilterDropdown');
        const filterText = document.getElementById('filterText');

        if (topFilterBtn) {
            topFilterBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                topFilterDropdown.classList.toggle('show');
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (topFilterDropdown && !topFilterDropdown.contains(e.target)) {
                topFilterDropdown.classList.remove('show');
            }
        });

        // Handle filter selection
        document.querySelectorAll('#topFilterDropdown .dropdown-content-filter a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const filterValue = this.dataset.value;
                const filterLabel = this.innerText;

                if (filterText) filterText.innerText = filterLabel;

                // Close dropdown
                topFilterDropdown.classList.remove('show');

                // Show loading state
                pieChart.data.labels = ["Loading..."];
                pieChart.data.datasets[0].data = [1];
                pieChart.update();
                renderPieLegend(pieChart);

                // Fetch new data
                fetch(`/dashboard/top-items?filter=${filterValue}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data || data.length === 0) {
                            pieChart.data.labels = ["No Data"];
                            pieChart.data.datasets[0].data = [1];
                        } else {
                            pieChart.data.labels = data.map(i => i.item_name);
                            pieChart.data.datasets[0].data = data.map(i => i.total_qty);
                        }
                        pieChart.update();
                        renderPieLegend(pieChart);
                    })
                    .catch(err => {
                        console.error('Error fetching top items:', err);
                        pieChart.data.labels = ["Error"];
                        pieChart.data.datasets[0].data = [1];
                        pieChart.update();
                        renderPieLegend(pieChart);
                    });
            });
        });
    });
</script>

@include('layout.footer')
