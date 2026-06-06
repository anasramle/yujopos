<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - Yujo POS</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ========== ULTRA COMPACT LUXURY THEME ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #dfdac4 0%, #c9c2ae 50%, #644d3c 100%);
            color: #644d3c;
            font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
        }

        /* ========== MAIN CONTAINER ========== */
        .onboarding-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0.5rem;
        }

        /* ========== ULTRA COMPACT CARD ========== */
        .onboarding-card {
            max-width: 480px;
            width: 100%;
            background: #dfdac4;
            border: 1px solid #644d3c;
            border-radius: 20px;
            box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* ========== ULTRA COMPACT CARD BODY ========== */
        .card-body-luxury {
            padding: 0.7rem 1.25rem 1rem;
        }

        /* ========== HEADER SECTION - ULTRA COMPACT ========== */
        .welcome-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.2rem;
            box-shadow: 0 2px 5px rgba(100, 77, 60, 0.3);
        }

        .welcome-icon i {
            font-size: 18px;
            color: #dfdac4;
        }

        .page-title-luxury {
            font-size: 20px;
            font-weight: 700;
            color: #4a3629;
            text-align: center;
            margin-bottom: 0.05rem;
            letter-spacing: -0.5px;
        }

        .greeting-text {
            text-align: center;
            color: #a0927e;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 0.1rem;
        }

        .setup-text {
            text-align: center;
            color: #a0927e;
            font-size: 12px;
            margin-bottom: 0.5rem;
            padding-bottom: 0.2rem;
            border-bottom: 1px solid #c9c2ae;
        }

        /*  STEP INDICATOR    */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.35rem;
            gap: 0.2rem;
        }

        .step {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .step .circle {
            width: 26px;
            height: 26px;
            background: #c9c2ae;
            border: 1.5px solid #644d3c;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            color: #644d3c;
            transition: all 0.3s ease;
        }

        .step.active .circle {
            background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
            border-color: #dfdac4;
            color: #dfdac4;
            box-shadow: 0 1px 3px rgba(100, 77, 60, 0.3);
            transform: scale(1.02);
        }

        .step.completed .circle {
            background: #6B7B3A;
            border-color: #6B7B3A;
            color: #dfdac4;
        }

        .step .label {
            font-size: 10px;
            font-weight: 600;
            margin-top: 0.15rem;
            color: #a0927e;
            letter-spacing: 0.3px;
        }

        .step.active .label {
            color: #4a3629;
            font-weight: 700;
        }

        .step.completed .label {
            color: #6B7B3A;
        }

        .luxury-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, #644d3c, transparent);
            margin: 0.3rem 0 0.5rem;
        }

        .title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.05rem;
        }

        .step-title {
            font-size: 16px;
            font-weight: 700;
            color: #4a3629;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .step-subtitle {
            font-size: 12px;
            color: #a0927e;
            margin-bottom: 0.35rem;
            letter-spacing: 0.3px;
        }

        .skip-btn-inline {
            background: transparent;
            border: 1.5px solid #c9c2ae;
            color: #a0927e;
            padding: 2px 8px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            cursor: pointer;
        }

        .skip-btn-inline:hover {
            background: #644d3c20;
            border-color: #644d3c;
            color: #644d3c;
            transform: translateY(-1px);
        }

        .form-group {
            margin-bottom: 0.35rem;
        }

        .form-label-luxury {
            font-weight: 600;
            color: #644d3c;
            margin-bottom: 0.15rem;
            font-size: 12px;
            letter-spacing: 0.3px;
            display: block;
        }

        .form-label-luxury i {
            margin-right: 3px;
            width: 12px;
            font-size: 12px;
            color: #a0927e;
        }

        .label-with-optional {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #644d3c;
            margin-bottom: 0.15rem;
            font-size: 11px;
            letter-spacing: 0.3px;
        }

        .label-left {
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .optional-badge {
            font-size: 10px;
            font-weight: 400;
            color: #a0927e;
            background: #dfdac4;
            padding: 1px 6px;
            border-radius: 20px;
            letter-spacing: normal;
        }

        .optional-badge i {
            font-size: 0.5rem;
            margin-right: 2px;
            width: auto;
        }

        .form-control-luxury {
            background: #dfdac4;
            border: 1.5px solid #c9c2ae;
            border-radius: 40px;
            padding: 4px 10px;
            color: #4a3629;
            font-size: 12px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control-luxury:focus {
            outline: none;
            border-color: #644d3c;
            box-shadow: 0 0 0 2px rgba(100, 77, 60, 0.15);
            background: #efe9d0;
        }

        select.form-control-luxury {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23644d3c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        /* File input styling */
        input[type="file"].form-control-luxury {
            padding: 2px 6px;
        }

        input[type="file"].form-control-luxury::-webkit-file-upload-button {
            background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
            color: #dfdac4;
            border: none;
            padding: 2px 8px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.55rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 6px;
        }

        input[type="file"].form-control-luxury::-webkit-file-upload-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 1px 3px rgba(100, 77, 60, 0.3);
        }

        .btn-luxury {
            background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
            border: none;
            color: #dfdac4;
            padding: 5px 12px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            width: 100%;
            cursor: pointer;
        }

        .btn-luxury:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(100, 77, 60, 0.35);
            background: linear-gradient(135deg, #7a5d4a 0%, #5e4535 100%);
            color: #dfdac4;
        }

        .btn-luxury:active {
            transform: translateY(0);
        }

        .complete-icon {
            width: 45px;
            height: 45px;
            background: #dfdac4;
            color: #dfdac4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            /* box-shadow: 8px 8px 8px 8px rgba(107, 123, 58, 0.3); */
        }

        .complete-icon i {
            font-size: 46px;
            color: #6B7B3A;
        }

        .complete-title {
            font-size: 1rem;
            font-weight: 700;
            color: #4a3629;
            text-align: center;
            margin-bottom: 0.15rem;
        }

        .complete-text {
            text-align: center;
            color: #a0927e;
            font-size: 0.55rem;
            margin-bottom: 0.7rem;
        }

        .modal-luxury .modal-content {
            background: #dfdac4;
            border: 1px solid #644d3c;
            border-radius: 18px;
            box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.5);
        }

        .modal-luxury .modal-header {
            background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
            color: #dfdac4;
            border-bottom: 2px solid #644d3c;
            border-radius: 17px 17px 0 0;
            padding: 0.5rem 0.8rem;
        }

        .modal-luxury .modal-title {
            color: #dfdac4;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .modal-luxury .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-luxury .modal-body {
            padding: 0.6rem 0.8rem;
            color: #644d3c;
        }

        .modal-luxury .modal-footer {
            border-top: 1px solid #c9c2ae;
            padding: 0.5rem 0.8rem;
            gap: 5px;
        }

        .btn-modal-secondary {
            background: #c9c2ae;
            border: none;
            color: #644d3c;
            padding: 4px 12px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.65rem;
            transition: all 0.3s ease;
        }

        .btn-modal-secondary:hover {
            background: #b8b3a1;
            transform: translateY(-1px);
        }

        .text-muted {
            font-size: 12px !important;
        }

        .logo {
            max-height: 55px;
            filter: drop-shadow(0 3px 6px rgba(100, 77, 60, 0.2));
        }
    </style>
</head>

<body>
    <div class="onboarding-wrapper">
        <div class="onboarding-card">
            <div class="card-body-luxury">

                <!-- Header Section -->
                <div class="welcome-icon">
                    <i class="fas fa-store"></i>
                </div>
                {{-- <h1 class="page-title-luxury">Yujo POS</h1> --}}
                <p class="greeting-text">Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
                <p class="setup-text">
                    <i class="fas fa-magic me-1"></i> Let's set up your store in 3 simple steps
                </p>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step {{ $step >= 1 ? ($step > 1 ? 'completed' : 'active') : '' }}">
                        <div class="circle">
                            @if ($step > 1)
                                <i class="fas fa-check"></i>
                            @else
                                1
                            @endif
                        </div>
                        <div class="label">BRANCH</div>
                    </div>

                    <div class="step {{ $step >= 2 ? ($step > 2 ? 'completed' : 'active') : '' }}">
                        <div class="circle">
                            @if ($step > 2)
                                <i class="fas fa-check"></i>
                            @else
                                2
                            @endif
                        </div>
                        <div class="label">CATEGORY</div>
                    </div>

                    <div class="step {{ $step >= 3 ? ($step > 3 ? 'completed' : 'active') : '' }}">
                        <div class="circle">
                            @if ($step > 3)
                                <i class="fas fa-check"></i>
                            @else
                                3
                            @endif
                        </div>
                        <div class="label">PRODUCT</div>
                    </div>
                </div>

                <hr class="luxury-divider">

                <!-- STEP 1: BRANCH -->
                @if ($step == 1)
                    <div class="title-row">
                        <div class="step-title">
                            <i class="fas fa-building" style="color: #644d3c;"></i>
                            Branch
                        </div>
                        <a href="#" class="skip-btn-inline" data-bs-toggle="modal" data-bs-target="#skipModal">
                            <i class="fas fa-forward-step"></i> Skip
                        </a>
                    </div>
                    <p class="step-subtitle">Create first branch</p>
                    <form method="POST" action="{{ route('onboarding.branch') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-tag"></i> Branch Name
                            </label>
                            <input type="text" name="branch_name" class="form-control-luxury" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-location-dot"></i> Address
                            </label>
                            <input type="text" name="address" class="form-control-luxury" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-mail-bulk"></i> Postcode
                            </label>
                            <input type="text" name="postcode" class="form-control-luxury" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-phone-alt"></i> Phone
                            </label>
                            <input type="text" name="phone" class="form-control-luxury" required>
                        </div>

                        <button type="submit" class="btn-luxury">
                            <i class="fas fa-arrow-right me-1"></i> NEXT
                        </button>
                    </form>
                @endif

                <!-- STEP 2: CATEGORY -->
                @if ($step == 2)
                    <div class="title-row">
                        <div class="step-title">
                            <i class="fas fa-folder-tree" style="color: #644d3c;"></i>
                            Category
                        </div>
                        <a href="#" class="skip-btn-inline" data-bs-toggle="modal" data-bs-target="#skipModal">
                            <i class="fas fa-forward-step"></i> Skip
                        </a>
                    </div>
                    <p class="step-subtitle">Add first category (Food, Drinks, etc.)</p>
                    <form method="POST" action="{{ route('onboarding.category') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-folder"></i> Category Name
                            </label>
                            <input type="text" name="name" class="form-control-luxury" required>
                        </div>

                        <button type="submit" class="btn-luxury">
                            <i class="fas fa-arrow-right me-1"></i> NEXT
                        </button>
                    </form>
                @endif

                <!-- STEP 3: PRODUCT -->
                @if ($step == 3)
                    <div class="title-row">
                        <div class="step-title">
                            <i class="fas fa-box" style="color: #644d3c;"></i>
                            Product
                        </div>
                        <a href="#" class="skip-btn-inline" data-bs-toggle="modal"
                            data-bs-target="#skipModal">
                            <i class="fas fa-forward-step"></i> Skip
                        </a>
                    </div>
                    <p class="step-subtitle">Add first product</p>
                    <form method="POST" action="{{ route('onboarding.product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-cube"></i> Product Name
                            </label>
                            <input type="text" name="item_name" class="form-control-luxury" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-tag"></i> Price (RM)
                            </label>
                            <input type="number" step="0.01" name="price" class="form-control-luxury"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-layer-group"></i> Quantity
                            </label>
                            <input type="number" name="quantity" class="form-control-luxury" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-folder-open"></i> Category
                            </label>
                            <select name="category_id" class="form-control-luxury" required>
                                <option value="" disabled selected>Select category</option>
                                @foreach (\App\Models\Category::where('company_id', Auth::user()->company_id)->get() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label class="form-label-luxury">
                                <i class="fas fa-image"></i> Product Image
                            </label>
                            <input type="file" name="img" class="form-control-luxury" accept="image/*">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i> Optional, recommended for better display
                            </small>
                        </div> --}}

                        <div class="form-group">
                            <div class="form-label-luxury">
                                <span class="label-left">
                                    <i class="fas fa-image"></i> Product Image
                                </span>
                                <span class="optional-badge">
                                    <i class="fas fa-info-circle"></i> Optional, recommended for better display
                                </span>
                            </div>
                            <input type="file" name="img" class="form-control-luxury" accept="image/*">
                        </div>

                        <button type="submit" class="btn-luxury">
                            <i class="fas fa-check-circle me-1"></i> Complete
                        </button>
                    </form>
                @endif

                <!-- STEP 4: COMPLETE -->
                @if ($step == 4)
                    <div class="complete-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="complete-title">Setup Complete!</div>
                    <div class="complete-text">
                        Your store is ready!
                    </div>

                    <form method="POST" action="{{ route('onboarding.complete') }}">
                        @csrf
                        <button type="submit" class="btn-luxury">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>

   <!-- Modal for skip confirmation -->
    <div class="modal fade modal-luxury" id="skipModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle me-2"></i>Skip Setup?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-store" style="font-size: 40px; color: #a0927e; margin-bottom: 10px;"></i>
                    <p style="font-size: 0.85rem;">You can complete the store setup later.</p>
                    <p class="text-muted small">Would you like to skip for now?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('onboarding.skip') }}" class="btn-luxury"
                        style="width: auto; padding: 6px 20px;text-decoration: none;">
                        <i class="fas fa-check me-1"></i> Yes, Skip
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
