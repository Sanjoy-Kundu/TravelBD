<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Staff Account Deleted</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 40px 30px;
        }
        .header {
            border-bottom: 2px solid #dc3545;
            padding-bottom: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        .header h1 {
            color: #dc3545;
            font-size: 28px;
            margin: 0;
        }
        .content p {
            line-height: 1.6;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .content p strong {
            color: #dc3545;
        }
        .footer {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-top: 40px;
            border-top: 1px solid #e1e1e1;
            padding-top: 15px;
        }
        .footer p {
            margin: 5px 0;
        }
        .highlight {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 6px;
            font-weight: 600;
            margin-bottom: 25px;
        }
        @media only screen and (max-width: 620px) {
            .email-container {
                padding: 25px 20px;
            }
            .header h1 {
                font-size: 24px;
            }
            .content p {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Staff Account Deleted</h1>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $staffName }}</strong>,</p>

            <p>We want to inform you that your staff account associated with the email <strong>{{ $staffEmail }}</strong> has been <span class="highlight">deleted successfully</span> by the system administrator due to verification failure.</p>

            <p>If you believe this was done by mistake or require assistance, please contact our support team immediately.</p>

            <p>Thank you for your understanding and cooperation.</p>
        </div>

        <div class="footer">
            <p>Best Regards,</p>
            <p><strong>FCTI Team</strong></p>
            <p style="font-size: 12px; color: #999;">This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
