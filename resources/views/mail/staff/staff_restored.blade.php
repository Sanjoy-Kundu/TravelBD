<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Restored - FCTI Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            color: #0056b3;
        }

        .content {
            margin-top: 20px;
            line-height: 1.6;
        }

        .button {
            margin-top: 30px;
            text-align: center;
        }

        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Staff Account Restored</h2>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $staff->name }}</strong>,</p>

            <p>We are pleased to inform you that your staff account ({{ $staff->email }}) has been successfully <strong>restored</strong>.</p>

            <p>You now have full access to your dashboard and can resume your activities as usual.</p>


            <p>If you encounter any issues, feel free to contact our support team.</p>
        </div>

        <div class="footer">
            Regards,<br>
            <strong>FCTI Admin</strong>
        </div>
    </div>
</body>
</html>
