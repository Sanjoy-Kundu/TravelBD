<!DOCTYPE html>
<html>
<head>
    <title>Admin OTP</title>
</head>
<body>
    <h2>Hello, {{ $admin->name }}</h2>
    <p>Your OTP Code is: <strong>{{ $admin->otp }}</strong></p>
    <p>This code will expire at: {{ \Carbon\Carbon::parse($admin->otp_expires_at)->format('h:i:s A') }}</p>
</body>
</html>
