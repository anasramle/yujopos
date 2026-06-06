@include('layout.header')

<style>
    .profile-container {
        min-height: calc(100vh - 56px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: linear-gradient(135deg, #dfdac4 0%, #c9c2ae 100%);
    }

    .profile-card {
        max-width: 900px;
        width: 100%;
        background: #dfdac4;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-wrap: wrap;
    }

    /* Left Side - Profile Info */
    .profile-sidebar {
        flex: 1;
        min-width: 240px;
        background: linear-gradient(135deg, #4a3629 0%, #644d3c 100%);
        padding: 1.2rem;
        text-align: center;
        color: #dfdac4;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: #dfdac4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    }

    .profile-avatar i {
        font-size: 48px;
        color: #4a3629;
    }

    .profile-sidebar h3 {
        margin: 0.2rem 0;
        font-weight: 700;
        font-size: 1rem;
    }

    .profile-sidebar .role-badge {
        background: rgba(223, 218, 196, 0.2);
        display: inline-block;
        padding: 3px 12px;
        border-radius: 40px;
        font-size: 10px;
        font-weight: 600;
        margin: 0.5rem 0;
    }

    .profile-stats {
        margin-top: 1rem;
        text-align: left;
        border-top: 1px solid rgba(223, 218, 196, 0.2);
        padding-top: 0.8rem;
    }

    .profile-stats .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0.6rem;
        font-size: 11px;
    }

    .profile-stats .stat-item i {
        width: 24px;
        text-align: center;
        font-size: 11px;
    }

    /* Right Side - Forms*/
    .profile-content {
        flex: 2;
        padding: 1.2rem 1.5rem;
        background: #dfdac4;
    }

    .form-section {
        margin-bottom: 1.2rem;
    }

    .form-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #4a3629;
        margin-bottom: 1rem;
        padding-bottom: 0.3rem;
        border-bottom: 2px solid #644d3c;
        display: inline-block;
    }

    .form-group {
        margin-bottom: 0.8rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: #644d3c;
        font-size: 11px;
    }

    .form-control-luxury {
        width: 100%;
        background: #f5f0e0;
        border: 1px solid #c9c2ae;
        border-radius: 40px;
        padding: 8px 16px;
        color: #644d3c;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .form-control-luxury:focus {
        outline: none;
        border-color: #644d3c;
        box-shadow: 0 0 0 3px rgba(100, 77, 60, 0.15);
        background: #fff;
    }

    .btn-luxury {
        background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%);
        border: none;
        color: #dfdac4;
        padding: 8px 20px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(100, 77, 60, 0.3);
    }

    .alert-custom {
        background: #644d3c;
        color: #dfdac4;
        border-radius: 40px;
        padding: 8px 16px;
        font-size: 12px;
        margin-bottom: 1rem;
    }

    @media (max-width: 500px) {
        .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
            padding-left: 225px;
            top: 56px;
        }

        .profile-card {
            flex-direction: column;
        }

        .profile-container {
            padding: 0.8rem;
        }

        .profile-sidebar {
            min-width: auto;
        }
    }

    @media (min-width: 501px) and (max-width: 950px) {
        .sb-nav-fixed #layoutSidenav #layoutSidenav_content {
            padding-left: 225px;
            top: 56px;
        }

    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="profile-container">
            <div class="profile-card">
                <!-- Left Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-avatar">
                        <i class="fas fa-user-circle" style="color:#644d3c; height:80px;"></i>
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <div class="role-badge">
                        <i class="fas fa-shield-alt me-1"></i> {{ $user->role->role ?? 'Administrator' }}
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Joined {{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="profile-content">
                    @if (session('success'))
                        <div class="alert alert-custom mb-2" id="autoHideAlert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-custom mb-2" id="autoHideAlert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0 ps-3" style="font-size: 11px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Profile Form -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </div>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control-luxury"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control-luxury"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control-luxury"
                                    value="{{ old('company_name', $company->company_name ?? '') }}" required>
                            </div>
                            <button type="submit" class="btn-luxury">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </form>
                    </div>

                    <!-- Password Form -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-key me-2"></i>Security
                        </div>
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control-luxury" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control-luxury" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control-luxury"
                                    required>
                            </div>
                            <button type="submit" class="btn-luxury">
                                <i class="fas fa-lock me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
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
