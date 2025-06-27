<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>OTP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Axios -->
    <script src="{{ asset('assets') }}/js/axios.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/animate/animate.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css-hamburgers/hamburgers.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/select2/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/util.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/animate.min.css" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 animate__animated animate__fadeIn">
                <div class="login100-pic js-tilt" data-tilt>
                    <img id="iconrotate" src="{{ asset('assets') }}/images/round_logo.png" alt="IMG" />
                </div>

                <form class="login100-form">
                    <span class="login100-form-title">
                        <h1 style="color:rgb(16, 148, 220)">OTP</h1>
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="otp" placeholder="Enter Your OTP"
                            id="otp" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span class="text-danger otp_error mb-3 d-block"></span>

                    <div class="container-login100-form-btn d-flex flex-column align-items-center">
                        <!-- Verify Button -->
                        <button class="login100-form-btn mb-3" style="background-color:rgb(16, 148, 220)"
                            onclick="onOtpVerify(event)">
                            Verify OTP
                        </button>

                        <!-- Resend OTP Button -->
                        <a href="javascript:void(0);" class="btn-sm px-4 text-danger resendStaffOtp">
                            <i class="fa fa-refresh me-2"></i> Resend OTP
                        </a>
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

        // CSRF Token for all axios requests
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content');

        let email = localStorage.getItem('pending_email');
        if (!email) {
            window.location.href = "/staff/login";
        }

        async function onOtpVerify(event) {
            event.preventDefault();
            document.querySelector('.otp_error').innerText = "";

            let otp = document.getElementById('otp').value.trim();

            if (!otp) {
                document.querySelector('.otp_error').innerText = "OTP is required";
                return;
            }

            try {
                const res = await axios.post("/staff/otp/verify/store", {
                    otp: otp
                });

                console.log(res.data);

                if (res.data.status === "otp_error") {
                    Swal.fire('Invalid OTP', res.data.message, 'error');
                } else if (res.data.status === "verified_error") {
                    Swal.fire('Not Verified', res.data.message, 'warning');
                } else if (res.data.status === "otp_expired") {
                    Swal.fire('Expired', res.data.message, 'error');
                } else if (res.data.status === "otp_success") {
                    Swal.fire({
                        title: 'Success!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'Go to Dashboard'
                    }).then(() => {
						localStorage.removeItem('pending_email'); //remote pending email from local storage
                        localStorage.setItem('token', res.data.token);
                        localStorage.setItem('user', JSON.stringify(res.data.staff));
                        window.location.href = "/staff/dashboard";
                    });
                }
            } catch (error) {
                if (error.response && (error.response.status === 401 || error.response.status === 403)) {
                    Swal.fire('Error', error.response.data.message || "Invalid OTP", 'error');
                } else {
                    Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                }
            }
        }

        $(document).on('click', '.resendStaffOtp', async function() {
            let email = localStorage.getItem('pending_email');
            if (!email) {
                window.location.href = "/staff/login";
                return;
            }
            try {
                let res = await axios.post('/staff/resend/otp', {
                    email: email
                });
                if (res.data.status === "otp_success" || res.data.status === "success") {
                    Swal.fire('Success', res.data.message, 'success');
                } else {
                    Swal.fire('Error', res.data.message, 'error');
                    // if (res.data.status === 'error') {
                    //     console.log(res.data.message);
                    // }
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 429) {
                        // OTP এখনও valid, এই মেসেজ দেখাও
                        Swal.fire('Wait!', error.response.data.message ||
                            'Please wait before requesting new OTP.', 'warning');
                    } else if (error.response.status === 401 || error.response.status === 403) {
                        Swal.fire('Error', error.response.data.message || "Unauthorized", 'error');
                    } else {
                        Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                    }
                } else {
                    Swal.fire('Error', 'Network error or server not reachable.', 'error');
                }
            }
        });
    </script>
</body>

</html>
