<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Hello {{ $customer->name }},</h2>

    <p>Welcome to FCTI!</p>

    <p>Your account has been created successfully.</p>

    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($customer->date_of_birth)->format('d M Y') }}</p>

    <p>You can log in using your email and date of birth as password.</p>

    <a href="{{ url('/customer/login') }}">Login to Dashboard</a>

    <br><br>
    <p>Thanks,<br>FCTI Team</p>
</body>
</html>
