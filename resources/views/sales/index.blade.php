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
    }

    .pos-layout {
        display: flex;
        flex: 1;
        overflow: hidden;
        height: calc(100vh - 56px);
    }

    .menu-column {
        flex: 1;
        padding: 20px;
        padding-bottom: 30px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        height: 95%;
    }

    .menu-scroll {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 20px;
        min-height: 0;
    }

    .menu-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .menu-scroll::-webkit-scrollbar-track {
        background: #c9c2ae;
        border-radius: 10px;
    }

    .menu-scroll::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    .menu-scroll::-webkit-scrollbar-thumb:hover {
        background: #4a3629;
    }

    .dropdown-category {
        position: relative;
        display: inline-block;
        width: 100%;
        /* padding-top: 10px; */
    }

    .dropbtn-category {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 40px;
        padding: 10px 18px;
        color: #644d3c;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        justify-content: space-between;
    }

    .dropbtn-category:hover {
        background: #644d3c;
        color: #efe9d0;
    }

    /* Desktop Dropdown */
    .dropdown-content-category {
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
        max-height: 55vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .dropdown-content-category::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-content-category::-webkit-scrollbar-track {
        background: #c9c2ae;
        border-radius: 10px;
    }

    .dropdown-content-category::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    .dropdown-content-category a {
        color: #644d3c;
        padding: 10px 14px;
        text-decoration: none;
        display: block;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        border-radius: 12px;
        margin: 4px 6px;
    }

    .dropdown-content-category a:hover {
        background: #c9c2ae;
    }

    .dropdown-category.show .dropdown-content-category {
        display: block;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 15px;
        padding-top: 5px;
    }

    .menu-card {
        border: none;
        background: #c9c2ae;
        color: #644d3c;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        z-index: 1;
        padding: 0;
        text-align: left;
    }

    .menu-card:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.2);
        background: #b8b3a1;
    }

    .menu-card:not(:disabled):active {
        transform: scale(0.98);
    }

    .menu-card.disabled-menu {
        opacity: 0.6;
        cursor: not-allowed;
        filter: grayscale(0.3);
    }

    .menu-card.disabled-menu:hover {
        transform: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .out-of-stock-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.85);
        color: #fff;
        padding: 6px 12px;
        font-size: 10px;
        font-weight: 600;
        border-radius: 30px;
        z-index: 10;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .menu-card-img {
        width: 100%;
        aspect-ratio: 1 / 1;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #b8b3a1 0%, #a8a390 100%);
    }

    .menu-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
        display: block;
    }

    .menu-card:not(:disabled):hover .menu-card-img img {
        transform: scale(1.03);
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #b8b3a1 0%, #a8a390 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .no-image-placeholder i {
        font-size: 32px;
        color: #644d3c;
        opacity: 0.6;
    }

    .no-image-placeholder .placeholder-text {
        font-size: 10px;
        font-weight: 600;
        color: #644d3c;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .no-image-placeholder .placeholder-initial {
        font-size: 24px;
        font-weight: 800;
        color: #644d3c;
        opacity: 0.5;
        text-transform: uppercase;
    }

    .item-name {
        padding: 8px 8px 2px 8px;
        text-align: left;
        margin: 0;
        font-weight: 600;
        font-size: 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-price {
        padding: 0 8px 10px 8px;
        text-align: left;
        margin: 0;
        font-weight: 700;
        font-size: 14px;
        color: #4a3629;
    }

    .order-column {
        width: 380px;
        padding: 20px;
        /* padding-top: 25px; */
        border-left: 2px solid #644d3c;
        color: #644d3c;
        background: #dfdac4;
        display: flex;
        flex-direction: column;
        height: 95%;
    }

    .order-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }

    .order-content h1 {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.5px;
        /* margin-bottom: 15px; */
        border-left: 4px solid #644d3c;
        padding-left: 15px;
    }

    .order-content hr {
        border-color: #644d3c;
        opacity: 0.3;
        margin-bottom: 15px;
    }

    /* Order List Styling */
    #orderList {
        flex: 1;
        overflow-y: auto;
        min-height: 0;
        -webkit-overflow-scrolling: touch;
    }

    #orderList::-webkit-scrollbar {
        width: 6px;
    }

    #orderList::-webkit-scrollbar-track {
        background: #c9c2ae;
        border-radius: 10px;
    }

    #orderList::-webkit-scrollbar-thumb {
        background: #644d3c;
        border-radius: 10px;
    }

    .order-item {
        background: #c9c2ae;
        border-radius: 16px;
        padding: 12px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }

    .order-item:hover {
        background: #b8b3a1;
        transform: translateZ(4px);
    }

    .order-item-name {
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .order-item-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
    }

    .order-item-price {
        font-weight: 600;
    }

    .order-item-qty {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .qty-btn {
        background: #dfdac4;
        color: #644d3c;
        border: 1.5px solid #644d3c;
        border-radius: 30px;
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .qty-btn:hover:not(:disabled) {
        background: #644d3c;
        color: #dfdac4;
        transform: scale(1.05);
    }

    .qty-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .order-item-subtotal {
        font-weight: 700;
        font-size: 14px;
        color: #4a3629;
    }

    .order-footer {
        position: sticky;
        bottom: 0;
        background: #dfdac4;
        padding: 16px 0 25px 0;
        border-top: 2px solid #644d3c;
        flex-shrink: 0;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 8px;
    }

    .total-label {
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .total-amount {
        font-size: 28px;
        font-weight: 800;
        color: #4a3629;
    }

    .charge-btn {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border: none;
        padding: 14px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin-top: 12px;
        width: 100%;
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

    .mobile-order-bar {
        display: none;
    }

    .mobile-order-overlay {
        display: none;
    }

    .low-stock-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        pointer-events: auto;
    }

    .low-stock-modal .modal-content {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 85%;
        max-width: 300px;
        margin: 0;
        background: #fff3cd;
        border: 1px solid #ffeeba;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        padding: 20px;
        pointer-events: auto;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2001;
    }

    .low-stock-modal #lowStockList {
        font-size: 15px;
        color: #644d3c;
        margin-bottom: 20px;
        list-style: none;
        padding: 0;
        font-weight: 500;
    }

    .low-stock-modal .modal-content button {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .low-stock-modal .modal-content button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(100, 77, 60, 0.3);
    }

    .empty-cart-message {
        text-align: center;
        padding: 40px 20px;
        color: #a0927e;
        align-items: center;
    }

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
        }

        .pos-layout {
            height: calc(100vh - 60px) !important;
        }

        .menu-column {
            padding: 12px;
            padding-bottom: 80px;
        }

        .dropbtn-category {
            width: 100%;
            font-size: 14px;
            padding: 10px 16px;
        }

        .menu-grid {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding-top: 0;
        }

        .menu-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 12px;
            box-shadow: none;
            border-bottom: 1px solid #c9c2ae;
            transform: none !important;
            margin-bottom: 1px;
        }

        .menu-card:hover {
            transform: none;
            box-shadow: none;
        }

        .menu-card-img {
            width: 50px;
            height: 50px;
            aspect-ratio: unset;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .menu-card-img img {
            border-radius: 12px;
        }

        .no-image-placeholder {
            border-radius: 12px;
        }

        .no-image-placeholder i {
            font-size: 20px;
        }

        .no-image-placeholder .placeholder-initial {
            font-size: 18px;
        }

        .no-image-placeholder .placeholder-text {
            display: none;
        }

        .item-name {
            padding: 0;
            flex: 1;
            font-size: 13px;
            white-space: normal;
        }

        .item-price {
            padding: 0;
            font-size: 14px;
            margin-left: auto;
        }

        .order-column {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: auto;
            padding: 0;
            border: none;
            z-index: 1002;
        }

        .mobile-order-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #644d3c;
            color: #dfdac4;
            padding: 14px 20px;
            cursor: pointer;
            border-radius: 20px 20px 0 0;
            position: relative;
            z-index: 1003;
        }

        .mobile-order-bar strong {
            font-size: 16px;
        }

        .mobile-order-bar small {
            font-size: 12px;
            opacity: 0.9;
        }

        .order-content {
            position: absolute;
            bottom: 60px;
            left: 0;
            width: 100%;
            height: 70vh;
            background: #dfdac4;
            border-radius: 24px 24px 0 0;
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            border-top: 2px solid #644d3c;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.15);
        }

        .order-column.active .order-content {
            transform: translateY(0);
        }

        .order-content h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .order-footer {
            padding: 12px 0 8px 0;
        }

        .total-amount {
            font-size: 24px;
        }

        .mobile-order-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 998;
        }

        .mobile-order-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-content-category {
            position: fixed;
            bottom: 75px;
            left: 0;
            right: 0;
            width: 100%;
            max-height: 70vh;
            overflow-y: auto;
            background: #dfdac4;
            border-radius: 28px 28px 0 0;
            box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
            z-index: 1003;
            border-bottom: none;
            margin-top: 0;
            top: auto;
            visibility: visible !important;
            opacity: 1 !important;
            display: block !important;
        }

        .dropdown-category {
            position: relative;
            z-index: 100;
        }

        .dropdown-category.show .dropdown-content-category {
            transform: translateY(0) !important;
            display: block !important;
        }

        .dropbtn-category .fa-chevron-down,
        .dropbtn-category .fa-chevron-up {
            transition: transform 0.3s ease;
        }

        .dropdown-category.show .dropbtn-category .fa-chevron-down {
            transform: rotate(180deg);
        }

        .dropdown-content-category a {
            padding: 16px 20px;
            font-size: 16px;
            border-bottom: 1px solid #c9c2ae;
            margin: 0;
            border-radius: 0;
            display: flex;
            align-items: center;
        }

        .dropdown-content-category a:active {
            background: #b8b3a1;
        }

        .dropdown-content-category a:last-child {
            border-bottom: none;
        }

        .dropdown-content-category::before {
            content: "";
            width: 50px;
            height: 4px;
            background: #c9c2ae;
            border-radius: 10px;
            display: block;
            margin: 12px auto;
            position: sticky;
            top: 8px;
            z-index: 2;
        }

        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1002;
        }

        .dropdown-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .low-stock-modal .modal-content {
            width: 85%;
            max-width: 300px;
            padding: 20px;
        }
    }

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

        .charge-btn {
            margin-top: 5px;
        }

        .menu-grid {
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px;
        }

        .menu-card-img {
            aspect-ratio: 4 / 3;
        }

        .item-name {
            font-size: 11px;
            padding: 6px 6px 2px 6px;
        }

        .item-price {
            font-size: 12px;
            padding: 0 6px 8px 6px;
        }

        .no-image-placeholder i {
            font-size: 24px;
        }

        .no-image-placeholder .placeholder-initial {
            font-size: 18px;
        }

        .no-image-placeholder .placeholder-text {
            font-size: 9px;
        }

        .menu-column {
            padding-top:20px;
        }

        .order-column {
            width: 340px;
            padding-top: 20px;
        }

        .dropbtn-category {
            font-size: 0.9rem;
            padding: 8px 14px;
        }

        .order-footer {
            padding: 2px 0 25px 0;
        }

        .total-row {
            margin: 0px !important;
        }

        .dropdown-content-category {
            max-height: 50vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .dropdown-content-category::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-content-category::-webkit-scrollbar-track {
            background: #c9c2ae;
            border-radius: 10px;
        }

        .dropdown-content-category::-webkit-scrollbar-thumb {
            background: #644d3c;
            border-radius: 10px;
        }

        .empty-cart-message {
            padding: 0 !important;
        }

        .dropdown-category {
            padding: 0;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main class="pos-layout">

        <!-- MENU COLUMN -->
        <div class="menu-column">
            <!-- DROPDOWN CATEGORY -->
            <div class="dropdown-category" id="categoryDropdown">
                <button class="dropbtn-category" id="categoryDropBtn">
                    <span><i class="fas fa-th-large me-2"></i>{{ $currentCategoryName }}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content-category">
                    <a href="{{ route('sales.index') }}">
                        <i class="fas fa-th-large me-3"></i>All Items
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('sales.index', ['category_id' => $cat->id]) }}">
                            <i class="fas fa-tag me-3"></i>{{ $cat->name }}
                        </a>
                    @endforeach
                </div>
                <div class="dropdown-overlay" id="dropdownOverlay"></div>
            </div>
            <hr>
            <div class="menu-scroll">
                <div class="menu-grid">
                    @foreach ($menus as $m)
                        <button class="menu-card {{ $m->qty == 0 ? 'disabled-menu' : '' }}"
                            data-id="{{ $m->id }}" data-stock="{{ $m->qty }}"
                            {{ $m->qty == 0 ? 'disabled' : '' }}
                            onclick="addToOrder({{ $m->id }}, '{{ addslashes($m->item_name) }}', {{ $m->price }}, {{ $m->qty }})">

                            @if ($m->qty == 0)
                                <div class="out-of-stock-badge">
                                    <i class="fas fa-ban me-1"></i>Out of Stock
                                </div>
                            @endif

                            <div class="menu-card-img">
                                @php
                                    $imagePath = null;
                                    $hasImage = false;

                                    if ($m->img && $m->img !== '') {
                                        $cleanPath = str_replace('storage/', '', $m->img);

                                        if (file_exists(public_path($m->img))) {
                                            $imagePath = asset($m->img);
                                            $hasImage = true;
                                        } elseif (file_exists(public_path('storage/' . $cleanPath))) {
                                            $imagePath = asset('storage/' . $cleanPath);
                                            $hasImage = true;
                                        } elseif (file_exists(public_path($cleanPath))) {
                                            $imagePath = asset($cleanPath);
                                            $hasImage = true;
                                        } elseif (filter_var($m->img, FILTER_VALIDATE_URL)) {
                                            $imagePath = $m->img;
                                            $hasImage = true;
                                        }
                                    }
                                @endphp

                                @if ($hasImage && $imagePath)
                                    <img src="{{ $imagePath }}" alt="{{ $m->item_name }}"
                                        onerror="this.style.display='none'; this.parentElement.querySelector('.no-image-placeholder').style.display='flex';">
                                    <div class="no-image-placeholder" style="display: none;">
                                        <div class="placeholder-text">No Image</div>
                                    </div>
                                @else
                                    <div class="no-image-placeholder">

                                        <div class="placeholder-text">No Image</div>
                                    </div>
                                @endif
                            </div>

                            <p class="item-name" title="{{ $m->item_name }}">
                                {{ Str::limit($m->item_name, 20) }}
                            </p>
                            <p class="item-price">
                                RM{{ number_format($m->price, 2) }}
                            </p>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ORDER COLUMN -->
        <div class="order-column" id="orderColumn">
            <!-- MOBILE BAR -->
            <div class="mobile-order-bar" onclick="toggleOrder()">
                <div>
                    <strong><i class="fas fa-shopping-cart me-1"></i>Order (<span id="totalQty">0</span>)</strong><br>
                    <small id="mobileTotal">RM0.00</small>
                </div>
                <div id="arrowIcon">
                    <i class="fas fa-chevron-up"></i>
                </div>
            </div>

            <!-- ORDER CONTENT -->
            <div class="order-content" id="orderContent">
                <h1>Current Order</h1>
                <hr>

                <div id="orderList">
                    <div class="empty-cart-message">
                        <i class="fas fa-shopping-cart" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                        <p style="margin: 0;">Your order is empty</p>
                        <small>Tap on items to add</small>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="total-row">
                        <span class="total-label"><i class="fas fa-calculator me-2"></i>Total Amount</span>
                        <span class="total-amount" id="total">RM0.00</span>
                    </div>

                    <button id="chargeBtn" onclick="submitOrder()" class="charge-btn" disabled>
                        <i class="fas fa-credit-card me-2"></i>CHARGE
                    </button>
                </div>
            </div>
        </div>
        <div class="mobile-order-overlay" id="mobileOrderOverlay"></div>
    </main>
