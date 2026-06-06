<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Yujo POS - Luxury Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #dfdac4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
        }

        /* Decorative elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(100, 77, 60, 0.08) 0%, rgba(223, 218, 196, 0) 70%);
            pointer-events: none;
        }

        /* Main Luxury Card */
        .luxury-card {
            background: #dfdac4;
            border-radius: 28px;
            border: 1px solid #644d3c;
            box-shadow: 0 15px 35px -12px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(100, 77, 60, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 1.2rem 1.5rem 1.5rem;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .accent-color {
            color: #644d3c;
        }

        .btn-primary-custom {
            background: #644d3c;
            border: none;
            color: #dfdac4;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 40px;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .btn-primary-custom:hover {
            background: #533f31;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(100, 77, 60, 0.3);
            color: #dfdac4;
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid #644d3c;
            color: #644d3c;
            padding: 8px 12px;
            border-radius: 40px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .btn-outline-custom:hover {
            background: rgba(100, 77, 60, 0.1);
            color: #644d3c;
            transform: translateY(-1px);
        }

        /* Input Styling */
        .luxury-input {
            background: #dfdac4;
            border: 1px solid #644d3c;
            border-radius: 40px;
            padding: 8px 16px;
            color: #644d3c;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .luxury-input:focus {
            background: #f5f0e0;
            border-color: #644d3c;
            box-shadow: 0 0 0 2px rgba(100, 77, 60, 0.15);
            color: #644d3c;
            outline: none;
        }

        .luxury-input::placeholder {
            color: #8b7a6b;
            font-size: 0.75rem;
        }

        /* Autofill fix */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #dfdac4 inset !important;
            -webkit-text-fill-color: #644d3c !important;
            background-color: #dfdac4 !important;
            border-color: #644d3c;
        }

        /* Toggle Buttons */
        .toggle-container {
            background: rgba(100, 77, 60, 0.1);
            border-radius: 50px;
            padding: 3px;
            display: inline-flex;
            width: 100%;
            margin-bottom: 1.2rem;
        }

        .toggle-btn {
            flex: 1;
            background: transparent;
            border: none;
            color: #644d3c;
            font-weight: 600;
            padding: 6px 0;
            border-radius: 40px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .toggle-btn.active {
            background: #644d3c;
            color: #dfdac4;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Form Panels */
        .form-panel {
            transition: all 0.4s ease;
            animation: fadeIn 0.5s ease;
        }

        .form-panel.hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Alert Styling */
        .alert-custom {
            background: #644d3c;
            border-left: 3px solid #a18466;
            color: #dfdac4;
            border-radius: 40px;
            padding: 8px 14px;
            font-size: 0.7rem;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 0.8rem !important;
        }

        .alert-danger-custom {
            border-left-color: #a18466;
            color: #dfdac4;
            background: #644d3c;
        }

        /* Logo */
        .logo {
            max-height: 55px;
            filter: drop-shadow(0 3px 6px rgba(100, 77, 60, 0.2));
        }

        /* Links */
        .link-custom {
            color: #644d3c;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.75rem;
        }

        .link-custom:hover {
            color: #3d2e23;
            text-decoration: underline;
        }

        /* Form group spacing */
        .mb-3 {
            margin-bottom: 0.7rem !important;
        }

        /* Text styles  */
        .text-secondary {
            font-size: 0.8rem !important;
        }

        .small, small {
            font-size: 0.65rem !important;
        }

        h3 {
            font-size: 1.1rem !important;
            margin-top: 0.4rem !important;
            margin-bottom: 0.2rem !important;
        }

        /* Responsive */
        @media (max-width: 560px) {
            .luxury-card {
                padding: 1rem 1.2rem 1.2rem;
                margin: 10px;
            }

            .toggle-btn {
                font-size: 0.7rem;
                padding: 5px 0;
            }

            .logo {
                max-height: 48px;
            }

            .luxury-input {
                padding: 6px 14px;
                font-size: 0.75rem;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                padding: 6px 10px;
                font-size: 0.75rem;
            }

            h3 {
                font-size: 1rem !important;
            }
        }
    </style>
</head>
<body>

<div class="luxury-card">
    <div class="text-center mb-2">
        <img src="{{ asset('assets/img/logo 2.png') }}" alt="Yujo POS" class="logo">
        <h3 class="accent-color" style="font-weight: 500;">YUJO POS</h3>
        <p class="text-secondary">Where Business Flows Better</p>
    </div>

    <!-- Toggle Buttons -->
    <div class="toggle-container">
        <button class="toggle-btn active" id="showLoginBtn">Sign In</button>
        <button class="toggle-btn" id="showRegisterBtn">Sign Up</button>
        <button class="toggle-btn" id="showForgotBtn">Reset</button>
    </div>

    <!-- LOGIN PANEL -->
    <div id="loginPanel" class="form-panel">
        @if (session('status') && !request()->has('show'))
            <div class="alert alert-custom mb-3" id="autoHideAlert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any() && !request()->has('show'))
            <div class="alert alert-custom alert-custom mb-3" id="autoHideAlert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control luxury-input" placeholder="Email Address" required autocomplete="email">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control luxury-input" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100">Sign In</button>
        </form>
    </div>

    <!--  REGISTER PANEL  -->
    <div id="registerPanel" class="form-panel hidden">
        @if ($errors->any() && request()->get('show') == 'register')
            <div class="alert alert-custom alert-custom mb-3" id="autoHideAlert">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status') && request()->get('show') == 'register')
            <div class="alert alert-custom mb-3" id="autoHideAlert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control luxury-input" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control luxury-input" placeholder="Email Address" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control luxury-input" placeholder="Password (min. 6 chars)" required>
            </div>
            <div class="mb-3">
                <input type="text" name="company_name" class="form-control luxury-input" placeholder="Company Name" required>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100">Create Account</button>
        </form>
    </div>

    <!--  FORGOT PASSWORD PANEL  -->
    <div id="forgotPanel" class="form-panel hidden">
        @if ($errors->any() && request()->get('show') == 'forgot')
            <div class="alert alert-custom alert-custom mb-3" id="autoHideAlert">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status') && request()->get('show') == 'forgot')
            <div class="alert alert-custom mb-3" id="autoHideAlert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control luxury-input" placeholder="Your Email Address" required>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100">Send Reset Link</button>
        </form>
        <div class="text-center mt-2">
            <small class="text-muted">We'll email you a secure link to reset your password.</small>
        </div>
    </div>

    <div class="text-center mt-3">
        <small class="text-muted">© {{ date('Y') }} Yujo POS</small>
    </div>
</div>

<script>
    // DOM Elements
    const loginPanel = document.getElementById('loginPanel');
    const registerPanel = document.getElementById('registerPanel');
    const forgotPanel = document.getElementById('forgotPanel');
    const loginBtn = document.getElementById('showLoginBtn');
    const registerBtn = document.getElementById('showRegisterBtn');
    const forgotBtn = document.getElementById('showForgotBtn');

    // Function to switch panels
    function showPanel(panelToShow, updateHash = true) {
        // Hide all panels
        loginPanel.classList.add('hidden');
        registerPanel.classList.add('hidden');
        forgotPanel.classList.add('hidden');

        // Show selected panel
        panelToShow.classList.remove('hidden');

        // Update active button styles
        loginBtn.classList.remove('active');
        registerBtn.classList.remove('active');
        forgotBtn.classList.remove('active');

        if (panelToShow === loginPanel) loginBtn.classList.add('active');
        if (panelToShow === registerPanel) registerBtn.classList.add('active');
        if (panelToShow === forgotPanel) forgotBtn.classList.add('active');

        // Update URL hash for deep linking
        if (updateHash) {
            if (panelToShow === loginPanel) window.location.hash = '#login';
            if (panelToShow === registerPanel) window.location.hash = '#register';
            if (panelToShow === forgotPanel) window.location.hash = '#forgot';
        }
    }

    // Event listeners
    loginBtn.addEventListener('click', () => showPanel(loginPanel));
    registerBtn.addEventListener('click', () => showPanel(registerPanel));
    forgotBtn.addEventListener('click', () => showPanel(forgotPanel));

    // Check URL hash on page load
    function checkHashOnLoad() {
        const hash = window.location.hash;
        if (hash === '#register') {
            showPanel(registerPanel, false);
        } else if (hash === '#forgot') {
            showPanel(forgotPanel, false);
        } else {
            showPanel(loginPanel, false);
        }
    }

    // Also check if Laravel sent a 'show' parameter via GET
    function checkQueryParam() {
        const urlParams = new URLSearchParams(window.location.search);
        const showParam = urlParams.get('show');
        if (showParam === 'register') {
            showPanel(registerPanel, true);
        } else if (showParam === 'forgot') {
            showPanel(forgotPanel, true);
        }
    }

    checkHashOnLoad();
    checkQueryParam();

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        let alert = document.getElementById('autoHideAlert');
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => {
                if (alert && alert.remove) alert.remove();
            }, 500);
        }
    }, 5000);
</script>

{{-- Handle Laravel session flashes that might affect UI --}}
@if(session('force_password') || session('clear_all_cart') || session('force_reload'))
    <script>
        // Session flashes preserved - no UI conflict
        console.log('Session active: {{ session('force_password') ? "force password" : "" }}');
    </script>
@endif

</body>
</html>
