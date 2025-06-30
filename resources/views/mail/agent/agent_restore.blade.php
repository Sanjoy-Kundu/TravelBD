<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agent Account Restored</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        h2 {
            color: #2c7be5;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2c7be5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dear {{ $agent->name }},</h2>

        <p>We are pleased to inform you that your agent account has been <strong>successfully restored</strong> in our system.</p>

        <p>You can now log in and access all your previous data and features as usual.</p>

        <p>If you have any questions or need assistance, please feel free to contact our support team.</p>

        <a href="{{ url('/agent/login') }}" class="button">Login to Your Account</a>

        <div class="footer">
            <p>Best regards,<br><strong>FCTI</strong><br>Support Team</p>
        </div>
    </div>
</body>
</html>
