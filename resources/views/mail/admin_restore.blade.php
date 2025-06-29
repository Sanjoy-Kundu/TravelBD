<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Restored - FCTI Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .header h2 {
            color: #007bff;
            margin: 0;
        }

        .content {
            margin-top: 20px;
            line-height: 1.6;
            font-size: 16px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 25px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Admin Account Restored</h2>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $admin->name }}</strong>,</p>

            <p>We are happy to inform you that your admin account ({{ $admin->email }}) has been successfully <strong>restored</strong>.</p>

            <p>You now have full access to your admin dashboard and system functionalities.</p>

            <p>If you have any questions or need assistance, please contact our support team.</p>

            <div class="text-center" style="text-align:center;">
                <a href="{{ url('/admin/login') }}" class="btn">Go to Admin Dashboard</a>
            </div>
        </div>

        <div class="footer">
            Thanks & Regards,<br>
            <strong>FCTI Admin Team</strong>
        </div>
    </div>
</body>
</html>
