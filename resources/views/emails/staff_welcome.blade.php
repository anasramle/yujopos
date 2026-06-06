<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $companyName }}</title>
    <style>
        body {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            /* background-color: #dfdac4; */
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            /* background: #dfdac4; */
            /* border: 1px solid #644d3c; */
            border-radius: 24px;
            overflow: hidden;
            /* box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25); */
        }
        .email-header {
            /* background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%); */
            color: #dfdac4;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .email-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .email-body {
            padding: 30px;
            /* color: #644d3c; */
        }
        .email-body h2 {
            margin-top: 0;
            font-size: 20px;
            font-weight: 600;
            /* border-left: 4px solid #644d3c; */
            padding-left: 15px;
        }
        .staff-details {
            /* background: #c9c2ae; */
            border-radius: 16px;
            padding: 20px;
            margin: 20px 0;
        }
        .staff-details p {
            margin: 10px 0;
            font-size: 15px;
        }
        .staff-details strong {
            font-weight: 700;
            min-width: 100px;
            display: inline-block;
        }
        .password-box {
            /* background: #644d3c; */
            /* color: #dfdac4; */
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            margin: 20px 0;
        }
        .password-box code {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            background: transparent;
            /* color: #dfdac4; */
        }
        .warning-text {
            /* background: #fff3cd; */
            /* border-left: 4px solid #ffc107; */
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            /* color: #856404; */
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            /* background: linear-gradient(135deg, #644d3c 0%, #4a3629 100%); */
            /* color: #dfdac4; */
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .button:hover {
            transform: translateY(-2px);
            /* box-shadow: 0 8px 20px rgba(100, 77, 60, 0.3); */
        }
        .email-footer {
            /* background: #c9c2ae; */
            padding: 15px;
            text-align: center;
            font-size: 12px;
            /* color: #644d3c; */
            /* border-top: 1px solid #644d3c; */
        }
        @media (max-width: 500px) {
            .email-body {
                padding: 20px;
            }
            .staff-details p {
                font-size: 13px;
            }
            .password-box code {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $companyName }}</h1>
            <p>Yujo POS - Where Business Flows Better</p>
        </div>

        <div class="email-body">
            <h2>Welcome, {{ $staff->name }}! 👋</h2>

            <p>You have been added as a staff member to <strong>{{ $companyName }}</strong></p>

            <div class="staff-details">
                <p><strong><i class="fas fa-user"></i> Name:</strong> {{ $staff->name }}</p>
                <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ $staff->email }}</p>
                <p><strong><i class="fas fa-store"></i> Branch:</strong> {{ $staff->branch->branch_name ?? 'N/A' }}</p>
                <p><strong><i class="fas fa-users"></i> Role:</strong> {{ $staff->role->role ?? 'Staff' }}</p>
            </div>

            <div class="password-box">
                <p style="margin-bottom: 8px;"><strong>Temporary Password</strong></p>
                <code>{{ $tempPassword }}</code>
            </div>

            <div class="warning-text">
                <strong>⚠️ Important:</strong> Please change your password upon first login for security purposes.
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/') }}" class="button">Login to Your Account</a>
            </p>

            <p style="font-size: 13px; margin-top: 20px;">If you did not expect this email, please contact your system administrator.</p>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
            <p>Powered by Yujo POS</p>
        </div>
    </div>
</body>
</html>
