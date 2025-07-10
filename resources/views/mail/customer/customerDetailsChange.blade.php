<!DOCTYPE html>
<html>
<head>
    <title>Update Notification</title>
</head>
<body>
    <p>Dear {{ $customer->name }},</p>

    <p>We wanted to let you know that your <strong>{{ ucfirst($changeFieldName) }}</strong> has been updated to:</p>

    <p style="font-size: 18px; color: green;"><strong>{{ $newValue }}</strong></p>

    <p>If you did not request this change, please contact our support team immediately.</p>

    <br>
    <p>Thank you,<br>FCTI Team</p>
</body>
</html>
