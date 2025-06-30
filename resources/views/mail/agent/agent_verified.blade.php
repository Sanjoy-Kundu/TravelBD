<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account Verified</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #28a745;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #28a745;
            font-size: 26px;
            margin: 0;
        }
        .content p {
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .highlight {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 6px;
            font-weight: 600;
            margin: 25px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #e1e1e1;
            padding-top: 15px;
            margin-top: 40px;
        }
        .footer p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff !important;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        @media only screen and (max-width: 620px) {
            .email-container {
                padding: 25px 20px;
            }
            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>✅ You're Now Verified!</h1>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $agent->name }}</strong>,</p>

            <p class="highlight">Congratulations! Your account has been successfully verified.</p>

            <p>
                You are now an authorized staff member in our system.  
                You can <strong>log in</strong> using your registered email: <strong>{{ $agent->email }}</strong> and start managing your assigned tasks from the dashboard.
            </p>

            <p>
                Please ensure you follow all staff guidelines while performing your duties. If you need any help, feel free to contact the admin team.
            </p>

            <p style="text-align: center;">
                <a href="{{ url('/agent/login') }}" class="btn">Login to Dashboard</a>
            </p>

            <p>We are happy to have you on the team!</p>
        </div>

        <div class="footer">
            <p>Best Regards,</p>
            <p><strong>FCTI Admin Team</strong></p>
            <p style="font-size: 12px;">This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
