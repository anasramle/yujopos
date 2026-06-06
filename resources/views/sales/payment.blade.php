@include('layout.header')

<style>
    body {
        background: #dfdac4;
        color: #644d3c;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        overflow: hidden;
        height: 100vh;
    }

    #layoutSidenav_content {
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .payment-container {
        display: flex;
        flex: 1;
        overflow: hidden;
        height: calc(100vh - 56px);
        gap: 0;
    }

    .order-summary {
        flex: 0.4;
        padding: 10px 20px 70px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #dfdac4;
    }

    .summary-card {
        background: #c9c2ae;
        border-radius: 24px;
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
        border: 1px solid #644d3c20;
    }

    .summary-header {
        border-bottom: 2px solid #644d3c;
        padding-bottom: 12px;
        margin-bottom: 12px;
        flex-shrink: 0;
    }

    .summary-header h2 {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #4a3629;
    }

    .summary-header h2 i {
        color: #644d3c;
    }

    .order-items-scroll {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 12px;
        padding-right: 8px;
    }

    .order-items-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .order-items-scroll::-webkit-scrollbar-track {
        background: #b8b3a1;
        border-radius: 10px;
    }

    .order-items-scroll::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #b8b3a1;
    }

    .order-item-row:last-child {
        border-bottom: none;
    }

    .order-item-info {
        flex: 1;
    }

    .order-item-name {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 2px;
    }

    .order-item-meta {
        font-size: 11px;
        opacity: 0.8;
    }

    .order-item-price {
        font-weight: 700;
        font-size: 13px;
        color: #4a3629;
    }

    .summary-total {
        border-top: 2px solid #644d3c;
        padding-top: 12px;
        margin-top: auto;
        flex-shrink: 0;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .total-label {
        font-size: 16px;
        font-weight: 600;
    }

    .total-amount {
        font-size: 24px;
        font-weight: 800;
        color: #4a3629;
    }

    .payment-panel {
        flex: 0.6;
        width: auto;
        padding: 10px 20px 70px;
        border-left: 2px solid #644d3c;
        background: #dfdac4;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .payment-card {
        background: #c9c2ae;
        border-radius: 24px;
        padding: 20px;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
        border: 1px solid #644d3c20;
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .amount-due {
        text-align: center;
        margin-bottom: 16px;
        position: relative;
        flex-shrink: 0;
    }

    .amount-due-label {
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .amount-due-value {
        font-size: 44px;
        font-weight: 800;
        color: #4a3629;
        line-height: 1;
    }

    .back-btn {
        position: absolute;
        left: 0;
        top: 10%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #644d3c;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .back-btn:hover {
        background: #644d3c20;
        transform: translateY(-50%) scale(1.05);
    }

    /* Form Elements */
    .form-luxury-payment {
        background: #dfdac4;
        border: 1.5px solid #644d3c;
        border-radius: 60px;
        padding: 10px 16px;
        color: #644d3c;
        font-size: 16px;
        font-weight: 500;
        text-align: center;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-luxury-payment:focus {
        outline: none;
        border-color: #4a3629;
        box-shadow: 0 0 0 3px rgba(100, 77, 60, 0.2);
        background: #efe9d0;
    }

    .quick-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin: 12px 0;
        flex-wrap: wrap;
        flex-shrink: 0;
    }

    .quick-cash-btn {
        background: #dfdac4;
        border: 1.5px solid #644d3c;
        color: #644d3c;
        padding: 6px 18px;
        border-radius: 60px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .quick-cash-btn:hover {
        background: #644d3c;
        color: #dfdac4;
        transform: translateY(-2px);
    }

    .card-payment-btn {
        background: #dfdac4;
        border: 1.5px solid #644d3c;
        color: #644d3c;
        padding: 10px;
        border-radius: 60px;
        font-weight: 700;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
        margin: 10px 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .card-payment-btn:hover {
        background: #644d3c;
        color: #dfdac4;
        transform: translateY(-2px);
    }

    /* Change Display */
    .change-section {
        margin-top: auto;
        padding-top: 6px;
        border-top: 1px solid #b8b3a1;
        flex-shrink: 0;
    }

    .change-label {
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        margin-bottom: 6px;
        letter-spacing: 1px;
    }

    .change-value {
        font-size: 28px;
        font-weight: 800;
        text-align: center;
        color: #4a3629;
    }

    .change-value.insufficient {
        color: #c0392b;
    }

    /* Charge Button */
    .charge-btn {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border: none;
        padding: 12px;
        border-radius: 60px;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: 2px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 12px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .charge-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.35);
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
    }

    .charge-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .success-screen {
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow-y: auto;
    }

    .paid-summary {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin: 0 0 20px;
        padding: 16px;
        background: #dfdac4;
        border-radius: 20px;
        flex-shrink: 0;
    }

    .paid-item {
        text-align: center;
    }

    .paid-label {
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .paid-value {
        font-size: 24px;
        font-weight: 800;
        color: #4a3629;
    }

    .receipt-form {
        max-width: 400px;
        margin: 0 auto;
        width: 100%;
        flex-shrink: 0;
    }

    .receipt-input-group {
        display: flex;
        gap: 10px;
        align-items: stretch;
    }

    .receipt-input {
        flex: 1;
        background: #dfdac4;
        border: 1.5px solid #644d3c;
        border-radius: 60px;
        padding: 10px 16px;
        color: #644d3c;
        font-size: 13px;
    }

    .receipt-input:focus {
        outline: none;
        border-color: #4a3629;
    }

    .send-receipt-btn {
        background: #644d3c;
        border: none;
        color: #dfdac4;
        padding: 10px 20px;
        border-radius: 60px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        white-space: nowrap;
        font-size: 13px;
    }

    .send-receipt-btn:hover {
        background: #4a3629;
        transform: translateY(-1px);
    }

    .new-sale-btn {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border: none;
        padding: 12px;
        border-radius: 60px;
        font-weight: 700;
        font-size: 16px;
        width: 100%;
        margin-top: 260px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .new-sale-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.35);
        color: #dfdac4;
    }

    /* Scrollbar Styling */
    .order-items-scroll::-webkit-scrollbar,
    .success-screen::-webkit-scrollbar {
        width: 4px;
    }

    /* Mobile Responsive */
    @media (max-width: 500px) {
        .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
            padding-left: 225px;
            top: 56px;
        }

        .container-fluid.px-4 .mt-4 {
            margin-top: 0 !important;
        }

        #layoutSidenav_content {
            margin-top: 3px !important;
            height: 100vh;
        }

        .payment-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Order Summary - hidden on mobile */
        .order-summary {
            display: none;
        }

        .payment-panel {
            flex: 1;
            width: 100%;
            border: none;
            padding: 12px;
            padding-bottom: 70px;
            min-height: 100vh;
            height: auto;
            overflow-y: auto;
        }

        .payment-card {
            padding: 16px;
            min-height: auto;
            height: auto;
            display: flex;
            flex-direction: column;
        }

        /* Make content fill available space */
        #paymentForm {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .amount-due-value {
            font-size: 36px;
            margin: 20px;
        }

        .amount-due-label {
            font-size: 16px;
            margin: 20px
        }

        /* Quick buttons wrap nicely */
        .quick-buttons {
            gap: 8px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .quick-cash-btn {
            padding: 8px 16px;
            font-size: 13px;
            flex: 1;
            min-width: 80px;
            text-align: center;
        }

        /* Card payment button */
        .card-payment-btn {
            padding: 12px;
            font-size: 14px;
            margin: 8px 0;
        }

        .change-section {
            margin-top: auto;
            padding-top: 12px;
        }

        .change-value {
            font-size: 24px;
        }

        /* Pay button */
        .charge-btn {
            padding: 14px;
            font-size: 16px;
            margin-top: 16px;
        }

        /* Form input */
        .form-luxury-payment {
            padding: 12px 16px;
            font-size: 16px;
        }

        /* Back button */
        .back-btn {
            width: 32px;
            height: 32px;
            font-size: 18px;
        }

        /* Success screen on mobile */
        .success-screen {
            min-height: auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .paid-summary {
            gap: 20px;
            padding: 16px;
            margin: 0 0 30px;
        }

        .paid-value {
            font-size: 20px;
        }

        .receipt-input-group {
            flex-direction: column;
            gap: 10px;
        }

        .receipt-input {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
        }

        .send-receipt-btn {
            width: 100%;
            padding: 12px;
            font-size: 14px;
        }

        .new-sale-btn {
            padding: 14px;
            font-size: 16px;
            margin-top: auto;
        }
    }

   /* Tablet Responsive (501px - 950px) - OPTIMIZED */
@media (min-width: 501px) and (max-width: 950px) {
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

    .payment-container {
        flex-direction: row;
        height: calc(100vh - 60px);
    }

    /* LEFT SIDE - ORDER SUMMARY */
    .order-summary {
        flex: 0.35;
        padding: 20px 12px 70px;
    }

    .summary-card {
        padding: 12px;
    }

    .summary-header h2 {
        font-size: 1.1rem;
    }

    .order-item-row {
        padding: 4px 0;
    }

    .order-item-name {
        font-size: 11px;
    }

    .order-item-meta {
        font-size: 9px;
    }

    .order-item-price {
        font-size: 11px;
    }

    .total-label {
        font-size: 13px;
    }

    .total-amount {
        font-size: 18px;
    }

    .payment-panel {
        flex: 0.65;
        padding: 20px 12px 70px;
    }

    .payment-card {
        padding: 12px;
    }

    .amount-due {
        margin-bottom: 8px;
    }

    .amount-due-label {
        font-size: 10px;
        margin-bottom: 4px;
    }

    .amount-due-value {
        font-size: 32px;
    }

    .back-btn {
        width: 28px;
        height: 28px;
        font-size: 16px;
        top: 50%;
    }

    /* Cash Input */
    .form-luxury-payment {
        padding: 6px 12px;
        font-size: 14px;
    }

    .quick-buttons {
        gap: 6px;
        margin: 6px 0;
    }

    .quick-cash-btn {
        padding: 4px 10px;
        font-size: 10px;
        gap: 4px;
    }

    .quick-cash-btn i {
        font-size: 10px;
    }

    .card-payment-btn {
        padding: 6px;
        font-size: 12px;
        margin: 6px 0;
        gap: 6px;
    }

    .card-payment-btn i {
        font-size: 12px;
    }

    .change-section {
        margin-top: auto;
        padding-top: 6px;
    }

    .change-label {
        font-size: 10px;
        margin-bottom: 4px;
    }

    .change-value {
        font-size: 20px;
    }

    .charge-btn {
        padding: 8px;
        font-size: 14px;
        margin-top: 8px;
    }

    .success-screen {
        justify-content: flex-start;
    }

    .paid-summary {
        gap: 15px;
        padding: 10px;
        margin: 0 0 15px;
    }

    .paid-label {
        font-size: 10px;
    }

    .paid-value {
        font-size: 18px;
    }

    .paid-summary div[style*="border-left"] {
        height: 40px !important;
    }

    .receipt-form {
        max-width: 100%;
    }

    .receipt-input-group {
        gap: 8px;
    }

    .receipt-input {
        padding: 8px 12px;
        font-size: 12px;
    }

    .send-receipt-btn {
        padding: 8px 16px;
        font-size: 12px;
    }

    .new-sale-btn {
        padding: 10px;
        font-size: 14px;
        margin-top: auto;
    }
}

    @media (min-width: 951px) {

        .order-items-scroll::-webkit-scrollbar,
        .success-screen::-webkit-scrollbar {
            width: 6px;
        }
    }
</style>

<div id="layoutSidenav_content">
    <div class="payment-container" id="paymentContainer">
        <!-- LEFT SIDE - ORDER SUMMARY -->
        <div class="order-summary">
            <div class="summary-card">
                <div class="summary-header">
                    <h2>
                        <i class="fas fa-receipt"></i>
                        Order Summary
                    </h2>
                </div>

                <div class="order-items-scroll">
                    @foreach ($items as $item)
                        <div class="order-item-row">
                            <div class="order-item-info">
                                <div class="order-item-name">{{ $item['name'] }}</div>
                                <div class="order-item-meta">Qty: {{ $item['qty'] }}</div>
                            </div>
                            <div class="order-item-price">
                                RM{{ number_format($item['price'] * $item['qty'], 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="summary-total">
                    <div class="total-row">
                        <span class="total-label">Total Amount</span>
                        <span class="total-amount" id="summaryTotal">RM{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE - PAYMENT PANEL -->
        <div class="payment-panel" id="paymentPanel">
        </div>
    </div>
</div>

<script>
    let total = {{ $total }};
    let currentCash = total;
    let currentChange = 0;

    function formatRM(value) {
        return "RM" + parseFloat(value).toFixed(2);
    }

    function parseRM(value) {
        return parseFloat((value || "").toString().replace("RM", "")) || 0;
    }

    /* ===== RENDER PAYMENT UI ===== */
    function renderPaymentUI() {
        const panel = document.getElementById('paymentPanel');
        if (!panel) return;

        panel.innerHTML = `
            <div class="payment-card">
                <div class="amount-due">
                    <div class="amount-due-label">AMOUNT DUE</div>
                    <div class="amount-due-value" id="amountDue">${formatRM(total)}</div>
                    <button class="back-btn" onclick="window.location.href='/sales'">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>

                <form id="paymentForm" style="display: flex; flex-direction: column; flex: 1;">
                    <input type="hidden" name="items" value='@json($items)'>
                    <input type="hidden" name="total" value="{{ $total }}">

                    <!-- Cash Input -->
                    <input type="text" name="cash" id="cashInput" class="form-luxury-payment"
                        value="${formatRM(total)}" placeholder="Cash received">

                    <!-- Quick Cash Buttons -->
                    <div id="quickCashButtons" class="quick-buttons"></div>

                    <!-- Card Payment -->
                    <button type="button" class="card-payment-btn" onclick="payByCard()">
                        <i class="fas fa-credit-card"></i> Card / QR Pay
                    </button>

                    <!-- Change Display -->
                    <div class="change-section">
                        <div class="change-label">CHANGE</div>
                        <div class="change-value" id="changeValue">RM0.00</div>
                    </div>

                    <!-- Charge Button -->
                    <button type="submit" id="chargeBtn" class="charge-btn" disabled>
                        <i class="fas fa-credit-card me-2"></i>PAY NOW
                    </button>
                </form>
            </div>
        `;

        // Initialize after rendering
        initCashInput();
        generateQuickCash();
        attachFormListener();
    }

    let cashDigits = Math.round(total * 100);

    function initCashInput() {
        const cashInput = document.getElementById('cashInput');
        if (!cashInput) return;

        renderCashInput();

        cashInput.addEventListener('focus', moveCursorToEnd);
        cashInput.addEventListener('click', moveCursorToEnd);

        cashInput.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') return;
            e.preventDefault();

            if (e.key === 'Backspace') {
                cashDigits = Math.floor(cashDigits / 10);
                if (cashDigits < 0) cashDigits = 0;
                renderCashInput();
                return;
            }

            if (/^[0-9]$/.test(e.key)) {
                cashDigits = parseInt(cashDigits.toString() + e.key);
                renderCashInput();
            }
        });
    }

    function moveCursorToEnd() {
        requestAnimationFrame(() => {
            const input = document.getElementById('cashInput');
            if (input) {
                input.selectionStart = input.value.length;
                input.selectionEnd = input.value.length;
            }
        });
    }

    function renderCashInput() {
        const amount = cashDigits / 100;
        const input = document.getElementById('cashInput');
        if (input) {
            input.value = formatRM(amount);
            calculateChange(amount);
        }
    }

    /* ===== CHANGE CALCULATION ===== */
    function calculateChange(cash) {
        const change = cash - total;
        const changeEl = document.getElementById('changeValue');
        const chargeBtn = document.getElementById('chargeBtn');

        if (changeEl) {
            if (change >= 0) {
                changeEl.innerHTML = formatRM(change);
                changeEl.classList.remove('insufficient');
            } else {
                changeEl.innerHTML = 'Insufficient Cash';
                changeEl.classList.add('insufficient');
            }
        }

        if (chargeBtn) {
            chargeBtn.disabled = change < 0;
        }

        currentCash = cash;
        currentChange = change >= 0 ? change : 0;
    }

    /* ===== GENERATE QUICK CASH BUTTONS ===== */
    function generateQuickCash() {
        const buttons = [];

        const round5 = Math.ceil(total / 5) * 5;
        const round10 = Math.ceil(total / 10) * 10;

        if (round5 > total) buttons.push(round5);
        if (round10 > total && round10 !== round5) buttons.push(round10);

        const notes = [10, 20, 50, 100];
        notes.forEach(note => {
            if (note > total && !buttons.includes(note)) {
                buttons.push(note);
            }
        });

        buttons.sort((a, b) => a - b);
        const topButtons = buttons.slice(0, 3);

        renderQuickButtons(topButtons);
    }

    function renderQuickButtons(amounts) {
        const container = document.getElementById('quickCashButtons');
        if (!container) return;

        container.innerHTML = '';

        amounts.forEach(amount => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'quick-cash-btn';
            btn.innerHTML = `<i class="fas fa-money-bill-wave me-2"></i>${formatRM(amount)}`;
            btn.onclick = () => setCashAmount(amount);
            container.appendChild(btn);
        });
    }

    function setCashAmount(amount) {
        cashDigits = Math.round(amount * 100);
        renderCashInput();
    }

    /* ===== CARD PAYMENT ===== */
    function payByCard() {

        const form = document.getElementById('paymentForm');

        const cashInput = document.getElementById('cashInput');
        if (cashInput) {
            cashInput.value = formatRM(0);
        }

        cashDigits = 0;

        const changeEl = document.getElementById('changeValue');
        if (changeEl) {
            changeEl.innerHTML = 'RM0.00';
            changeEl.classList.remove('insufficient');
        }

        let cardInput = form.querySelector("input[name='card']");

        if (!cardInput) {
            cardInput = document.createElement('input');
            cardInput.type = 'hidden';
            cardInput.name = 'card';
            form.appendChild(cardInput);
        }

        cardInput.value = total;

        form.dispatchEvent(new Event('submit'));
    }
    /* ===== FORM SUBMIT HANDLER ===== */
    function attachFormListener() {
        const form = document.getElementById('paymentForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const cashInput = document.getElementById('cashInput');
            const cashValue = parseRM(cashInput?.value);

            const formData = new FormData();
            formData.append('card', form.querySelector("input[name='card']")?.value || 0);
            formData.append('items', form.querySelector("input[name='items']").value);
            formData.append('total', form.querySelector("input[name='total']").value);
            formData.append('cash', cashValue);

            fetch("{{ route('payment.process') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    // Clear cart from localStorage
                    const userId = "{{ auth()->id() }}";
                    const branchId = "{{ session('branch_id') ?? auth()->user()->branch_id }}";
                    localStorage.removeItem(`cart_${userId}_${branchId}`);
                    localStorage.removeItem('currentOrder');

                    // Store receipt data
                    window.lastItems = data.items;
                    window.lastTotal = data.total;
                    window.lastChange = data.change;
                    window.lastCash = data.cash;
                    window.lastCard = data.card;
                    window.lastPaid = data.paid;
                    window.lastSaleId = data.saleId;
                    window.lastReceiptNumber = data.receiptNumber;

                    // Show success screen
                    showSuccessScreen(data);
                });
        });
    }

    /* ===== SUCCESS SCREEN ===== */
    function showSuccessScreen(data) {
        const panel = document.getElementById('paymentPanel');
        if (!panel) return;

        panel.innerHTML = `
        <div class="payment-card success-screen">

            <div class="paid-summary">
                <div class="paid-item">
                    <div class="paid-label">TOTAL PAID</div>
                    <div class="paid-value">RM${parseFloat(data.paid || 0).toFixed(2)}</div>
                </div>
                <div style="border-left:2px solid #644d3c;height:60px;"></div>
                <div class="paid-item">
                    <div class="paid-label">CHANGE</div>
                    <div class="paid-value">RM${parseFloat(data.change || 0).toFixed(2)}</div>
                </div>
            </div>

            <div class="receipt-form">
                <form id="receiptForm">
                    <div class="receipt-input-group">
                        <input type="email" id="receiptEmail" name="email"
                            class="receipt-input" placeholder="Enter email to receive receipt" required>
                        <button type="submit" class="send-receipt-btn" id="sendReceiptBtn">
                            <i class="fas fa-envelope me-2"></i>SEND
                        </button>
                    </div>
                </form>
            </div>

            <a href="/sales" class="new-sale-btn" onclick="localStorage.removeItem('currentOrder')">
                <i class="fas fa-plus-circle me-2"></i>NEW SALE
            </a>
        </div>
    `;

        const receiptForm = document.getElementById('receiptForm');
        if (receiptForm) {
            receiptForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = document.getElementById('receiptEmail');
                const sendBtn = document.getElementById('sendReceiptBtn');

                if (!emailInput.checkValidity()) {
                    emailInput.reportValidity();
                    return;
                }

                sendBtn.disabled = true;
                sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
                sendBtn.style.opacity = '0.8';

                fetch("/receipt/send", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            email: emailInput.value,
                            items: window.lastItems,
                            total: window.lastTotal,
                            paid: window.lastPaid,
                            change: window.lastChange,
                            cash: window.lastCash,
                            card: window.lastCard,
                            saleId: window.lastSaleId
                        })
                    })
                    .then(r => r.json())
                    .then(() => {
                        // Success - show checkmark
                        sendBtn.innerHTML = '<i class="fas fa-check me-2"></i>SENT!';
                        sendBtn.disabled = true;
                        sendBtn.style.background = "linear-gradient(135deg, #644d3c 0%, #4a3629 100%)";
                        sendBtn.style.opacity = "1";

                        setTimeout(() => {
                            sendBtn.innerHTML = '<i class="fas fa-envelope me-2"></i>SEND';
                            sendBtn.disabled = false;
                            sendBtn.style.background = "#644d3c";
                            emailInput.value = '';
                        }, 1000);
                    })
                    .catch((err) => {
                        console.error(err);
                        // Error - show failed message
                        sendBtn.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>FAILED!';
                        sendBtn.style.background = "#c0392b";
                        sendBtn.style.opacity = "1";

                        // Reset button after 2 seconds
                        setTimeout(() => {
                            sendBtn.innerHTML = '<i class="fas fa-envelope me-2"></i>SEND';
                            sendBtn.disabled = false;
                            sendBtn.style.background = "#644d3c";
                        }, 5000);
                    });
            });
        }
    }

    /* ===== INITIALIZE ===== */
    document.addEventListener('DOMContentLoaded', function() {
        renderPaymentUI();
    });
</script>

@include('layout.footer')
