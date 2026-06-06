@include('layout.header')

<style>
    body {
        background: #dfdac4;
        color: #644d3c;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        /* overflow-y: hidden; */
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
        /* min-height: 100vh; */
        position: relative;
    }

    .luxury-container {
        padding: 1.5rem;
        flex: 1;
        height: auto;
        min-height: 100%;
    }

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
        color: #644d3c;
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
        white-space: nowrap;
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3);
        color: #dfdac4;
        background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
    }

    /* Equal width for Edit and Delete buttons */
    .btn-edit-luxury,
    .btn-delete-luxury {
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
    }

    .btn-edit-luxury {
        background: transparent;
        border: 1px solid #644d3c;
        color: #644d3c;
    }

    .btn-edit-luxury:hover {
        background: #644d3c;
        color: #dfdac4;
        transform: translateY(-1px);
    }

    .btn-delete-luxury {
        background: transparent;
        border: 1px solid #c0392b;
        color: #c0392b;
    }

    .btn-delete-luxury:hover {
        background: #c0392b;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Branch Badge */
    .badge-branch {
        background: #644d3c20;
        color: #644d3c;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 11px;
    font-weight: 600;
        min-width: 100px;
        text-align: center;
        display: inline-block;
        white-space: nowrap;
    }

    /* Role Badge  */
    .badge-role {
        background: #644d3c;
        color: #dfdac4;
        padding: 5px 12px;
        border-radius: 30px;
        min-width: 100px;
        font-size: 11px;
    font-weight: 600;
        text-align: center;
        display: inline-block;
        white-space: nowrap;
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex-wrap: nowrap;
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

    /* Pagination */
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

    .modal-luxury .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-luxury .modal-body {
        padding: 1.5rem;
    }

    .modal-luxury .modal-footer {
        border-top: 1px solid #c9c2ae;
        padding: 1rem 1.5rem;
    }

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

    .form-group {
        margin-bottom: 1rem;
    }

    .alert-custom {
        background: #644d3c;
        border-left: 4px solid #a18466;
        color: #dfdac4;
        border-radius: 16px;
        padding: 12px 20px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .alert-luxury-success {
        background: #dfdac4;
        border-left: 4px solid #2ecc71;
        border-radius: 16px;
        padding: 12px 20px;
        color: #27ae60;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .alert-luxury-danger {
        background: #dfdac4;
        border-left: 4px solid #e74c3c;
        border-radius: 16px;
        padding: 12px 20px;
        color: #c0392b;
        font-weight: 500;
    }

    .alert-yujo {
--bs-alert-color: #644d3c;
  --bs-alert-bg: #cac7bf;
  --bs-alert-border-color: #644d3c;
}

.alert-yujo code {
    color: #6B7B3A !important;
    background-color: transparent !important;
    font-weight: bold;
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

        /* Ensure table container scrolls */
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

        .btn-edit-luxury,
        .btn-delete-luxury {
            min-width: 65px;
            padding: 4px 8px;
            font-size: 10px;
            gap: 4px;
        }

        .btn-edit-luxury i,
        .btn-delete-luxury i {
            margin-right: 0;
        }

        .action-buttons {
            gap: 4px;
        }

        .d-flex.justify-content-between.align-items-center.flex-wrap {
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            gap: 6px !important;
            flex-wrap: nowrap !important;
        }

        .d-flex.align-items-center {
            width: auto !important;
            flex-shrink: 0 !important;
        }

        /* Search input styling */
        #searchInput {
            min-width: 130px !important;
            width: auto !important;
            max-width: 140px !important;
            font-size: 10px !important;
            padding: 4px 8px !important;
        }

        .fa-search {
            font-size: 10px !important;
        }

        /* Entries dropdown styling */
        #entriesPerPage {
            width: 45px !important;
            padding: 3px 14px 3px 4px !important;
            font-size: 10px !important;
        }

        .d-flex.align-items-center span {
            font-size: 10px !important;
            white-space: nowrap !important;
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

        .form-group {
            margin-bottom: 0.2rem;
        }

        .modal-luxury .modal-body {
            padding: 1rem 1.5rem;
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

        .btn-edit-luxury,
        .btn-delete-luxury {
            min-width: 70px;
            padding: 4px 10px;
            font-size: 11px;
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

            <!-- Page Title & Add Button -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title-luxury">Staff Management</h1>
                <button class="btn btn-luxury" onclick="openAddModal()">
                    <i class="fas fa-plus-circle me-2"></i>New Staff
                </button>
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

            <!-- Staff Table Card -->
            <div class="luxury-card">

                <div class="card-header-luxury">
                    <h5><i class="fas fa-users"></i> All Staff Members</h5>
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
                            <input type="text" id="searchInput" class="form-luxury" placeholder="Search..."
                                style="min-width: 180px; padding: 5px 12px; font-size: 12px; border-radius: 30px;">
                        </div>
                    </div>

                    <!-- Scrollable table wrapper for small screens -->
                    <div class="table-responsive-wrapper">
                        <table id="staffTable" class="table datatable-table" style="width: 100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-user me-1"></i>Name</th>
                                    <th class="text-center"><i class="fas fa-envelope me-1"></i>Email</th>
                                    <th class="text-center"><i class="fas fa-store me-1"></i>Branch</th>
                                    <th class="text-center"><i class="fas fa-users me-1"></i>Role</th>
                                    <th class="text-center"><i class="fas fa-calendar me-1"></i>Created At</th>
                                    <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="staffTableBody">
                                @foreach ($users as $u)
                                    <tr>
                                        <td><strong>{{ $u->name }}</strong></td>
                                        <td>{{ $u->email }}</td>
                                        <td class="text-center">
                                            @if ($u->branch)
                                                <span class="badge-branch">
                                                    <i
                                                        class="fas fa-location-dot me-1"></i>{{ $u->branch->branch_name }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-role">
                                                {{ $u->role->role ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $u->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-edit-luxury"
                                                    onclick="openEditModal({{ $u->id }}, '{{ $u->name }}', '{{ $u->email }}', {{ $u->role_id }}, {{ $u->branch_id ?? 'null' }})">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                                    class="delete-form d-inline" data-user-name="{{ $u->name }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-delete-luxury delete-btn">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
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

{{-- MODAL ADD/EDIT STAFF --}}
<div class="modal fade modal-luxury" id="cashierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">
                    <i class="fas fa-user-plus me-2"></i>Staff
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none; font-size: 20px; color: #dfdac4; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="cashierForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="fas fa-user me-1"></i> Full Name</label>
                        <input type="text" id="name" name="name" class="form-luxury"
                            placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-envelope me-1"></i> Email Address</label>
                        <input type="email" id="email" name="email" class="form-luxury"
                            placeholder="Enter email address" required>
                    </div>

                    {{-- Role Selection --}}
                    <div class="form-group">
                        <label><i class="fas fa-users me-1"></i> Role</label>
                        @if ($user->role_id == 1)
                            <select name="role_id" id="roleSelect" class="form-luxury">
                                <option value="2">👔 Manager</option>
                                <option value="3">📠 Staff</option>

                            </select>
                        @else
                            <input type="hidden" name="role_id" value="3">
                            <input type="text" class="form-luxury" value="Cashier" disabled>
                        @endif
                    </div>

                    {{-- Branch Selection --}}
                    @if ($user->role_id == 1)
                        <div class="form-group">
                            <label><i class="fas fa-store me-1"></i> Branch</label>
                            <select name="branch_id" id="branchSelect" class="form-luxury">
                                @foreach ($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="branch_id" value="{{ $user->branch_id }}">
                    @endif
                </div>

                <div class="modal-footer"
                    style="justify-content: center; border-top: 1px solid #c9c2ae; padding: 1rem 1.5rem;">
                    <button type="submit" class="btn-luxury w-100">
                        <i class="fas fa-save me-1"></i>Save Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL CONFIRM DELETE --}}
<div class="modal fade modal-luxury" id="deleteConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash-alt me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none; font-size: 20px; color: #dfdac4; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-exclamation-triangle"
                    style="font-size: 48px; color: #c0392b; margin-bottom: 16px;"></i>
                <p style="font-size: 16px;">Are you sure you want to delete staff:</p>
                <strong id="deleteStaffName" style="font-size: 18px; color: #644d3c;"></strong>
                <p class="mt-3 small text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer"
                style="justify-content: center; border-top: 1px solid #c9c2ae; padding: 1rem 1.5rem;">
                <button type="button" class="btn-luxury w-100" id="confirmDeleteBtn">
                    <i class="fas fa-trash-alt me-1"></i>Delete Permanently
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TEMP PASSWORD  --}}
@if (session('new_user'))
    <div class="modal fade modal-luxury" id="newUserModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%)";>
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Staff Created Successfully
                    </h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"
                        style="background: none; border: none; font-size: 20px; color: #dfdac4; cursor: pointer;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-check" style="font-size: 48px; color: #644d3c;"></i>
                    </div>
                    <p><strong><i class="fas fa-user me-1"></i>Name:</strong> {{ session('new_user')['name'] }}</p>
                    <p><strong><i class="fas fa-envelope me-1"></i>Email:</strong> {{ session('new_user')['email'] }}
                    </p>
                    <p><strong><i class="fas fa-users me-1"></i>Role:</strong> {{ session('new_user')['role'] }}</p>
                    <p><strong><i class="fas fa-store me-1"></i>Branch:</strong> {{ session('new_user')['branch'] }}
                    </p>

                    <div class="alert alert-yujo"
                        >
                        <p class="mb-1"><strong><i class="fas fa-key me-1"></i>Temporary Password:</strong></p>
                        <code
                            style="font-size: 18px; padding: 8px 12px; display: block; border-radius: 8px; text-align: center;">
                            {{ session('new_user')['password'] }}
                        </code>
                        <p class="mt-2 mb-0 small ">
                            <i class="fas fa-exclamation-circle me-1"></i>Please ask user to change password on first
                            login.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-luxury w-100" data-bs-dismiss="modal">
                        <i class="fas fa-check me-1"></i>Got it
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    let deleteForm = null;
    let allStaffData = [];
    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    @php
        $staffData = [];
        foreach ($users as $u) {
            $staffData[] = [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'branch' => $u->branch ? $u->branch->branch_name : '-',
                'role' => $u->role ? $u->role->role : '-',
                'role_id' => $u->role_id,
                'branch_id' => $u->branch_id,
                'created_at' => $u->created_at->format('d M Y'),
                'created_raw' => $u->created_at->timestamp,
            ];
        }
    @endphp

    allStaffData = @json($staffData);

    // Function to filter data based on search
    function filterData() {
        if (!searchTerm) return allStaffData;

        const term = searchTerm.toLowerCase();
        return allStaffData.filter(item =>
            item.name.toLowerCase().includes(term) ||
            item.email.toLowerCase().includes(term) ||
            item.branch.toLowerCase().includes(term) ||
            item.role.toLowerCase().includes(term)
        );
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
        const tbody = document.getElementById('staffTableBody');
        if (!tbody) return;

        if (pageData.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="6" style="text-align: center; padding: 40px; color: #a0927e;">No staff found</td></tr>';
        } else {
            tbody.innerHTML = pageData.map(item => `
            <tr>
                <td><strong>${escapeHtml(item.name)}</strong></td>
                <td>${escapeHtml(item.email)}</td>
                <td class="text-center">
                    ${item.branch !== '-' ? `<span class="badge-branch">
    <i class="fas fa-location-dot me-1"></i>${escapeHtml(item.branch)}
</span>` : '-'}
                </td>
                <td class="text-center">
                    <span class="badge-role">
    ${escapeHtml(item.role)}
</span>
                </td>
                <td class="text-center">${escapeHtml(item.created_at)}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-edit-luxury" onclick="openEditModal(${item.id}, '${escapeHtml(item.name)}', '${escapeHtml(item.email)}', ${item.role_id}, ${item.branch_id || 'null'})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="/users/${item.id}" method="POST" class="delete-form d-inline" data-user-name="${escapeHtml(item.name)}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete-luxury delete-btn">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
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
            infoDiv.innerHTML = `Showing ${startNum} to ${endNum} of ${totalEntries} staff`;
        }

        // Render pagination
        renderPagination(totalPages);

        // Re-attach delete event listeners
        attachDeleteEvents();
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

    // Attach delete event listeners
    function attachDeleteEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.removeEventListener('click', handleDeleteClick);
            btn.addEventListener('click', handleDeleteClick);
        });
    }

    function handleDeleteClick(e) {
        e.preventDefault();
        const form = e.target.closest('.delete-form');
        if (form) {
            const userName = form.getAttribute('data-user-name') || "this staff";
            document.getElementById('deleteStaffName').textContent = userName;
            deleteForm = form;
            let modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            modal.show();
        }
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

        // Confirm delete button
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            const newConfirmBtn = confirmDeleteBtn.cloneNode(true);
            confirmDeleteBtn.parentNode.replaceChild(newConfirmBtn, confirmDeleteBtn);
            newConfirmBtn.addEventListener('click', function() {
                if (deleteForm) {
                    deleteForm.submit();
                }
                let modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                if (modal) modal.hide();
            });
        }
    });

    // Open Add Modal
    function openAddModal() {
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-plus me-2"></i>New Staff';
        let form = document.getElementById('cashierForm');
        form.reset();
        form.action = "{{ route('users.store') }}";

        let methodPut = document.getElementById('methodPut');
        if (methodPut) methodPut.remove();

        @if ($user->role_id == 1)
            document.getElementById('roleSelect').disabled = false;
            document.getElementById('branchSelect').disabled = false;
        @endif

        let modal = new bootstrap.Modal(document.getElementById('cashierModal'));
        modal.show();
    }

    // Open Edit Modal
    function openEditModal(id, name, email, role_id, branch_id) {
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-user-edit me-2"></i>Edit Staff';

        let form = document.getElementById('cashierForm');
        form.reset();
        form.action = "/users/" + id;

        if (!document.getElementById('methodPut')) {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "_method";
            input.value = "PUT";
            input.id = "methodPut";
            form.appendChild(input);
        }

        document.getElementById('name').value = name;
        document.getElementById('email').value = email;

        @if ($user->role_id == 1)
            let roleSelect = document.getElementById('roleSelect');
            for (let option of roleSelect.options) {
                option.selected = option.value == role_id;
            }
            roleSelect.disabled = false;

            if (branch_id && branch_id !== 'null') {
                let branchSelect = document.getElementById('branchSelect');
                for (let option of branchSelect.options) {
                    option.selected = option.value == branch_id;
                }
                branchSelect.disabled = false;
            }
        @endif

        let modal = new bootstrap.Modal(document.getElementById('cashierModal'));
        modal.show();
    }

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

    // Auto show new user modal
    @if (session('new_user'))
        document.addEventListener("DOMContentLoaded", function() {
            let modal = new bootstrap.Modal(document.getElementById('newUserModal'));
            modal.show();
        });
    @endif
</script>

@include('layout.footer')
