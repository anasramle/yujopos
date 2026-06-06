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
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3);
        color: #dfdac4;
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
    }

    .btn-add-luxury,
    .btn-deduct-luxury {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 75px;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: center;
        white-space: nowrap;
        /* width: 100%; */
    }

    .btn-add-luxury {
        background: transparent;
        border: 1px solid #27ae60;
        color: #27ae60;
    }

    .btn-add-luxury:hover {
        background: #27ae60;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-deduct-luxury {
        background: transparent;
        border: 1px solid #e67e22;
        color: #e67e22;
    }

    .btn-deduct-luxury:hover {
        background: #e67e22;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Status Badges */
    .badge-outstock,
.badge-critical,
.badge-lowstock,
.badge-goodstock {
    background: #c0392b;
    color: #fff;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
    min-width: 120px;
    text-align: center;
}

.badge-outstock {
    background: #e74c3c30;
        color: #c0392b;
        border: 1px solid #c0392b;
}

.badge-critical {
    background: #e67d222c;
        color: #e67e22;
        border: 1px solid #e67e22;
}

.badge-lowstock {
    background: #f3b04334;
    color: #e79a1f;
        border: 1px solid #f1a833;
}

.badge-goodstock {
    background: #b5c3bb30;
        color: #27ae60;
        border: 1px solid #27ae60;
}

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

    /* Modal Luxury */
    .modal-luxury .modal-content {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .modal-luxury .modal-header {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border-bottom: 2px solid #644d3c;
        border-radius: 23px 23px 0 0;
        padding: 1rem 1.5rem;
    }

    .modal-luxury .modal-title {
        color: #dfdac4;
        font-weight: 600;
    }

    .modal-luxury .btn-close-custom {
        background: none;
        border: none;
        font-size: 20px;
        color: #dfdac4;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .modal-luxury .btn-close-custom:hover {
        opacity: 0.8;
    }

    .modal-luxury .modal-body {
        padding: 1.5rem;
    }

    .modal-luxury .modal-footer {
        border-top: 1px solid #c9c2ae;
        padding: 1rem 1.5rem;
        justify-content: center;
    }

    /* Form Luxury */
    .form-luxury {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 30px;
        padding: 8px 16px;
        color: #644d3c;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-luxury:focus {
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgb(157, 134, 124);
        outline: none;
        background: #f5f0e0;
    }

    .form-luxury:disabled {
        background: #c9c2ae;
        opacity: 0.7;
    }

    label {
        font-weight: 600;
        color: #644d3c;
        margin-bottom: 6px;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 1rem;
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

    /* Action buttons container */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Image thumbnail */
    .item-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #644d3c;
        background: #f5f0e0;
    }

    /* Quantity display */
    .quantity-badge {
        font-weight: 700;
        font-size: 16px;
        color: #644d3c;
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

        .btn-add-luxury,
        .btn-deduct-luxury {
            padding: 4px 12px;
            font-size: 10px;
            gap: 4px;
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

        .item-image {
            width: 35px;
            height: 35px;
        }

        .action-buttons {
            gap: 4px;
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
         .form-group {
            margin-bottom: 0.2rem;
        }

        .modal-luxury .modal-body {
            padding: 1rem 1.5rem;
        }
    }
</style>

@php
    $user = Auth::user();
@endphp

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 luxury-container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title-luxury">Inventory Management</h1>
                <a href="{{ route('inventory.history') }}" class="btn btn-luxury">
                    <i class="fas fa-clock me-2"></i>Stock History
                </a>
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

            @if ($errors->any())
                <div class="alert alert-custom mb-3" id="autoHideAlert">
                    <i class="fas fa-times-circle me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Inventory Table Card -->
            <div class="luxury-card">
                <div class="card-header-luxury">
                    <h5><i class="fas fa-boxes"></i> All Inventory Items</h5>
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
                        <table id="inventoryTable" class="table datatable-table" style="width: 100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-box me-1"></i>Item Name</th>
                                    <th class="text-center"><i class="fas fa-image me-1"></i>Image</th>
                                    <th class="text-center"><i class="fas fa-cubes me-1"></i>Quantity</th>
                                    <th class="text-center"><i class="fas fa-chart-line me-1"></i>Status</th>
                                    <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTableBody">
                                @foreach ($items as $r)
                                    <tr>
                                        <td><strong>{{ $r->item_name }}</strong></td>
                                        <td class="text-center">
                                            @if ($r->img)
                                                <img src="{{ asset($r->img) }}" class="item-image"
                                                    alt="{{ $r->item_name }}">
                                            @else
                                                <div
                                                    style="width: 50px; height: 50px; background: #c9c2ae; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #644d3c;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $r->qty }}</td>

                                        <td class="text-center">
                                            @if ($r->qty == 0)
                                                <span class="badge-outstock"><i class="fas fa-ban me-1"></i>OUT OF
                                                    STOCK</span>
                                            @elseif ($r->qty <= 2)
                                                <span class="badge-critical"><i
                                                        class="fas fa-exclamation-triangle me-1"></i>CRITICAL</span>
                                            @elseif ($r->qty <= 5)
                                                <span class="badge-lowstock"><i
                                                        class="fas fa-exclamation-circle me-1"></i>LOW</span>
                                            @else
                                                <span class="badge-goodstock"><i
                                                        class="fas fa-check-circle me-1"></i>GOOD</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <button class="btn-add-luxury" data-bs-toggle="modal"
                                                    data-bs-target="#addModal{{ $r->id }}">
                                                    <i class="fas fa-plus-circle"></i> Add
                                                </button>
                                                <button class="btn-deduct-luxury" data-bs-toggle="modal"
                                                    data-bs-target="#deductModal{{ $r->id }}">
                                                    <i class="fas fa-minus-circle"></i> Deduct
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
        </div>
    </main>
</div>

@foreach ($items as $r)
    <!-- ADD MODAL -->
    <div class="modal fade modal-luxury" id="addModal{{ $r->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('inventory.add', $r->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle me-2"></i>Add Stock
                        </h5>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><i class="fas fa-box me-1"></i> Item Name</label>
                            <input type="text" class="form-luxury" value="{{ $r->item_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-cubes me-1"></i> Current Quantity</label>
                            <input type="text" class="form-luxury" value="{{ $r->qty }}" disabled>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-plus-circle me-1"></i> Quantity to Add</label>
                            <input type="number" name="qty" class="form-luxury" placeholder="Enter quantity"
                                required min="1">
                        </div>
                    </div>
                    <div class="modal-footer"
                        style="justify-content: center; border-top: 1px solid #c9c2ae; padding: 1rem 1.5rem;">
                        <button type="submit" class="btn-luxury w-100">
                            <i class="fas fa-save me-1"></i>Add Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DEDUCT MODAL -->
    <div class="modal fade modal-luxury" id="deductModal{{ $r->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('inventory.deduct', $r->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-minus-circle me-2"></i>Deduct Stock
                        </h5>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><i class="fas fa-box me-1"></i> Item Name</label>
                            <input type="text" class="form-luxury" value="{{ $r->item_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-cubes me-1"></i> Current Quantity</label>
                            <input type="text" class="form-luxury" value="{{ $r->qty }}" disabled>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-minus-circle me-1"></i> Quantity to Deduct</label>
                            <input type="number" name="qty" class="form-luxury" placeholder="Enter quantity"
                                required min="1" max="{{ $r->qty }}">
                        </div>
                        @if ($r->qty == 0)
                            <div class="alert alert-custom mt-2"
                                style="background: #c0392b20; color: #c0392b; border-left-color: #c0392b;">
                                <i class="fas fa-exclamation-triangle me-2"></i>Cannot deduct from out of stock item.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer"
                        style="justify-content: center; border-top: 1px solid #c9c2ae; padding: 1rem 1.5rem;">
                        <button type="submit" class="btn-luxury w-100">
                            <i class="fas fa-save me-1"></i>Deduct Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    let allInventoryData = [];
    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    @php
        $inventoryData = [];
        foreach ($items as $r) {
            $status = '';
            if ($r->qty == 0) {
                $status = 'OUT OF STOCK';
            } elseif ($r->qty <= 2) {
                $status = 'CRITICAL';
            } elseif ($r->qty <= 5) {
                $status = 'LOW';
            } else {
                $status = 'GOOD';
            }

            $statusClass = '';
            if ($r->qty == 0) {
                $statusClass = 'badge-outstock';
            } elseif ($r->qty <= 2) {
                $statusClass = 'badge-critical';
            } elseif ($r->qty <= 5) {
                $statusClass = 'badge-lowstock';
            } else {
                $statusClass = 'badge-goodstock';
            }

            $statusIcon = '';
            if ($r->qty == 0) {
                $statusIcon = '<i class="fas fa-ban me-1"></i>';
            } elseif ($r->qty <= 2) {
                $statusIcon = '<i class="fas fa-exclamation-triangle me-1"></i>';
            } elseif ($r->qty <= 5) {
                $statusIcon = '<i class="fas fa-exclamation-circle me-1"></i>';
            } else {
                $statusIcon = '<i class="fas fa-check-circle me-1"></i>';
            }

            $inventoryData[] = [
                'id' => $r->id,
                'name' => $r->item_name,
                'img' => $r->img ? asset($r->img) : null,
                'qty' => $r->qty,
                'status' => $status,
                'statusClass' => $statusClass,
                'statusIcon' => $statusIcon,
            ];
        }
    @endphp

    allInventoryData = @json($inventoryData);

    // Function to filter data based on search
    function filterData() {
        if (!searchTerm) return allInventoryData;

        const term = searchTerm.toLowerCase();
        return allInventoryData.filter(item =>
            item.name.toLowerCase().includes(term)
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
        const tbody = document.getElementById('inventoryTableBody');
        if (!tbody) return;

        if (pageData.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="7" style="text-align: center; padding: 40px; color: #a0927e;">No inventory items found</td></tr>';
        } else {
            tbody.innerHTML = pageData.map(item => `
                <tr>
                    <td><strong>${escapeHtml(item.name)}</strong></td>
                    <td class="text-center">
                        ${item.img ? `<img src="${escapeHtml(item.img)}" class="item-image" alt="${escapeHtml(item.name)}">` :
                        `<div style="width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="color: #644d3c;"></i>
                        </div>`}
                    </td>
                    <td class="text-center" style="font-weight: bold;' : ''}">${item.qty}</td>
                    <td class="text-center">
                        <span class="${item.statusClass}">${item.statusIcon}${item.status}</span>
                    </td>
                    <td  class="text-center">
                        <div class="action-buttons">
                            <button class="btn-add-luxury" data-bs-toggle="modal" data-bs-target="#addModal${item.id}">
                                <i class="fas fa-plus-circle"></i> Add
                            </button>
                            <button class="btn-deduct-luxury" data-bs-toggle="modal" data-bs-target="#deductModal${item.id}" ${item.qty === 0 ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : ''}>
                                <i class="fas fa-minus-circle"></i> Deduct
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Update info text
        const infoDiv = document.getElementById('tableInfo');
        if (infoDiv) {
            const startNum = totalEntries === 0 ? 0 : start + 1;
            const endNum = Math.min(end, totalEntries);
            infoDiv.innerHTML = `Showing ${startNum} to ${endNum} of ${totalEntries} items`;
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
