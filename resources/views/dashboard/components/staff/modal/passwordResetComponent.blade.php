<!-- staff Password Change Modal -->
<div class="modal fade" id="viewstaffPasswordChangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staffDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">

            <!-- Modal Header -->
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="staffDetailsLabel">Change Your Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="staffPasswordChangeForm" autocomplete="off">
                <div class="modal-body bg-light">
                    <!-- Hidden staff ID -->
                    <input type="hidden" id="staff_password_reset_id" name="staff_id">

                    <div class="mb-3">
                        <label for="staff_old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="staff_old_password" name="old_password"
                            placeholder="Enter your old password">
                        <span class="text-danger" id="staff_old_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="staff_new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="staff_new_password" name="new_password"
                            placeholder="Enter your new password">
                        <span class="text-danger" id="staff_new_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="staff_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="staff_confirm_password" name="password"
                            placeholder="Confirm your new password">
                        <span class="text-danger" id="staff_confirm_password_error"></span>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="resetstaffPassword(event)">Change
                        Password</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/staff/login";
    }

    function getstaffPasswordReset(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/staff/login";
        }
        console.log("staff password rest id", id);
        document.getElementById("staff_password_reset_id").value = id;

    }


    async function resetstaffPassword(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/staff/login";
        }

        // Clear errors
        document.getElementById("staff_old_password_error").innerHTML = "";
        document.getElementById("staff_new_password_error").innerHTML = "";
        document.getElementById("staff_confirm_password_error").innerHTML = "";

        // Get values
        const staff_id = document.getElementById("staff_password_reset_id").value;
        const oldPassword = document.getElementById("staff_old_password").value.trim();
        const newPassword = document.getElementById("staff_new_password").value.trim();
        const confirmPassword = document.getElementById("staff_confirm_password").value.trim();

        // Client-side Validation
        let isError = false;

        if (!oldPassword) {
            document.getElementById("staff_old_password_error").innerHTML = "Old password is required";
            isError = true;
        }
        if (!newPassword) {
            document.getElementById("staff_new_password_error").innerHTML = "New password is required";
            isError = true;
        }
        if (newPassword.length < 8) {
            document.getElementById("staff_new_password_error").innerHTML = "Minimum 8 characters required";
            isError = true;
        }
        if (!confirmPassword) {
            document.getElementById("staff_confirm_password_error").innerHTML = "Please confirm password";
            isError = true;
        }
        if (newPassword !== confirmPassword) {
            document.getElementById("staff_confirm_password_error").innerHTML = "Passwords do not match";
            isError = true;
        }

        if (isError) return;

        // Prepare Data
        let data = {
            id: staff_id,
            old_password: oldPassword,
            new_password: newPassword,
            password: newPassword
        };

        // Send Request
        try {
            let res = await axios.post('/staff/reset/password', data, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                //alert(res.data.message);
                document.getElementById("staffPasswordChangeForm").reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById("viewstaffPasswordChangeModal"));
                modal.hide();
                //redirect to login page
                Swal.fire({
                    icon: 'success',
                    title: 'Password Changed!',
                    text: res.data.message,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    localStorage.removeItem('token');
                    window.location.href = "/staff/login";
                });
            } else {
                if(res.data.status === "error"){
                    document.getElementById("staff_old_password_error").innerHTML = res.data.message;
                }
                //alert(res.data.message);
            }

        } catch (error) {
            if (error.response && error.response.status === 422) {
                let errors = error.response.data.errors;
                if (errors.old_password)
                    document.getElementById("staff_old_password_error").innerHTML = errors.old_password[0];
                if (errors.new_password)
                    document.getElementById("staff_new_password_error").innerHTML = errors.new_password[0];
                if (errors.password)
                    document.getElementById("staff_confirm_password_error").innerHTML = errors.password[0];
            } else {
                alert(error.response?.data?.message || "Something went wrong. Please try again later.");
                console.error(error);
            }
        }
    }
</script>
