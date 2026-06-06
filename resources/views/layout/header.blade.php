<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Yujo - Luxury POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #dfdac4;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        overflow-x: hidden;
    }

    .sb-topnav {
        background: #4f3b2d;
        padding: 0.5rem 0rem;
        box-shadow: 0 8px 25px -8px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 0;
        z-index: 1040;
        height: auto;
        min-height: 70px;
    }

    /* Navbar Brand / Logo */
    .navbar-brand {
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        justify-content: center;
    }

    .navbar-brand:hover {
        transform: scale(1.02);
    }

    .navbar-brand img {
        height: 55px;
        width: auto;
        filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.2));
        transition: all 0.3s ease;
    }

    /* Sidebar Toggle Button */
    #sidebarToggle {
        /* background: rgba(223, 218, 196, 0.15); */
        /* border: 1px solid rgba(223, 218, 196, 0.3); */
        /* border-radius: 40px; */
        /* color: #dfdac4; */
        /* padding: 8px 14px; */
        /* transition: all 0.3s ease; */
        /* margin-right: 0; */

    }

    #sidebarToggle:hover {
        /* background: rgba(223, 218, 196, 0.3); */
        /* border-color: #dfdac4; */
        /* transform: translateY(-1px); */
    }

    #sidebarToggle i {
        font-size: 1.1rem;
    }

    /* ========== LUXURY NAV PILL ========== */
    .nav-pill {
        color: #dfdac4 !important;
        font-weight: 500;
        font-size: 13px;
        padding: 6px 12px !important;
        /* background: rgba(223, 218, 196, 0.12);
        border: 1px solid rgba(223, 218, 196, 0.25); */
        /* border-radius: 40px; */
        /* transition: all 0.3s ease; */
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .nav-pill i {
        margin-right: 6px;
        font-size: 11px;
        opacity: 0.8;
    }

    /* Dropdown Button */
    .dropdown .nav-pill {
        background: rgba(223, 218, 196, 0.12);
        cursor: pointer;
    }

    .dropdown .nav-pill:hover {
        background: rgba(223, 218, 196, 0.25);
        border-color: rgba(223, 218, 196, 0.5);
    }

    .dropdown .nav-pill:disabled,
    .dropdown .nav-pill[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
    }


    .dropdown-menu {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 20px;
        box-shadow: 0 15px 35px -12px rgba(0, 0, 0, 0.35);
        padding: 8px 0;
        margin-top: 10px;
        min-width: 200px;
        overflow: hidden;
        animation: dropdownFadeIn 0.2s ease;
    }

    @keyframes dropdownFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-menu .dropdown-item {
        color: #644d3c;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dropdown-menu .dropdown-item i {
        width: 18px;
        font-size: 12px;
        color: #a0927e;
        transition: all 0.2s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #c9c2ae;
        color: #4a3629;
        padding-left: 24px;
    }

    .dropdown-menu .dropdown-item:hover i {
        color: #644d3c;
    }

    .dropdown-divider {
        border-top: 1px solid #c9c2ae;
        margin: 6px 0;
    }

    /* User Dropdown Toggle */
    .nav-link.dropdown-toggle {
        color: #dfdac4 !important;
        font-weight: 500;
        font-size: 13px;
        padding: 6px 12px !important;
        background: rgba(223, 218, 196, 0.12);
        border: 1px solid rgba(223, 218, 196, 0.25);
        border-radius: 40px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .nav-link.dropdown-toggle:hover {
        background: rgba(223, 218, 196, 0.25);
        /* transform: translateY(-1px); */
    }

    .nav-link.dropdown-toggle::after {
        margin-left: 6px;
        font-size: 10px;
    }

     .dropdown .nav-link:disabled,
    .dropdown .nav-link[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
        background: rgba(214, 212, 200, 0.062);
    }

    /*   SIDEBAR  */
    .sb-sidenav {
        background: #4f3b2d !important;
        box-shadow: 4px 0 20px -5px rgba(0, 0, 0, 0.2);
    }

    .sb-sidenav .sb-sidenav-menu {
        /* padding: 1.25rem 0; */
        margin-top:35px;
    }

    .sb-sidenav .nav-link {
        color: #dfdac4 !important;
        padding: 12px 5px;
        margin: 4px 12px;
        border-radius: 14px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        /* gap: 1px; */
    }

    .sb-sidenav .nav-link:hover {
        background: rgba(223, 218, 196, 0.12);
        transform: translateX(3px);
    }

    .sb-sidenav .nav-link.active {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4 !important;
        box-shadow: 0 4px 12px rgba(100, 77, 60, 0.3);
    }

    .sb-sidenav .sb-nav-link-icon {
        width: 28px;
        text-align: center;
        font-size: 1rem;
    }

    .sb-sidenav .nav-link i {
        font-size: 1rem;
    }

    .sb-sidenav .nav-link .fas.fa-lock {
        font-size: 10px;
        opacity: 0.6;
        margin-left: auto;
    }

    /* Disabled nav links */
    .sb-sidenav .nav-link.disabled,
    .sb-sidenav .nav-link.disabled:hover {
        opacity: 0.5;
        pointer-events: none;
        transform: none;
        background: transparent;
    }

    /* Sidebar scrollbar */
    .sb-sidenav-menu::-webkit-scrollbar {
        width: 5px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-track {
        background: rgba(223, 218, 196, 0.1);
        border-radius: 10px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-thumb {
        background: rgba(223, 218, 196, 0.3);
        border-radius: 10px;
    }

    /*  MODAL  (Force Password)  */
    .modal-luxury .modal-content {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 28px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }

    .modal-luxury .modal-header {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        color: #dfdac4;
        border-bottom: 2px solid #644d3c;
        border-radius: 27px 27px 0 0;
        padding: 1rem 1.5rem;
    }

    .modal-luxury .modal-title {
        color: #dfdac4;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .modal-luxury .btn-close-custom {
        background: none;
        border: none;
        font-size: 20px;
        color: #dfdac4;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .modal-luxury .modal-body {
        padding: 1.5rem;
    }

    .modal-luxury .modal-footer {
        border-top: 1px solid #c9c2ae;
        padding: 1rem 1.5rem;
        justify-content: center;
    }

    /* Form  Modal */
    .form-luxury-modal {
        background: #dfdac4;
        border: 1px solid #644d3c;
        border-radius: 30px;
        padding: 12px 18px;
        color: #644d3c;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-luxury-modal:focus {
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgba(100, 77, 60, 0.2);
        outline: none;
        background: #f5f0e0;
    }

    .btn-yujo {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        border: none;
        color: #dfdac4;
        padding: 12px 24px;
        border-radius: 40px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-yujo:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3);
        color: #dfdac4;
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
    }

    /* Alert Luxury */
    .alert-luxury {
        background: #644d3c;
        border-left: 4px solid #a18466;
        color: #dfdac4;
        border-radius: 16px;
        padding: 12px 20px;
        font-weight: 500;
    }

    /* Branch Inactive - Just Faded, No Badge */
.dropdown-item.branch-inactive {
    opacity: 0.5;
    cursor: not-allowed;
}

.dropdown-item.branch-inactive:hover {
    background: transparent;
    padding-left: 20px;
    transform: none;
    opacity: 0.5;
}

.dropdown-item.branch-inactive i {
    opacity: 0.4;
}

    /*  RESPONSIVE STYLES  */
@media (max-width: 500px) {
    .sb-topnav {
        display: flex;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        padding: 5px 8px;
        gap: 0;
        min-height: 60px;
        height: auto;
    }

    /* Brand/Logo */
    .sb-topnav .navbar-brand {
        order: 0;
        margin: 0;
        padding: 0;
        max-width: 65px;
        flex-shrink: 0;
        margin-right: 0;
    }

    .navbar-brand img {
        height: 45px;
        width: auto;
    }

    /* Sidebar Toggle */
    #sidebarToggle {
        order: 1;
        padding: 4px 6px;
        font-size: 14px;
        flex-shrink: 0;
        margin: 0;
        margin-left: 0;
        margin-right: 0;
    }

    /* Right side navbar items */
    .navbar-nav.ms-auto {
        order: 2;
        display: flex;
        flex-direction: row;
        margin: 0 !important;
        margin-left: auto !important;
        padding: 0;
        gap: 4px;
        flex-shrink: 1;
        min-width: 0;
    }

    /* Each nav item */
    .navbar-nav.ms-auto .nav-item {
        margin: 0 !important;
        padding: 0;
        flex-shrink: 1;
        min-width: 0;
    }

    /* Company badge */
    .nav-pill {
        font-size: 9px !important;
        padding: 3px 6px !important;
        white-space: nowrap;
        gap: 3px;
    }

    .nav-pill i {
        font-size: 8px !important;
        margin-right: 2px;
    }

    /* Branch dropdown button */
    .dropdown .nav-pill {
        font-size: 9px !important;
        padding: 3px 6px !important;
        white-space: nowrap;
        max-width: 85px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Welcome user dropdown */
    .nav-link.dropdown-toggle {
        font-size: 9px !important;
        padding: 3px 6px !important;
        white-space: nowrap;
        gap: 3px;
    }

    /* Hide text on very small screens */
    .nav-pill span,
    .dropdown .nav-pill span {
        display: none;
    }

    /* Show tooltip on hover for better UX */
    .nav-pill:hover::after {
        content: attr(data-text);
        position: absolute;
        background: #4f3b2d;
        color: #dfdac4;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 11px;
        white-space: nowrap;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        margin-top: 5px;
    }

    /* Icons only version */
    .nav-pill i,
    .dropdown .nav-pill i,
    .nav-link.dropdown-toggle i {
        margin-right: 0 !important;
        font-size: 12px !important;
    }

    .nav-pill,
    .dropdown .nav-pill,
    .nav-link.dropdown-toggle {
        position: relative;
    }

    /* Dropdown menu adjustment */
    .dropdown-menu {
        min-width: 140px;
        font-size: 12px;
    }

    .dropdown-menu .dropdown-item {
        padding: 5px 10px;
        font-size: 11px;
    }

    /* Card title */
    .card-title {
        font-size: 1rem;
    }
}




@media (min-width: 501px) and (max-width: 950px) {
    .sb-topnav {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        padding: 8px 12px;
        gap: unset !important;
        height: 60px;
    }
.sb-nav-fixed #layoutSidenav #layoutSidenav_nav .sb-sidenav {
  padding-top: 25px;
}

.sb-nav-fixed #layoutSidenav #layoutSidenav_nav {
  width: 160px;
  height: 100vh;
  z-index: 1038;
}
    /* Brand/Logo */
    .sb-topnav .navbar-brand {
        order: 1;
        margin: 0;
        padding: 0;
        max-width: 100px;
    }

    .sb-topnav .navbar-brand img {
        height: 45px;
        width: auto;
    }

    #sidebarToggle {
        order: 0;
        margin: 0;
        margin-left: -8px;
        margin-right: -4px;
        padding: 6px 8px;
        font-size: 18px;
    }

    /* Right side navbar items - PUSH TO RIGHT */
    .navbar-nav.ms-auto {
        order: 2;
        display: flex;
        flex-direction: row;
        margin: 0 !important;
        margin-left: auto !important;
        padding: 0;
        gap: 8px;
    }

    /* Each nav item */
    .navbar-nav.ms-auto .nav-item {
        margin: 0 !important;
        padding: 0;
    }

    /* Company badge */
    .nav-pill {
        font-size: 12px !important;
        padding: 4px 10px;
        white-space: nowrap;
    }

    /* Branch dropdown button */
    .dropdown .nav-pill {
        font-size: 11px !important;
        padding: 4px 10px;
        white-space: nowrap;
    }

    /* Welcome user dropdown */
    .nav-link.dropdown-toggle {
        font-size: 12px !important;
        padding: 4px 8px !important;
        white-space: nowrap;
    }

    /* Chevron icon in branch button */
    .dropdown .nav-pill i {
        font-size: 10px !important;
    }

    /* Dropdown menu adjustment */
    .dropdown-menu {
        min-width: 160px;
        font-size: 13px;
    }

    .dropdown-menu .dropdown-item {
        padding: 6px 12px;
        font-size: 12px;
    }

    #forcePasswordModal .modal-dialog {
        max-width: 400px !important;
        width: 90% !important;
    }

    #forcePasswordModal .modal-content {
        height: auto !important;
    }

    #forcePasswordModal .modal-header,
    #forcePasswordModal .modal-footer {
        padding: 0.3rem 0.75rem !important;
    }

    #forcePasswordModal .modal-body {
        padding: 0.5rem 0.75rem !important;
    }

    #forcePasswordModal .mb-2 {
        margin-bottom: 0.3rem !important;
    }

    #forcePasswordModal label {
        font-size: 14px;
        font-weight: 500;
    }

    #forcePasswordModal .form-control,
    #forcePasswordModal .form-select {
        font-size: 10px;
        padding: 3px 5px;
    }

    #forcePasswordModal .btn-primary {
        padding: 4px 8px;
        font-size: 14px;
    }

    /* Remove overflow */
    #forcePasswordModal .modal-body {
        overflow: visible !important;
    }
}

