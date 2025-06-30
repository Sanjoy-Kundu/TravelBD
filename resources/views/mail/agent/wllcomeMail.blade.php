<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to FCTI</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f8fa;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #e0e0e0;
        }

        .header {
            text-align: center;
            color: #2c3e50;
        }

        .section-title {
            font-size: 18px;
            margin-top: 25px;
            font-weight: bold;
            color: #333333;
        }

        .info {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            line-height: 1.6;
        }

        .info strong {
            display: inline-block;
            width: 150px;
            color: #2c3e50;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #555555;
            text-align: center;
        }

        .footer strong {
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2 class="header">🎉 Welcome to FCTI, {{ $agent->name }}!</h2>

        <p>We're excited to have you on board as a valued team member. Below are your login credentials and account details:</p>

        <div class="section-title">🧾 Account Details</div>
        <div class="info">
            <p><strong>Agent Code Uniquely:</strong> {{ $agent->agent_code }}</p>
            <p><strong>Email:</strong> {{ $agent->email }}</p>
            <p><strong>Temporary Password:</strong> {{ $password }}</p>
            <p><strong>OTP:</strong> {{ $agent->otp }}</p>
        </div>

        <p style="margin-top: 25px;">Please login using the above credentials and update your password after first login.</p>

        <p>If you face any issues logging in or verifying your account, feel free to reach out to our support team.</p>

        <div class="footer">
            <p>Thanks & Regards,<br><strong>FCTI Team</strong></p>
        </div>
    </div>
</body>
</html>