</div>

@if (session('force_reload'))
    <script>
        localStorage.setItem('force_reload_once', '1');
    </script>
@endif

@if (session('clear_cart'))
    <script>
        const userIdClear = "{{ auth()->id() }}";
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith(`cart_${userIdClear}_`)) {
                localStorage.removeItem(key);
            }
        });
    </script>
@endif

<script>
    const userId = "{{ auth()->id() }}";
    const branchId = "{{ session('branch_id') ?? 'no-branch' }}";
    const cartKey = `cart_${userId}_${branchId}`;

    // Force reload once logic
    if (localStorage.getItem('force_reload_once') === '1') {
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith(`cart_${userId}_`)) {
                localStorage.removeItem(key);
            }
        });
        localStorage.removeItem('force_reload_once');
    }

    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

    function saveCart() {
        localStorage.setItem(cartKey, JSON.stringify(cart));
    }

    function clearCart() {
        cart = [];
        localStorage.removeItem(cartKey);
        renderCart();
    }

    function addToOrder(id, name, price, stock) {
        let item = cart.find(p => p.id === id);

        if (!item) {
            if (stock <= 0) return;
            item = {
                id,
                name,
                price,
                qty: 1,
                stock,
                warned: false
            };
            cart.push(item);
        } else {
            let availableStock = stock - item.qty;
            if (availableStock <= 0) return;
            item.qty++;
        }

        let remaining = stock - item.qty;
        if (remaining <= 5 && !item.warned) {
            showLowStockModal(item.name, remaining);
            item.warned = true;
        }

        saveCart();
        renderCart();
    }

    function changeQty(id, delta) {
        let item = cart.find(p => p.id === id);
        if (!item) return;

        let availableStock = item.stock - item.qty;

        if (delta > 0 && availableStock <= 0) return;

        let oldRemaining = item.stock - item.qty;
        item.qty += delta;
        let newRemaining = item.stock - item.qty;

        if (delta > 0 && newRemaining <= 5 && oldRemaining > 5 && !item.warned) {
            showLowStockModal(item.name, newRemaining);
            item.warned = true;
        }

        if (newRemaining > 5) {
            item.warned = false;
        }

        if (item.qty <= 0) {
            cart = cart.filter(p => p.id !== id);
        }

        saveCart();
        renderCart();
    }

    function renderCart() {
        cart.forEach(item => {
            if (item.qty > item.stock) {
                item.qty = item.stock;
            }
        });

        let list = document.getElementById('orderList');
        let total = 0;
        let totalQty = 0;

        cart.forEach(item => {
            totalQty += item.qty;
            total += item.qty * item.price;
        });

        if (cart.length === 0) {
            list.innerHTML = `
                <div class="empty-cart-message">
                    <i class="fas fa-shopping-cart" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                    <p style="margin: 0;">Your order is empty</p>
                    <small>Tap on items to add</small>
                </div>
            `;
        } else {
            list.innerHTML = cart.map(item => `
                <div class="order-item">
                    <div class="order-item-name">${escapeHtml(item.name)}</div>
                    <div class="order-item-details">
                        <span class="order-item-price">RM${item.price.toFixed(2)}</span>
                        <div class="order-item-qty">
                            <button class="qty-btn" onclick="event.stopPropagation(); changeQty(${item.id}, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.qty}</span>
                            <button class="qty-btn" onclick="event.stopPropagation(); changeQty(${item.id}, 1)"
                                ${item.qty >= item.stock ? 'disabled' : ''}>
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <span class="order-item-subtotal">RM${(item.qty * item.price).toFixed(2)}</span>
                    </div>
                </div>
            `).join('');
        }

        document.getElementById('total').innerText = 'RM' + total.toFixed(2);
        document.getElementById('totalQty').innerText = totalQty;
        document.getElementById('mobileTotal').innerText = 'RM' + total.toFixed(2);

        let chargeBtn = document.getElementById('chargeBtn');
        if (cart.length === 0) {
            chargeBtn.disabled = true;
        } else {
            chargeBtn.disabled = false;
        }

        updateMenuAvailability();
    }

    function updateMenuAvailability() {
        document.querySelectorAll('.menu-card').forEach(btn => {
            let id = parseInt(btn.dataset.id);
            let stock = parseInt(btn.dataset.stock);
            let item = cart.find(p => p.id === id);
            let availableStock = stock - (item?.qty || 0);

            if (availableStock <= 0) {
                btn.classList.add('disabled-menu');
                btn.disabled = true;
                if (!btn.querySelector('.dynamic-badge')) {
                    let badge = document.createElement('div');
                    badge.className = 'out-of-stock-badge dynamic-badge';
                    badge.innerHTML = '<i class="fas fa-ban me-1"></i>Out of Stock';
                    btn.appendChild(badge);
                }
            } else {
                btn.classList.remove('disabled-menu');
                btn.disabled = false;
                let badge = btn.querySelector('.dynamic-badge');
                if (badge) badge.remove();
            }
        });
    }

    function submitOrder() {
        if (!cart.length) {
            return;
        }

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('payment.show') }}";

        let token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = "{{ csrf_token() }}";
        form.appendChild(token);

        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'items';
        input.value = JSON.stringify(cart);
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
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

    // Mobile toggle functions
    function toggleOrder() {
        if (window.innerWidth > 500) return;

        let column = document.getElementById('orderColumn');
        let arrowIcon = document.getElementById('arrowIcon');
        let overlay = document.getElementById('mobileOrderOverlay');

        if (!column) {
            console.log('orderColumn not found');
            return;
        }

        column.classList.toggle('active');

        if (column.classList.contains('active')) {
            if (arrowIcon) arrowIcon.innerHTML = '<i class="fas fa-chevron-down"></i>';
            if (overlay) {
                overlay.classList.add('active');
                overlay.style.display = 'block';
            }
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
        } else {
            if (arrowIcon) arrowIcon.innerHTML = '<i class="fas fa-chevron-up"></i>';
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
            }
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
        }
    }

    // Close order panel when clicking overlay
    document.addEventListener('click', function(e) {
        if (window.innerWidth > 500) return;

        let content = document.getElementById('orderContent');
        let column = document.getElementById('orderColumn');
        let overlay = document.getElementById('mobileOrderOverlay');
        let mobileBar = document.querySelector('.mobile-order-bar');

        if (overlay && overlay.classList.contains('active') && e.target === overlay) {
            column.classList.remove('active');
            overlay.classList.remove('active');
            if (document.getElementById('arrowIcon')) {
                document.getElementById('arrowIcon').innerHTML = '<i class="fas fa-chevron-up"></i>';
            }
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
        }

        if (!content?.contains(e.target) && !mobileBar?.contains(e.target) && column?.classList.contains('active')) {
            column.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            if (document.getElementById('arrowIcon')) {
                document.getElementById('arrowIcon').innerHTML = '<i class="fas fa-chevron-up"></i>';
            }
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.target.matches('input, textarea, button')) submitOrder();
        if (e.key === 'Escape') {
            if (cart.length && confirm("Clear entire order?")) clearCart();
        }
    });

    // Low stock modal
    let modalTimer;

    function showLowStockModal(itemName, qty) {
        let modal = document.getElementById("lowStockModal");
        let list = document.getElementById("lowStockList");

        list.innerHTML = `
            <b>${escapeHtml(itemName)}</b><br>
            Remaining stock: <strong>${qty}</strong>
        `;

        modal.style.display = "flex";

        clearTimeout(modalTimer);
        modalTimer = setTimeout(() => {
            closeModal();
        }, 8000);
    }

    function closeModal() {
        document.getElementById("lowStockModal").style.display = "none";
    }

    // Dropdown Category Functionality
    document.addEventListener('DOMContentLoaded', function() {
        renderCart();

        const categoryDropBtn = document.getElementById('categoryDropBtn');
        const categoryDropdown = document.getElementById('categoryDropdown');
        const overlay = document.getElementById('dropdownOverlay');
        const dropdownContent = document.querySelector('.dropdown-content-category');

        if (categoryDropBtn) {
            categoryDropBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                categoryDropdown.classList.toggle('show');

                if (overlay) {
                    if (categoryDropdown.classList.contains('show')) {
                        overlay.classList.add('active');
                        if (window.innerWidth <= 500) {
                            document.body.style.overflow = 'hidden';
                            document.body.style.position = 'fixed';
                            document.body.style.width = '100%';
                        }
                    } else {
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                        document.body.style.position = '';
                        document.body.style.width = '';
                    }
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (categoryDropdown && categoryDropdown.classList.contains('show')) {
                const isClickInside = categoryDropBtn?.contains(e.target) ||
                                    dropdownContent?.contains(e.target);

                if (!isClickInside) {
                    categoryDropdown.classList.remove('show');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    document.body.style.position = '';
                    document.body.style.width = '';
                }
            }
        });

        // Close dropdown when overlay is clicked
        if (overlay) {
            overlay.addEventListener('click', function() {
                categoryDropdown.classList.remove('show');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
                document.body.style.position = '';
                document.body.style.width = '';
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 500 && categoryDropdown.classList.contains('show')) {
                categoryDropdown.classList.remove('show');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
                document.body.style.position = '';
                document.body.style.width = '';
            }
        });
    });
</script>

<!-- LOW STOCK MODAL -->
<div id="lowStockModal" class="low-stock-modal">
    <div class="modal-content">
        <h4><i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alert</h4>
        <ul id="lowStockList"></ul>
        <button onclick="closeModal()">
            <i class="fas fa-check me-2"></i>Got It
        </button>
    </div>
</div>

@include('layout.footer')
