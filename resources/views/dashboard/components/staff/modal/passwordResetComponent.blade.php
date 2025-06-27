<!-- Admin Password Change Modal -->
<div class="modal fade" id="viewAdminPasswordChangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="adminDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">

            <!-- Modal Header -->
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="adminDetailsLabel">Change Your Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="adminPasswordChangeForm" autocomplete="off">
                <div class="modal-body bg-light">
                    <!-- Hidden Admin ID -->
                    <input type="hidden" id="admin_password_reset_id" name="admin_id">

                    <div class="mb-3">
                        <label for="admin_old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="admin_old_password" name="old_password"
                            placeholder="Enter your old password">
                        <span class="text-danger" id="admin_old_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="admin_new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="admin_new_password" name="new_password"
                            placeholder="Enter your new password">
                        <span class="text-danger" id="admin_new_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="admin_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="admin_confirm_password" name="password"
                            placeholder="Confirm your new password">
                        <span class="text-danger" id="admin_confirm_password_error"></span>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="resetAdminPassword(event)">Change
                        Password</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/admin/login";
    }

    function getAdminPasswordReset(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
        console.log("admin password rest id", id);
        document.getElementById("admin_password_reset_id").value = id;

    }


    async function resetAdminPassword(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }

        // Clear errors
        document.getElementById("admin_old_password_error").innerHTML = "";
        document.getElementById("admin_new_password_error").innerHTML = "";
        document.getElementById("admin_confirm_password_error").innerHTML = "";

        // Get values
        const admin_id = document.getElementById("admin_password_reset_id").value;
        const oldPassword = document.getElementById("admin_old_password").value.trim();
        const newPassword = document.getElementById("admin_new_password").value.trim();
        const confirmPassword = document.getElementById("admin_confirm_password").value.trim();

        // Client-side Validation
        let isError = false;

        if (!oldPassword) {
            document.getElementById("admin_old_password_error").innerHTML = "Old password is required";
            isError = true;
        }
        if (!newPassword) {
            document.getElementById("admin_new_password_error").innerHTML = "New password is required";
            isError = true;
        }
        if (newPassword.length < 8) {
            document.getElementById("admin_new_password_error").innerHTML = "Minimum 8 characters required";
            isError = true;
        }
        if (!confirmPassword) {
            document.getElementById("admin_confirm_password_error").innerHTML = "Please confirm password";
            isError = true;
        }
        if (newPassword !== confirmPassword) {
            document.getElementById("admin_confirm_password_error").innerHTML = "Passwords do not match";
            isError = true;
        }

        if (isError) return;

        // Prepare Data
        let data = {
            id: admin_id,
            old_password: oldPassword,
            new_password: newPassword,
            password: newPassword
        };

        // Send Request
        try {
            let res = await axios.post('/admin/reset/password', data, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                //alert(res.data.message);
                document.getElementById("adminPasswordChangeForm").reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById("viewAdminPasswordChangeModal"));
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
                    window.location.href = "/admin/login";
                });
            } else {
                if(res.data.status === "error"){
                    document.getElementById("admin_old_password_error").innerHTML = res.data.message;
                }
                //alert(res.data.message);
            }

        } catch (error) {
            if (error.response && error.response.status === 422) {
                let errors = error.response.data.errors;
                if (errors.old_password)
                    document.getElementById("admin_old_password_error").innerHTML = errors.old_password[0];
                if (errors.new_password)
                    document.getElementById("admin_new_password_error").innerHTML = errors.new_password[0];
                if (errors.password)
                    document.getElementById("admin_confirm_password_error").innerHTML = errors.password[0];
            } else {
                alert(error.response?.data?.message || "Something went wrong. Please try again later.");
                console.error(error);
            }
        }
    }
</script>
