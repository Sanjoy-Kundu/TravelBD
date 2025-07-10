
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <script src="{{ asset('assets') }}/js/axios.min.js"></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset("assets")}}/images/site_icon.png"/>
	 {{-- <link rel="icon" type="image/png" href="{{asset("assets")}}/{{asset("assets/images/site_icon.png")}}"/> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/main.css">
	<link href="{{asset("assets")}}/css/animate.min.css" rel="stylesheet">
<!--===============================================================================================-->

 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
<title>Customer Login-Njinternational Travel Angency</title>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 animate__animated animate__shakeX">
				<div class="login100-pic js-tilt" data-tilt>
					<img id="iconrotate"  src="{{asset("assets")}}/images/round_logo.png" alt="IMG">
				
					
				</div>
		

				<form class="login100-form">
					<span class="login100-form-title">
						<h1 style="color:rgb(16, 148, 220)">Customer Login</h1>
					</span>
					
					<div class="wrap-input100">
						<input class="input100 " type="text" value="" name="email"  placeholder="User Email" id="email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card" aria-hidden="true"></i>
						</span>
					</div>
					<span class="text-danger login_email_error"></span>

					<div class="wrap-input100">
						<input class="input100 " value="" type="date" name="date_of_birth" id="date">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<span class="text-danger login_date_error"></span>
										
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color:rgb(16, 148, 220)" onclick="onLogin(event)">
									Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset("assets")}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset("assets")}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset("assets")}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset("assets")}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset("assets")}}/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
<script>
async function onLogin(event){
    event.preventDefault();

    document.getElementsByClassName('login_email_error')[0].innerText = "";
    document.getElementsByClassName('login_date_error')[0].innerText = "";

    let email = document.getElementById('email').value;
    let date = document.getElementById('date').value;

    let isError = false;

    if (!email) {
        document.getElementsByClassName('login_email_error')[0].innerText = "Email is required";
        isError = true;
    }

    if (!date) {
        document.getElementsByClassName('login_date_error')[0].innerText = "Date is required";
        isError = true;
    }

    if (isError) return false;

    let data = {
        email:email,
        date_of_birth:date
    };

    try {
        let res = await axios.post("/customer/login/store", data);

		if(res.data.status == "message_error"){
			document.getElementsByClassName('login_email_error')[0].innerText = res.data.message;
		}

        if (res.data.status == "login_success") {
			
            localStorage.setItem("token", res.data.token);
            window.location.href = "/customer/dashboard";
        }
    } catch (error) {
        if (error.response && error.response.data && error.response.data.message) {
            alert(error.response.data.message);
        } else {
            alert("Something went wrong. Please try again.");
        }
        console.error("error", error);
    }
}


</script>
	

</body>
</html>