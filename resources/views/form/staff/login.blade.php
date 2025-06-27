<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="{{ asset('assets') }}/js/axios.min.js"></script>

	<link rel="icon" type="image/png" href="{{asset("assets")}}/images/site_icon.png"/>
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/main.css">
	<link href="{{asset("assets")}}/css/animate.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">

	<title>Staff Login - NJInternational Travel Agency</title>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 animate__animated animate__fadeIn">

				<!-- Logo Section -->
				<div class="login100-pic js-tilt" data-tilt>
					<img id="iconrotate" src="{{ asset('assets/images/round_logo.png') }}" alt="IMG">
				</div>

				<!-- Login Form -->
				<form class="login100-form">
					<span class="login100-form-title">
						<h1 style="color:rgb(16, 148, 220)">STAFF LOGIN</h1>
					</span>

					<!-- Email or Staff Code -->
					<div class="wrap-input100">
						<input class="input100" type="text" name="email_or_staff_code" placeholder="Email or Staff Code" id="login_email_staff_code">
						<span class="focus-input100"></span>
						<span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
					<span class="text-danger login_email_staff_code_error"></span>

					<!-- Password -->
					<div class="wrap-input100">
						<input class="input100" type="password" name="password" placeholder="Password" id="password">
						<span class="focus-input100"></span>
						<span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
					<span class="text-danger login_password_error"></span>

					<!-- Submit Button -->
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" style="background-color:rgb(16, 148, 220)" onclick="onLogin(event)">
							Login
						</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!-- JS Scripts -->
	<script src="{{asset("assets")}}/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="{{asset("assets")}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset("assets")}}/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{asset("assets")}}/vendor/select2/select2.min.js"></script>
	<script src="{{asset("assets")}}/vendor/tilt/tilt.jquery.min.js"></script>

	<script>
		$('.js-tilt').tilt({ scale: 1.1 });

		async function onLogin(event) {
			event.preventDefault();

			// Clear previous errors
			document.querySelector('.login_email_staff_code_error').innerText = '';
			document.querySelector('.login_password_error').innerText = '';

			// Get inputs
			let email_or_staff_code = document.getElementById('login_email_staff_code').value.trim();
			let password = document.getElementById('password').value.trim();

			let isError = false;

			// Validation
			if (!email_or_staff_code) {
				document.querySelector('.login_email_staff_code_error').innerText = 'Input Field is required';
				isError = true;
			}

			if (!password) {
				document.querySelector('.login_password_error').innerText = 'Password is required';
				isError = true;
			} else if (password.length < 8) {
				document.querySelector('.login_password_error').innerText = 'Password must be at least 8 characters';
				isError = true;
			}

			if (isError) return;

			let data = {
				email_or_staff_code: email_or_staff_code,
				password: password,
			};

			try {
				let res = await axios.post('/staff/login/store', data);

				if (res.data.status === 'message_error') {
					document.querySelector('.login_email_staff_code_error').innerText = res.data.message;
				} else if (res.data.status === 'otp_required') {
					localStorage.setItem('pending_email', res.data.email);
					//alert('OTP sent to your email. Please verify to proceed.');
					window.location.href = '/staff/otp/verify';
				} else if (res.data.status === 'login_success') {
					localStorage.setItem('token', res.data.token);
					alert('Login successful');
					window.location.href = '/staff/dashboard';
				}
			} catch (error) {
				if (error.response && error.response.data && error.response.data.message) {
					alert('Error: ' + error.response.data.message);
				} else {
					alert('Something went wrong. Please try again.');
				}
				console.error('Login error:', error);
			}
		}
	</script>
</body>
</html>
