<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="{{ asset('assets') }}/js/axios.min.js"></script>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/images/site_icon.png" />
    {{-- <link rel="icon" type="image/png" href="{{asset("assets")}}/{{asset("assets/images/site_icon.png")}}"/> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/main.css">
    <link href="{{ asset('assets') }}/css/animate.min.css" rel="stylesheet">
    <!--===============================================================================================-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <title>Admin Registration-Njinternational Travel Angency</title>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 animate__animated animate__shakeX">
                <div class="login100-pic js-tilt" data-tilt>
                    <img id="iconrotate" src="{{ asset('assets') }}/images/round_logo.png" alt="IMG">
                </div>


                <form class="login100-form" action="" method="">
                    <span class="login100-form-title">
                        <h3 style="color:rgb(16, 148, 220)">Admin Registration</h3>
                    </span>
                    <div class="alert alert-success d-none" role="alert">
                        <h2 id="registration_success"></h2>
                    </div>
                    <div class="wrap-input100">
                        <input class="input100 " type="text" value="" name="name" placeholder="User Name"
                            id="name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="text-danger register_name_error"></span>

                    <div class="wrap-input100">
                        <input class="input100 " type="text" value="" name="email" placeholder="User Email"
                            id="email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="text-danger register_email_error"></span>

                    <div class="wrap-input100">
                        <input class="input100 " value="" type="password" name="password" placeholder="Password"
                            id="password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="text-danger register_password_error"></span>

                    <div class="wrap-input100">
                        <input class="input100 " value="" type="password" name="c_password"
                            placeholder="Confirm Password" id="confirm_password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="text-danger register_confirm_password_error"></span>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" style="background-color:rgb(16, 148, 220)"
                            onclick="onRegistration(event)">
                            Registration
                        </button>
                    </div>
                    <p>Already have an account? <a href="{{ url('/admin/login') }}" target="_blank"
                            style="color:rgb(16, 148, 220)"> Login Here</a></p>
                </form>
            </div>
        </div>

    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets') }}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets') }}/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->

    <script>
        async function onRegistration(event) {
            event.preventDefault();

            // Clear old errors
            document.getElementsByClassName('register_name_error')[0].innerText = "";
            document.getElementsByClassName('register_email_error')[0].innerText = "";
            document.getElementsByClassName('register_password_error')[0].innerText = "";
            document.getElementsByClassName('register_confirm_password_error')[0].innerText = "";

            // Get values
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirm_password = document.getElementById('confirm_password').value;

            let isError = false;

            // Validate
            if (!name) {
                document.getElementsByClassName('register_name_error')[0].innerText = "Name is required";
                isError = true;
            }

            if (!email) {
                document.getElementsByClassName('register_email_error')[0].innerText = "Email is required";
                isError = true;
            }

            if (!password) {
                document.getElementsByClassName('register_password_error')[0].innerText = "Password is required";
                isError = true;
            } else if (password.length < 8) {
                document.getElementsByClassName('register_password_error')[0].innerText =
                    "Password must be at least 8 characters";
                isError = true;
            }

            if (!confirm_password) {
                document.getElementsByClassName('register_confirm_password_error')[0].innerText =
                    "Confirm Password is required";
                isError = true;
            } else if (password !== confirm_password) {
                document.getElementsByClassName('register_confirm_password_error')[0].innerText =
                    "Password and Confirm Password must be same";
                isError = true;
            }

            if (isError) return false;

            // If no error, prepare data
            let data = {
                name: name,
                email: email,
                password: password
            };
           // console.log(data);
            try {
                let res = await axios.post("/store_registration", data);
                if (res.data.status === 'success') {
                    document.getElementById("registration_success").innerText = res.data.message
                    let alertBox = document.getElementsByClassName("alert-success")[0];
                    alertBox.classList.remove("d-none");
					//refresh input field
					document.getElementById('name').value = "";
                    document.getElementById('email').value = "";
                    document.getElementById('password').value = "";
					document.getElementById('confirm_password').value = "";

					//remove alert after 5 sec
                    setTimeout(() => {
                        alertBox.classList.add("d-none");
                    }, 5000);
                }
            } catch (error) {
				if(error.response.status == 422){
					let errors = error.response.data.errors;
					if(errors.email){
						document.getElementsByClassName('register_email_error')[0].innerText = errors.email[0];
					}
				}else{
					console.log("server error",error.response.data);
				}
            }

        }
    </script>


</body>

</html>
