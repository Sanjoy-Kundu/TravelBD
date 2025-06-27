<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Account Suspended</title>
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
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
    }
    .header {
      border-bottom: 2px solid #ffc107;
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
    .highlight {
      background-color: #fff3cd;
      color: #856404;
      padding: 12px 15px;
      border-radius: 6px;
      font-weight: 600;
      margin-bottom: 25px;
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
      <h1>Account Suspended</h1>
    </div>

    <div class="content">
      <p>Dear <strong>{{ $staffName }}</strong>,</p>

      <p class="highlight">Your staff account has been temporarily suspended by the system administrator.</p>

      <p>
        If you believe this action was made in error or if you need further clarification,
        please contact the administrator immediately to regain access.
      </p>

      <p>
        Our support team is here to assist you. Don’t hesitate to reach out through our official support channels.
      </p>

      <p>Thank you for your attention and cooperation.</p>
    </div>

    <div class="footer">
      <p>Best Regards,</p>
      <p><strong>FCTI Admin</strong></p>
      <p style="font-size: 12px; color: #999;">This is an automated notification. Please do not reply directly to this email.</p>
    </div>
  </div>
</body>
</html>