</style>

<body class="sb-nav-fixed">

    {{-- Top Navbar Luxury --}}
    <nav class="sb-topnav navbar navbar-expand navbar-dark ">
        <a class="navbar-brand text-center" href="{{ url('/dashboard') }}">
            <img src="{{ asset('assets/img/logo 2.png') }}" alt="Yujo Logo">
        </a>

        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav ms-auto me-2 me-lg-3 align-items-center">
            {{-- Company Badge --}}
            <li class="nav-item me-1 me-md-2">
                <span class="nav-pill">
                    <i class="fas fa-building"></i>{{ Auth::user()->company->company_name ?? 'No Company' }}
                </span>
            </li>

            {{-- Branch Dropdown --}}
            <li class="nav-item me-1 me-md-2">
                @php
                    $user = Auth::user();
                    $branches = \App\Models\Branch::where('company_id', $user->company_id)
                        ->where('is_deleted', 0)
                        ->get();

                    $currentBranchId = session('branch_id');
                    $currentBranch = $branches->firstWhere('id', $currentBranchId);

                    $isManager = $user->role_id == 2;
                    $isCashier = $user->role_id == 3;
                @endphp

                <div class="dropdown">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        @if ($isManager || $isCashier) disabled @endif>
                        <i class="fas fa-store"></i>{{ $currentBranch ? $currentBranch->branch_name : 'Select Branch' }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
    <li>
        <a class="dropdown-item" href="{{ route('dashboard.global') }}">
            <i class="fas fa-globe"></i> Admin Dashboard
        </a>
    </li>
    <li><hr class="dropdown-divider"></li>
    @foreach ($branches as $branch)
        <li>
            <a class="dropdown-item {{ !$branch->is_active ? 'branch-inactive' : '' }}"
                href="{{ $branch->is_active ? route('branch.select', $branch->id) : '#' }}"
                @if(!$branch->is_active)
                    onclick="return false;"
                    style="pointer-events: none;"
                @endif>
                <i class="fas fa-store"></i> {{ $branch->branch_name }}
            </a>
        </li>
    @endforeach
</ul>
                </div>
            </li>

            {{-- User Dropdown --}}
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'User' }}
    </a>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        {{-- Profile Menu - Only for Admin (role_id = 1) --}}
        @if(Auth::user()->role_id == 1)
            <li>
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                    <i class="fas fa-user-edit"></i> Profile
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
        @endif

        <li>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" onclick="handleLogout()" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark">
                @php
                    $user = Auth::user();
                    $branchSelected = session('branch_id');
                    $isAdmin = $user->role_id == 1;
                    $isManager = $user->role_id == 2;
                    $isCashier = $user->role_id == 3;

                    $sidebarPermissions = [
                        'sales' => ($isAdmin && $branchSelected) || $isManager || $isCashier,
                        'receipt_history' => ($isAdmin && $branchSelected) || $isManager || $isCashier,
                        'dashboard' => ($isAdmin && $branchSelected) || $isAdmin || $isManager,
                        'inventory' => ($isAdmin && $branchSelected) || $isManager,
                        'user' => ($isAdmin && $branchSelected) || $isAdmin || $isManager,
                        'branch' => $isAdmin,
                        'product' => $isAdmin,
                        'category' => $isAdmin,
                    ];
                @endphp

                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{-- Sales --}}
                        <a class="nav-link {{ !$sidebarPermissions['sales'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['sales'] ? url('/sales') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bills"></i></div>
                            Sales
                            @if (!$sidebarPermissions['sales']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Receipt History --}}
                        <a class="nav-link {{ !$sidebarPermissions['receipt_history'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['receipt_history'] ? route('receipt_history') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                            Receipt History
                            @if (!$sidebarPermissions['receipt_history']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Inventory --}}
                        <a class="nav-link {{ !$sidebarPermissions['inventory'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['inventory'] ? url('/inventory') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Inventory
                            @if (!$sidebarPermissions['inventory']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Dashboard --}}
                        <a class="nav-link {{ !$sidebarPermissions['dashboard'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['dashboard'] ? url('/dashboard') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Dashboard
                            @if (!$sidebarPermissions['dashboard']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Staff --}}
                        <a class="nav-link {{ !$sidebarPermissions['user'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['user'] ? url('/users') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Staff
                            @if (!$sidebarPermissions['user']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Branch --}}
                        <a class="nav-link {{ !$sidebarPermissions['branch'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['branch'] ? route('branch.index') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-code-branch"></i></div>
                            Branch
                            @if (!$sidebarPermissions['branch']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Product --}}
                        <a class="nav-link {{ !$sidebarPermissions['product'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['product'] ? route('product.index') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-barcode"></i></div>
                            Product
                            @if (!$sidebarPermissions['product']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>

                        {{-- Category --}}
                        <a class="nav-link {{ !$sidebarPermissions['category'] ? 'disabled' : '' }}"
                            href="{{ $sidebarPermissions['category'] ? route('category.index') : '#' }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            Categories
                            @if (!$sidebarPermissions['category']) <i class="fas fa-lock ms-auto"></i> @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        {{-- Force Password Modal (Luxury) --}}
        @if (Auth::check() && Auth::user()->is_first_login && !Auth::user()->isAdmin())
            <div class="modal fade modal-luxury" id="forcePasswordModal" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-shield-alt me-2"></i>Password Security
                            </h5>
                            <button type="button" class="btn-close-custom d-none" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-lock" style="font-size: 48px; color: #644d3c;"></i>
                            </div>
                            <p class="text-center fw-semibold mb-2">You must change your password to proceed.</p>

                            @if ($errors->any())
                                <div class="alert alert-luxury mb-3" id="successAlert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $errors->first() }}
                                </div>
                            @endif

                            <small class="text-muted d-block mb-3 text-center">
                                <i class="fas fa-info-circle me-1"></i>Password must be at least 6 characters
                            </small>

                            <form method="POST" action="{{ route('password.force.update') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="fw-semibold mb-2">New Password</label>
                                    <input type="password" name="password" class="form-luxury-modal" required
                                        placeholder="Enter new password">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="fw-semibold mb-2">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-luxury-modal" required
                                        placeholder="Confirm your password">
                                </div>

                                <button type="submit" class="btn-yujo w-100">
                                    <i class="fas fa-save me-2"></i>Save Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
