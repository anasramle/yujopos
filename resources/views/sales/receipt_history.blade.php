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

    /* Container */
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
    }

    .luxury-card:hover {
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.35);
    }

    /* Card Header Luxury - FIXED HEIGHT */
    .card-header-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border-bottom: 2px solid #644d3c;
        height: 60px;
        min-height: 60px;
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
        box-sizing: border-box;
    }

    .card-header-luxury h5 {
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
        line-height: 1.4;
    }

    .card-header-luxury i {
        margin-right: 8px;
        color: #dfdac4;
    }

    /* Card Body - Standard padding */
    .luxury-card .card-body {
        flex: 1;
        padding: 1.5rem !important;
        background: #dfdac4;
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

    /* Receipt List Box */
    .receipt-list-box {
        width: 100%;
        max-width: 100%;
        background: #dfdac4;
        padding: 0;
        border: 1px solid #644d3c;
        border-radius: 20px ;
        font-family: 'Poppins', 'Segoe UI', monospace;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        max-height: 450px;
        overflow-y: auto;
        margin: 0 auto;
        text-align: center;
    }

    .receipt-list-box::-webkit-scrollbar {
        width: 5px;
    }

    .receipt-list-box::-webkit-scrollbar-track {
        background: #c9c2ae;
        border-radius: 10px;
    }

    .receipt-list-box::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    /* Receipt Item */
    .receipt-item {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 16px;
        margin: 10px;
        padding: 14px 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .receipt-item:hover {
        background: #efe9d0;
        border-color: #644d3c;
        transform: translateX(5px);
    }

    .receipt-active {
        background: #e0dac0 !important;
        border-left: 4px solid #644d3c !important;
        border-color: #644d3c !important;
    }

    .receipt-item strong {
        color: #644d3c;
        font-size: 15px;
    }

    .receipt-item small {
        color: #a0927e;
        font-size: 11px;
    }

    .receipt-item .float-end {
        color: #644d3c;
        font-weight: 600;
    }

    .receipt-preview-box {
        height: 520px;
        background: #dfdac4;
        border: 1px solid #62643c;
        border-radius: 24px;
        overflow: hidden;
    }

    #receiptPreview {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .receipt-box {
        width: 100%;
        max-width: 380px;
        background: #ffffff;
        padding: 16px 20px;
        border-radius: 20px;
        font-family: 'Poppins', 'Segoe UI', monospace;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        max-height: 500px;
        overflow-y: auto;
        margin: 0 auto;
        text-align: center;
    }

    .receipt-box::-webkit-scrollbar {
        width: 4px;
    }

    .receipt-box::-webkit-scrollbar-track {
        background: #efe9d0;
        border-radius: 10px;
    }

    .receipt-box::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    .receipt-box hr {
        border: none;
        border-top: 2px dashed #644d3c;
        margin: 10px 0;
    }

    .receipt-title {
        text-align: center;
        font-weight: 700;
        font-size: 16px;
        color: #644d3c;
        letter-spacing: 1px;
        margin-bottom: 2px;
    }

    .receipt-title-sub {
        text-align: center;
        font-size: 9px;
        color: #a0927e;
        letter-spacing: 0.5px;
    }

    .receipt-total {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        color: #644d3c;
        margin: 4px 0;
    }

    .receipt-total-label {
        text-align: center;
        font-size: 9px;
        color: #a0927e;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .receipt-info {
        font-size: 11px;
        color: #5a4a3a;
        line-height: 1.5;
        text-align: left;
    }

    .receipt-info i {
        width: 20px;
        color: #644d3c;
        font-size: 10px;
    }

    .receipt-info-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
    }

    .receipt-items {
        text-align: left;
        margin: 10px 0;
    }

    .receipt-item-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .receipt-item-row small {
        display: block;
        color: #a0927e;
        font-size: 9px;
    }

    .receipt-item-name {
        flex: 2;
        text-align: left;
    }

    .receipt-item-price {
        font-weight: 500;
        text-align: right;
    }

    .receipt-table {
        width: 100%;
        font-size: 11px;
        border-collapse: collapse;
        margin: 6px 0;
    }

    .receipt-table td {
        padding: 4px 0;
    }

    .receipt-table td:first-child {
        text-align: left;
    }

    .receipt-table td:last-child {
        text-align: right;
    }

    .receipt-table tr:last-child td {
        padding-top: 6px;
        font-weight: 700;
    }

    .btn-resend {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border: none;
        border-radius: 40px;
        padding: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 4px;
    }

    .btn-resend:hover {
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
        transform: translateY(-2px);
        color: #dfdac4;
    }

    .receipt-footer {
        text-align: center;
        font-size: 9px;
        color: #a0927e;
        margin-top: 10px;
        letter-spacing: 0.5px;
    }

    .filter-section {
        padding: 0 0 12px 0;
        border-bottom: 1px solid #c9c2ae;
        margin-bottom: 16px;
    }

    .form-luxury-search {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 40px;
        padding: 10px 18px;
        color: #644d3c;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .form-luxury-search:focus {
        outline: none;
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgba(100, 77, 60, 0.2);
        background: #f5f0e0;
    }

    .dropdown-luxury {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .dropbtn-luxury {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 40px;
        padding: 10px 20px;
        color: #644d3c;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: space-between;
    }

    .dropbtn-luxury:hover {
        background: #efe9d0;
    }

    .dropdown-content-luxury {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        z-index: 100;
        margin-top: 8px;
    }

    .dropdown-content-luxury a {
        color: #644d3c;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
        font-size: 13px;
        transition: all 0.2s ease;
        border-radius: 12px;
        margin: 4px 6px;
    }

    .dropdown-content-luxury a:hover {
        background: #c9c2ae;
    }

    .dropdown-luxury.show .dropdown-content-luxury {
        display: block;
    }

    .modal-luxury .modal-content {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 24px;
    }

    .modal-luxury .modal-header {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border-bottom: 2px solid #644d3c;
        border-radius: 23px 23px 0 0;
    }

    .modal-luxury .modal-title {
        color: #dfdac4;
        font-weight: 600;
    }

    .modal-luxury .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-luxury .modal-footer {
        border-top: 1px solid #c9c2ae;
    }

    .form-luxury-modal {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 30px;
        padding: 12px 16px;
        color: #644d3c;
        width: 100%;
    }

    .form-luxury-modal:focus {
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgba(100, 77, 60, 0.2);
        outline: none;
        background: #f5f0e0;
    }

    .btn-modal-secondary {
        background: #c9c2ae;
        color: #644d3c;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 600;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #a0927e;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .receipt-item .fw-bold {
        color: #644d3c !important;
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

        .card-header-luxury {
            height: 60px;
            min-height: 60px;
            padding: 0 1rem;
        }

        .card-header-luxury h5 {
            font-size: 1rem;
        }

        .luxury-card .card-body {
            padding: 1rem !important;
        }

        .receipt-list-box {
            max-height: 400px;
        }

        .receipt-preview-box {
            height: 420px;
        }

        .receipt-box {
            max-height: 380px;
            padding: 10px 12px;
            max-width: 250px;
        }

        .page-title-luxury {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .dropbtn-luxury {
            padding: 8px 12px;
            font-size: 12px;
        }

        .form-luxury-search {
            padding: 8px 16px;
            font-size: 12px;
        }

        .receipt-title {
            font-size: 14px;
        }

        .receipt-total {
            font-size: 22px;
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

        .receipt-list-box {
            max-height: 460px;
        }

        .receipt-preview-box {
            height: 460px;
        }
        .receipt-box {
            max-height: 430px;
            padding: 10px 12px;
            max-width: 550px;
        }

        .page-title-luxury {
            font-size: 1.5rem;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 luxury-container">

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title-luxury">Receipt History</h1>
            </div>

            <!-- Receipt List & Preview -->
            <div class="row g-4">
                <!-- LEFT: Receipt List -->
                <div class="col-lg-6">
                    <div class="luxury-card h-100">
                        <div class="card-header-luxury">
                            <h5><i class="fas fa-list-ul me-2"></i>Receipts</h5>
                        </div>
                        <div class="card-body">
                            <!-- Search & Filter Bar -->
                            <div class="filter-section">
                                <div class="row g-2">
                                    <div class="col-7">
                                        <div class="position-relative">
                                            <i class="fas fa-search"
                                                style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #a0927e; font-size: 14px;"></i>
                                            <input type="text" id="searchReceipt" class="form-luxury-search"
                                                placeholder="Search receipt or cashier..." style="padding-left: 42px;">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="dropdown-luxury" id="dateDropdown">
                                            <button class="dropbtn-luxury" id="dateDropBtn">
                                                <span><i class="fas fa-calendar-alt me-1"></i>All</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-content-luxury">
                                                <a href="#" data-value="all"><i class="fas fa-list me-2"></i>All</a>
                                                <a href="#" data-value="today"><i class="fas fa-sun me-2"></i>Today</a>
                                                <a href="#" data-value="yesterday"><i class="fas fa-cloud me-2"></i>Yesterday</a>
                                                <a href="#" data-value="week"><i class="fas fa-calendar-week me-2"></i>This Week</a>
                                                <a href="#" data-value="month"><i class="fas fa-calendar-alt me-2"></i>This Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Receipt List -->
                            <div class="receipt-list-box" id="receiptList">
                                @forelse ($sales as $sale)
                                    <a href="#" class="receipt-item" data-id="{{ $sale->id }}"
                                        data-date="{{ $sale->created_at }}"
                                        data-receipt="INV-{{ date('Y') }}-{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}"
                                        data-cashier="{{ $sale->cashier ?? '' }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>
                                                    <i class="fas fa-receipt me-1"></i>
                                                    INV-{{ date('Y') }}-{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
                                                </strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <span class="fw-bold">RM{{ number_format($sale->total, 2) }}</span>
                                                <br>
                                                <small>
                                                    <i class="fas fa-user me-1"></i>{{ $sale->cashier ?? 'N/A' }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="empty-state">
                                        <i class="fas fa-receipt"></i>
                                        <p>No receipts found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Receipt Preview -->
                <div class="col-lg-6">
                    <div class="luxury-card h-100">
                        <div class="card-header-luxury">
                            <h5><i class="fas fa-eye me-2"></i>Receipt Preview</h5>
                        </div>
                        <div class="card-body">
                            <div class="receipt-preview-box">
                                <div id="receiptPreview">
                                    <div class="empty-state">
                                        <i class="fas fa-hand-pointer"></i>
                                        <p>Select a receipt to view details</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- RESEND MODAL -->
<div class="modal fade modal-luxury" id="resendModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-paper-plane me-2"></i>Send Receipt
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none; font-size: 20px; color: #dfdac4; cursor: pointer; opacity: 0.8;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="resendForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-envelope me-1"></i>Customer Email
                        </label>
                        <input type="email" id="resendEmail" name="email" class="form-luxury-modal"
                            placeholder="customer@example.com" required>
                        <input type="hidden" id="resendSaleId">
                    </div>
                    <div class="alert alert-info"
                        style="background: #efe9d0; border: none; border-radius: 16px; color: #644d3c; font-size: 12px;">
                        <i class="fas fa-info-circle me-1"></i> Receipt will be sent instantly to the customer's email.
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center; gap: 10px;">
                    <button type="submit" class="btn-luxury w-100" id="sendReceiptBtn">
                        <i class="fas fa-paper-plane me-1"></i>Send Receipt
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentSaleId = {{ $sales->first()->id ?? 'null' }};
    let currentSaleTotal = 0;
    let currentSaleItems = [];
    let currentSalePaid = 0;
    let currentSaleChange = 0;
    let currentSaleCash = 0;
    let currentSaleCard = 0;

    // Load receipt by ID
    function loadReceipt(id) {
        if (!id || id === 'null') {
            document.getElementById("receiptPreview").innerHTML =
                '<div class="empty-state"><i class="fas fa-hand-pointer"></i><p>No receipt selected.</p></div>';
            return;
        }

        highlightReceipt(id);

        fetch("/receipt/" + id)
            .then(res => {
                if (!res.ok) throw new Error("Network response was not OK");
                return res.json();
            })
            .then(data => {
                if (!data.sale) {
                    document.getElementById("receiptPreview").innerHTML =
                        '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>Receipt not found</p></div>';
                    return;
                }

                currentSaleTotal = data.sale.total;
                currentSaleItems = data.items || [];
                currentSalePaid = data.sale.paid || data.sale.total;
                currentSaleChange = data.sale.change_amount || data.sale.change || 0;
                currentSaleCash = data.sale.cash || 0;
                currentSaleCard = data.sale.card || 0;

                let receiptNumber = `INV-${new Date().getFullYear()}-${String(data.sale.id).padStart(6, "0")}`;
                let formattedDate = formatDate(data.sale.created_at);
                let companyName = data.sale.company_name || 'YOUR STORE';

                let html = `
                    <div class="receipt-box">
                        <div class="receipt-title">${escapeHtml(companyName)}</div>
                        <div class="receipt-title-sub">Official Receipt</div>

                        <hr>

                        <div class="receipt-total">RM${parseFloat(data.sale.total ?? 0).toFixed(2)}</div>
                        <div class="receipt-total-label">Total Amount</div>

                        <hr>

                        <div class="receipt-info">
                            <div class="receipt-info-row"><i class="fas fa-receipt"></i> <span>${receiptNumber}</span></div>
                            <div class="receipt-info-row"><i class="far fa-calendar-alt"></i> <span>${formattedDate}</span></div>
                            <div class="receipt-info-row"><i class="fas fa-user-circle"></i> <span>Cashier: ${escapeHtml(data.sale.cashier || 'N/A')}</span></div>
                            <div class="receipt-info-row"><i class="fas fa-store"></i> <span>${escapeHtml(data.sale.branch_name || 'Main Branch')}</span></div>
                        </div>

                        <hr>

                        <div class="receipt-items">
                `;

                if (data.items && data.items.length > 0) {
                    data.items.forEach(i => {
                        let itemName = escapeHtml(i.item_name);
                        let qty = i.qty;
                        let price = parseFloat(i.price).toFixed(2);
                        let subtotal = (i.qty * i.price).toFixed(2);
                        html += `
                            <div class="receipt-item-row">
                                <div class="receipt-item-name">
                                    ${itemName}
                                    <small>${qty} x RM${price}</small>
                                </div>
                                <div class="receipt-item-price">
                                    RM${subtotal}
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html += `<div class="text-center py-2 text-muted">No items in this receipt</div>`;
                }

                html += `
                        </div>

                        <hr>

                        <table class="receipt-table">
                            <tr>
                                <td><strong>Subtotal</strong></td>
                                <td>
                                    <strong>
                                        RM${parseFloat(data.sale.total ?? 0).toFixed(2)}
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td>Cash</td>
                                <td>
                                    RM${parseFloat(currentSaleCash).toFixed(2)}
                                </td>
                            </tr>

                            <tr>
                                <td>Card</td>
                                <td>
                                    RM${parseFloat(currentSaleCard).toFixed(2)}
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Change</strong></td>
                                <td>
                                    <strong>
                                        RM${parseFloat(currentSaleChange).toFixed(2)}
                                    </strong>
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <button class="btn-resend" onclick="openResendModal()">
                            <i class="fas fa-envelope me-2"></i>
                            SEND
                        </button>

                        <div class="receipt-footer">
                            Thank you for your purchase!
                        </div>
                    </div>
                `;

                document.getElementById("receiptPreview").innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                document.getElementById("receiptPreview").innerHTML =
                    '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>Error loading receipt</p></div>';
            });
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

    function highlightReceipt(id) {
        document.querySelectorAll(".receipt-item").forEach(i => {
            i.classList.remove("receipt-active");
            if (i.dataset.id == id) {
                i.classList.add("receipt-active");
            }
        });
    }

    document.querySelectorAll(".receipt-item").forEach(item => {
        item.addEventListener("click", function(e) {
            e.preventDefault();
            let id = this.dataset.id;
            if (id) {
                currentSaleId = id;
                loadReceipt(id);
            }
        });
    });

    if (currentSaleId && currentSaleId !== 'null') {
        loadReceipt(currentSaleId);
    }

    // Search functionality
    document.getElementById("searchReceipt").addEventListener("keyup", function() {
        let keyword = this.value.toLowerCase();
        document.querySelectorAll(".receipt-item").forEach(item => {
            let receipt = (item.dataset.receipt || '').toLowerCase();
            let cashier = (item.dataset.cashier || '').toLowerCase();
            let shouldShow = receipt.includes(keyword) || cashier.includes(keyword);
            item.style.display = shouldShow ? "block" : "none";
        });
    });

    // Date Dropdown
    const dateDropBtn = document.getElementById('dateDropBtn');
    const dateDropdown = document.getElementById('dateDropdown');

    if (dateDropBtn) {
        dateDropBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dateDropdown.classList.toggle('show');
        });
    }

    document.addEventListener('click', function(e) {
        if (dateDropdown && !dateDropdown.contains(e.target)) {
            dateDropdown.classList.remove('show');
        }
    });

    document.querySelectorAll('#dateDropdown .dropdown-content-luxury a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const filterValue = this.dataset.value;
            const buttonText = this.innerText.trim();

            if (dateDropBtn) {
                dateDropBtn.innerHTML = `<span><i class="fas fa-calendar-alt me-1"></i>${buttonText}</span> <i class="fas fa-chevron-down"></i>`;
            }

            if (dateDropdown) {
                dateDropdown.classList.remove('show');
            }

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            document.querySelectorAll(".receipt-item").forEach(item => {
                let dateStr = item.dataset.date;
                if (!dateStr) {
                    item.style.display = "block";
                    return;
                }

                let date = new Date(dateStr);
                date.setHours(0, 0, 0, 0);
                let show = true;

                if (filterValue === "today") {
                    show = date.getTime() === today.getTime();
                } else if (filterValue === "yesterday") {
                    let yesterday = new Date(today);
                    yesterday.setDate(today.getDate() - 1);
                    show = date.getTime() === yesterday.getTime();
                } else if (filterValue === "week") {
                    let weekAgo = new Date(today);
                    weekAgo.setDate(today.getDate() - 7);
                    show = date >= weekAgo;
                } else if (filterValue === "month") {
                    show = date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear();
                } else {
                    show = true;
                }

                item.style.display = show ? "block" : "none";
            });
        });
    });

    function openResendModal() {
        if (!currentSaleId || currentSaleId === 'null') {
            return;
        }
        document.getElementById("resendSaleId").value = currentSaleId;
        document.getElementById("resendEmail").value = "";

        let btn = document.getElementById("sendReceiptBtn");
        if (btn) {
            btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Send Receipt';
            btn.disabled = false;
        }

        let modal = new bootstrap.Modal(document.getElementById("resendModal"));
        modal.show();
    }

    document.getElementById("resendForm").addEventListener("submit", function(e) {
        e.preventDefault();

        let emailInput = document.getElementById("resendEmail");
        if (!emailInput.checkValidity()) {
            emailInput.reportValidity();
            return;
        }

        let email = emailInput.value;
        let saleId = document.getElementById("resendSaleId").value;
        let sendBtn = document.getElementById("sendReceiptBtn");

        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
        sendBtn.style.opacity = "0.8";

        let sendData = {
            email: email,
            saleId: saleId,
            items: currentSaleItems,
            total: currentSaleTotal,
            paid: currentSalePaid,
            change: currentSaleChange,
            cash: currentSaleCash,
            card: currentSaleCard
        };

        fetch("/receipt/send", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(sendData)
            })
            .then(res => res.json())
            .then(data => {
                sendBtn.innerHTML = '<i class="fas fa-check me-1"></i>Sent!';
                sendBtn.disabled = true;
                sendBtn.style.background = "linear-gradient(135deg, #644d3c 0%, #4a3629 100%)";
                sendBtn.style.opacity = "1";

                setTimeout(() => {
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Send Receipt';
                    sendBtn.disabled = false;
                    emailInput.value = "";
                    let modalEl = document.getElementById("resendModal");
                    let modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                }, 2000);
            })
            .catch(err => {
                console.error(err);
                sendBtn.innerHTML = '<i class="fas fa-exclamation me-1"></i>Failed!';
                setTimeout(() => {
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Send Receipt';
                    sendBtn.disabled = false;
                }, 2000);
            });
    });

    function formatDate(dateString) {
        let d = new Date(dateString);
        let day = String(d.getDate()).padStart(2, '0');
        let month = String(d.getMonth() + 1).padStart(2, '0');
        let year = d.getFullYear();
        let hours = String(d.getHours()).padStart(2, '0');
        let minutes = String(d.getMinutes()).padStart(2, '0');
        return `${day}/${month}/${year} ${hours}:${minutes}`;
    }
</script>

@include('layout.footer')
