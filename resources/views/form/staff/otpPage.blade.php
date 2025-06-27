<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OTP</title>

	<!-- Axios -->
	<script src="{{ asset('assets') }}/js/axios.min.js"></script>

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/vendor/animate/animate.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/vendor/select2/select2.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/css/util.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/css/main.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/css/animate.min.css">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 animate__animated animate__shakeX">
				<div class="login100-pic js-tilt" data-tilt>
					<img id="iconrotate" src="{{ asset('assets') }}/images/round_logo.png" alt="IMG">
				</div>

				<form class="login100-form">
					<span class="login100-form-title">
						<h1 style="color:rgb(16, 148, 220)">OTP</h1>
					</span>

					<div class="wrap-input100">
						<input class="input100" type="text" name="otp" placeholder="Enter Your OTP" id="otp">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card" aria-hidden="true"></i>
						</span>
					</div>
					<span class="text-danger otp_error"></span>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color:rgb(16, 148, 220)" onclick="onOtpVerify(event)">
							Verify OTP
						</button>
						<p><a href="{{url('staff/resend/otp')}}">resend otp</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- JS Scripts -->
	<script src="{{ asset('assets') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="{{ asset('assets') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{ asset('assets') }}/vendor/select2/select2.min.js"></script>
	<script src="{{ asset('assets') }}/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		});
	</script>

	<!-- OTP Verify Script -->
	<script>
		async function onOtpVerify(event) {
			event.preventDefault();
			document.querySelector('.otp_error').innerText = "";

			let otp = document.getElementById('otp').value.trim();

			if (!otp) {
				document.querySelector('.otp_error').innerText = "OTP is required";
				return;
			}

			try {
				const res = await axios.post("/otp/verify/store", { otp:otp});

				if (res.data.status === "otp_error") {
					document.querySelector('.otp_error').innerText = res.data.message;
				} else if (res.data.status === "otp_success") {
					localStorage.setItem('token', res.data.token);
					localStorage.setItem('user', JSON.stringify(res.data.admin));
					window.location.href = "/staff/dashboard";
				}
			} catch (error) {
				console.error("Request error:", error);
				if (error.response && error.response.status === 401) {
					document.querySelector('.otp_error').innerText = error.response.data.message || "Invalid OTP";
				} else {
					document.querySelector('.otp_error').innerText = "Something went wrong. Please try again.";
				}
			}
		}
	</script>
</body>
</html>
