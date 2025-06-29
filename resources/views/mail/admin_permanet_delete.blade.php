<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Permanently Deleted - FCTI Admin</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .header h2 {
            color: #dc3545;
            margin: 0;
        }

        .content {
            margin-top: 20px;
            line-height: 1.7;
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

        .highlight {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Account Permanently Deleted</h2>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $admin->name }}</strong>,</p>

            <p>We want to inform you that your account associated with the email <strong>{{ $admin->email }}</strong> has been <span class="highlight">permanently deleted</span> from our system.</p>

            <p>All access to your dashboard and related functionalities has been revoked. Your data and associated records have also been completely removed as per our system policy.</p>

            <p>If you believe this was a mistake or have any questions, please contact our support team immediately.</p>
        </div>

        <div class="footer">
            Regards,<br>
            <strong>FCTI Admin Team</strong>
        </div>
    </div>
</body>
</html>
