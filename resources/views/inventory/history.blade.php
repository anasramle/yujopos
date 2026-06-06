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
        width: 100%;
    }

    /* Content area */
    #layoutSidenav_content {
        min-height: 100vh;
    }

    /* Luxury Container */
    .luxury-container {
        padding: 1.5rem;
        flex: 1;
        height: auto;
        min-height: 100%;
    }

    /* Luxury Card */
    .luxury-card {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 24px;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: auto;
    }

    .luxury-card:hover {
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.35);
    }

    /* Card Header Luxury */
    .card-header-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        padding: 1rem 1.5rem;
        border-bottom: 2px solid #644d3c;
    }

    .card-header-luxury h5 {
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-header-luxury i {
        margin-right: 8px;
        color: #dfdac4;
    }

    /* Button Luxury */
    .btn-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        border: none;
        color: #dfdac4;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3);
        color: #dfdac4;
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
    }

    /* Status Badges for Movement Type */
    .badge-add,
    .badge-sale,
    .badge-deduct {
        color: #fff;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        min-width: 100px;
        text-align: center;
    }


    .badge-add {
        background: #b5c3bb30;
        color: #27ae60;
        border: 1px solid #27ae60;
    }

    .badge-sale {
        background: #e67d222c;
        color: #e67e22;
        border: 1px solid #e67e22;
    }

    .badge-deduct {
        background: #e74c3c30;
        color: #c0392b;
        border: 1px solid #c0392b;
    }

    /* Datatable Luxury Override */
    .datatable-table {
        background: #dfdac4 !important;
        color: #644d3c !important;
        border-radius: 16px;
        overflow: hidden;
        white-space: nowrap;
    }

    .datatable-table thead th {
        background: #644d3c !important;
        color: #dfdac4 !important;
        font-weight: 600;
        padding: 14px 12px;
        border-bottom: 2px solid #644d3c;
    }

    .datatable-table tbody tr {
        background: #dfdac4 !important;
        transition: all 0.2s ease;
    }

    .datatable-table tbody tr:hover {
        background: #efe9d0 !important;
        cursor: pointer;
    }

    .datatable-table td {
        padding: 12px;
        vertical-align: middle;
        border-color: #c9c2ae;
    }

    /* Search & Dropdown */
    .datatable-wrapper .datatable-input,
    .datatable-wrapper .datatable-selector {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 40px;
        padding: 8px 16px;
        color: #644d3c;
        font-size: 14px;
    }

    .datatable-wrapper .datatable-input:focus,
    .datatable-wrapper .datatable-selector:focus {
        outline: none;
        border-color: #644d3c;
        box-shadow: 0 0 0 2px rgba(100, 77, 60, 0.2);
    }

    .datatable-info {
        color: #644d3c !important;
        font-weight: 500;
    }

    /* Pagination Luxury */
    .datatable-pagination a {
        background: #dfdac4 !important;
        color: #644d3c !important;
        border: 1px solid #644d3c !important;
        border-radius: 30px !important;
        margin: 0 3px;
        padding: 6px 12px;
    }

    .datatable-pagination a:hover {
        background: #644d3c !important;
        color: #dfdac4 !important;
    }

    .datatable-pagination .active a {
        background: #644d3c !important;
        color: #dfdac4 !important;
        border-color: #644d3c !important;
    }

    /* Form Luxury */
    .form-luxury {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 30px;
        padding: 6px 14px;
        color: #644d3c;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 13px;
    }

    .form-luxury:focus {
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgb(157, 134, 124);
        outline: none;
        background: #f5f0e0;
    }

    label {
        font-weight: 600;
        color: #644d3c;
        margin-bottom: 6px;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    /* Alert Luxury */
    .alert-custom {
        background: #644d3c;
        border-left: 4px solid #a18466;
        color: #dfdac4;
        border-radius: 16px;
        padding: 12px 20px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    /* Page Title */
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

    /* .page-title-luxury::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 3px;
        background: #644d3c;
        border-radius: 3px;
    } */

    /* Back button container */
    .back-button-container {
        margin-top: 1.5rem;
    }

    /* === TABLE CONTAINER WITH SCROLL FOR MOBILE === */
    .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .paginate-btn {
        background: transparent;
        border: 1px solid #644d3c;
        color: #644d3c;
        border-radius: 24px;
        padding: 2px 8px;
        margin: 0 2px;
        font-size: 11px;
        min-width: 28px;
    }

    /* Responsive */
    @media (max-width: 500px) {
        .luxury-container {
            padding: 0.5rem;
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

        .btn-luxury {
            padding: 6px 12px;
            font-size: 13px;
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

        .table-responsive-wrapper {
            overflow-x: auto;
            border-radius: 16px;
        }
        .card-header-luxury h5 {
        font-size: 16px;
    }

        .datatable-table {
            min-width: 650px;
            width: max-content;
        }

        .datatable-table td,
        .datatable-table th {
            font-size: 11px;
            padding: 8px 6px;
            white-space: nowrap;
        }

        .badge-add,
        .badge-sale,
        .badge-deduct {
            font-size: 9px;
            padding: 3px 8px;
        }

        .d-flex.justify-content-between.align-items-center.flex-wrap {
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            gap: 6px !important;
        }

        #searchInput {
            min-width: 130px !important;
            width: auto !important;
            max-width: 140px !important;
            font-size: 10px !important;
            padding: 4px 8px !important;
        }

        #entriesPerPage {
            width: 45px !important;
            padding: 3px 14px 3px 4px !important;
            font-size: 10px !important;
        }

        .paginate-btn {
            padding: 1px 6px !important;
            font-size: 9px !important;
            min-width: 22px !important;
            margin: 0 1px !important;
        }

        #tableInfo {
            font-size: 10px !important;
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

        .btn-luxury {
            padding: 8px 16px;
            font-size: 13px;
        }

        .page-title-luxury {
            font-size: 1.4rem;
        }

        .datatable-table td,
        .datatable-table th {
            font-size: 12px;
            padding: 8px;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 luxury-container">
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title-luxury">
                    Stock Movement History
                </h1>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-custom mb-3" id="autoHideAlert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-custom mb-3" id="autoHideAlert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Stock History Table Card -->
            <div class="luxury-card">
                <div class="card-header-luxury">
                    <h5><i class="fas fa-chart-line"></i> All Stock Movements</h5>
                </div>
                <div class="card-body" style="background: #dfdac4; padding: 1rem;">
                    <!-- Search & Entries Bar -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2" style="gap: 10px;">
                        <div class="d-flex align-items-center" style="gap: 6px;">
                            <span style="color: #644d3c; font-size: 13px;">Show</span>
                            <select id="entriesPerPage"
                                style="background: #dfdac4; border: 1px solid #644d3c; border-radius: 30px; padding: 4px 20px 4px 8px; color: #644d3c; font-size: 12px; width: 55px; cursor: pointer;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span style="color: #644d3c; font-size: 13px;">entries</span>
                        </div>

                        <div class="d-flex align-items-center" style="gap: 6px;">
                            <i class="fas fa-search" style="color: #644d3c; font-size: 12px;"></i>
                            <input type="text" id="searchInput" class="form-luxury" placeholder="Search items..."
                                style="min-width: 180px; padding: 5px 12px; font-size: 12px; border-radius: 30px;">
                        </div>
                    </div>

                    <!-- Scrollable table wrapper -->
                    <div class="table-responsive-wrapper">
                        <table id="historyTable" class="table datatable-table" style="width: 100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-box me-1"></i>Item</th>
                                    <th class="text-center"><i class="fas fa-exchange-alt me-1"></i>Type</th>
                                    <th class="text-center"><i class="fas fa-cubes me-1"></i>Quantity</th>
                                    <th class="text-center"><i class="fas fa-pencil-alt me-1"></i>Note</th>
                                    <th class="text-center"><i class="fas fa-user me-1"></i>PIC</th>
                                    <th class="text-center"><i class="fas fa-calendar me-1"></i>Created At</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                @forelse ($data as $d)
                                    <tr>
                                        <td><strong>{{ $d->item_name }}</strong></strong></td>
                                        <td class="text-center">
                                            @if ($d->type == 'add')
                                                <span class="badge-add"><i
                                                        class="fas fa-plus-circle me-1"></i>ADD</span>
                                            @elseif ($d->type == 'sale')
                                                <span class="badge-sale"><i
                                                        class="fas fa-shopping-cart me-1"></i>SALE</span>
                                            @else
                                                <span class="badge-deduct"><i
                                                        class="fas fa-minus-circle me-1"></i>DEDUCT</span>
                                            @endif
                                            </span>
                                        </td>
                                        <td class="text-center"><strong>{{ $d->qty }}</strong></td>
                                        <td class="text-center">{{ $d->note ?? '-' }}</td>
                                        <td class="text-center"><i class="fas fa-user-circple me-1"></i>{{ $d->user_name ?? '-' }}</td>
                                        <td class="text-center">{{ date('d M Y', strtotime($d->created_at)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 40px; color: #a0927e;">
                                            <i class="fas fa-history fa-2x mb-2 d-block"></i>
                                            No movement data found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Info & Pagination -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3" style="gap: 10px;">
                        <div id="tableInfo" style="color: #644d3c; font-weight: 500; font-size: 13px;"></div>
                        <div id="paginationControls" class="d-flex align-items-center" style="gap: 3px;"></div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="back-button-container">
                <a href="{{ route('inventory.index') }}" class="btn-luxury">
                    <i class="fas fa-arrow-left me-2"></i>Back to Inventory
                </a>
            </div>
        </div>
    </main>
</div>

<script>
    let allHistoryData = [];
    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    @php
        $historyData = [];
        foreach ($data as $d) {
            $typeClass = '';
            $typeIcon = '';
            if ($d->type == 'add') {
                $typeClass = 'badge-add';
                $typeIcon = '<i class="fas fa-plus-circle me-1"></i>';
            } elseif ($d->type == 'sale') {
                $typeClass = 'badge-sale';
                $typeIcon = '<i class="fas fa-shopping-cart me-1"></i>';
            } else {
                $typeClass = 'badge-deduct';
                $typeIcon = '<i class="fas fa-minus-circle me-1"></i>';
            }

            $historyData[] = [
                'id' => $d->id,
                'item_name' => $d->item_name,
                'type' => $d->type,
                'type_display' => strtoupper($d->type),
                'type_class' => $typeClass,
                'type_icon' => $typeIcon,
                'qty' => $d->qty,
                'note' => $d->note ?? '-',
                'user_name' => $d->user_name ?? '-',
                'created_at' => date('d M Y', strtotime($d->created_at)),
                'created_raw' => \Carbon\Carbon::parse($d->created_at)->timestamp,
            ];
        }
    @endphp

    allHistoryData = @json($historyData);

    // Function to filter data based on search
    function filterData() {
        if (!searchTerm) return allHistoryData;

        const term = searchTerm.toLowerCase();
        return allHistoryData.filter(item =>
            item.item_name.toLowerCase().includes(term) ||
            item.type.toLowerCase().includes(term) ||
            (item.note && item.note.toLowerCase().includes(term)) ||
            item.user_name.toLowerCase().includes(term)
        );
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // Function to render table
    function renderTable() {
        const filtered = filterData();
        const totalEntries = filtered.length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);

        // Ensure current page is valid
        if (currentPage > totalPages) currentPage = totalPages || 1;

        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;
        const pageData = filtered.slice(start, end);

        // Render table body
        const tbody = document.getElementById('historyTableBody');
        if (!tbody) return;

        if (pageData.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="6" style="text-align: center; padding: 40px; color: #a0927e;">No movement data found</td></tr>';
        } else {
            tbody.innerHTML = pageData.map(item => `
                <tr>
                    <td><strong>${escapeHtml(item.item_name)}</strong></td>
                    <td class="text-center">
                        <span class="${item.type_class}">${item.type_icon}${item.type_display}</span>
                    </td>
                    <td class="text-center"><strong>${item.qty}</strong></td>
                    <td class="text-center">${escapeHtml(item.note)}</td>
                    <td class="text-center"><i class="fas fa-user-circle me-1"></i>${escapeHtml(item.user_name)}</td>
                    <td class="text-center">${escapeHtml(item.created_at)}</td>
                </tr>
            `).join('');
        }

        // Update info text
        const infoDiv = document.getElementById('tableInfo');
        if (infoDiv) {
            const startNum = totalEntries === 0 ? 0 : start + 1;
            const endNum = Math.min(end, totalEntries);
            infoDiv.innerHTML = `Showing ${startNum} to ${endNum} of ${totalEntries} movements`;
        }

        // Render pagination
        renderPagination(totalPages);
    }

    // Render pagination controls
    function renderPagination(totalPages) {
        const paginationDiv = document.getElementById('paginationControls');
        if (!paginationDiv) return;

        if (totalPages <= 1) {
            paginationDiv.innerHTML = '';
            return;
        }

        let html = '';

        // Previous button
        html += `<button class="paginate-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} style="background: transparent; border: 1px solid #644d3c; color: #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer; transition: all 0.3s;">
            ‹ Previous
        </button>`;

        // Page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);

        if (startPage > 1) {
            html +=
                `<button class="paginate-btn" onclick="changePage(1)" style="background: transparent; border: 1px solid #644d3c; color: #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer;">1</button>`;
            if (startPage > 2) html += `<span style="padding: 0 5px; color: #644d3c;">...</span>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            html +=
                `<button class="paginate-btn" onclick="changePage(${i})" ${i === currentPage ? 'style="background: #644d3c; color: #dfdac4; border: 1px solid #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer;"' : 'style="background: transparent; border: 1px solid #644d3c; color: #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer;"'}>${i}</button>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += `<span style="padding: 0 5px; color: #644d3c;">...</span>`;
            html +=
                `<button class="paginate-btn" onclick="changePage(${totalPages})" style="background: transparent; border: 1px solid #644d3c; color: #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer;">${totalPages}</button>`;
        }

        // Next button
        html += `<button class="paginate-btn" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} style="background: transparent; border: 1px solid #644d3c; color: #644d3c; border-radius: 30px; padding: 5px 12px; margin: 0 3px; cursor: pointer;">
            Next ›
        </button>`;

        paginationDiv.innerHTML = html;
    }

    // Change page
    function changePage(page) {
        const filtered = filterData();
        const totalPages = Math.ceil(filtered.length / entriesPerPage);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderTable();
    }

    // Initialize everything
    document.addEventListener('DOMContentLoaded', function() {
        // Set up search input
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                searchTerm = this.value;
                currentPage = 1;
                renderTable();
            });
        }

        // Set up entries per page
        const entriesSelect = document.getElementById('entriesPerPage');
        if (entriesSelect) {
            entriesSelect.addEventListener('change', function() {
                entriesPerPage = parseInt(this.value);
                currentPage = 1;
                renderTable();
            });
        }

        // Initial render
        renderTable();
    });

    // Auto hide alerts
    setTimeout(function() {
        let alert = document.getElementById('autoHideAlert');
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(function() {
                alert.remove();
            }, 500);
        }
    }, 5000);
</script>

@include('layout.footer')
