<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Resend OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 30px auto;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #104ccc;
            font-size: 28px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }
        .otp-code {
            display: inline-block;
            background-color: #e1f0ff;
            color: #104ccc;
            font-weight: 700;
            font-size: 22px;
            padding: 10px 20px;
            border-radius: 6px;
            letter-spacing: 4px;
            margin: 15px 0;
            user-select: all;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $staffEmail }}</h1>

        <p>We received a request to resend your One-Time Password (OTP). Use the code below to complete your verification process:</p>

        <p class="otp-code">{{ $newOtp }}</p>

        <p>This OTP is valid for the next 20 minutes. Please do not share this code with anyone for your account's security.</p>

        <p>If you did not request this code, please ignore this email or contact our support team immediately.</p>

        <div class="footer">
            Regards,<br>
            <strong>FCTI Admin</strong>
        </div>
    </div>
</body>
</html>
