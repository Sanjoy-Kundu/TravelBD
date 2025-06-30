<!-- agent Password Change Modal -->
<div class="modal fade" id="viewagentPasswordChangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="agentDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">

            <!-- Modal Header -->
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="agentDetailsLabel">Change Your Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="agentPasswordChangeForm" autocomplete="off">
                <div class="modal-body bg-light">
                    <!-- Hidden agent ID -->
                    <input type="hidden" id="agent_password_reset_id" name="agent_id">

                    <div class="mb-3">
                        <label for="agent_old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="agent_old_password" name="old_password"
                            placeholder="Enter your old password">
                        <span class="text-danger" id="agent_old_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="agent_new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="agent_new_password" name="new_password"
                            placeholder="Enter your new password">
                        <span class="text-danger" id="agent_new_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="agent_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="agent_confirm_password" name="password"
                            placeholder="Confirm your new password">
                        <span class="text-danger" id="agent_confirm_password_error"></span>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="resetagentPassword(event)">Change
                        Password</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script>
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/agent/login";
    }

    function getagentPasswordReset(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
        }
        console.log("agent password rest id", id);
        document.getElementById("agent_password_reset_id").value = id;

    }


    async function resetagentPassword(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
        }

        // Clear errors
        document.getElementById("agent_old_password_error").innerHTML = "";
        document.getElementById("agent_new_password_error").innerHTML = "";
        document.getElementById("agent_confirm_password_error").innerHTML = "";

        // Get values
        const agent_id = document.getElementById("agent_password_reset_id").value;
        const oldPassword = document.getElementById("agent_old_password").value.trim();
        const newPassword = document.getElementById("agent_new_password").value.trim();
        const confirmPassword = document.getElementById("agent_confirm_password").value.trim();

        // Client-side Validation
        let isError = false;

        if (!oldPassword) {
            document.getElementById("agent_old_password_error").innerHTML = "Old password is required";
            isError = true;
        }
        if (!newPassword) {
            document.getElementById("agent_new_password_error").innerHTML = "New password is required";
            isError = true;
        }
        if (newPassword.length < 8) {
            document.getElementById("agent_new_password_error").innerHTML = "Minimum 8 characters required";
            isError = true;
        }
        if (!confirmPassword) {
            document.getElementById("agent_confirm_password_error").innerHTML = "Please confirm password";
            isError = true;
        }
        if (newPassword !== confirmPassword) {
            document.getElementById("agent_confirm_password_error").innerHTML = "Passwords do not match";
            isError = true;
        }

        if (isError) return;

        // Prepare Data
        let data = {
            id: agent_id,
            old_password: oldPassword,
            new_password: newPassword,
            password: newPassword
        };

        // Send Request
        try {
            let res = await axios.post('/agent/reset/password', data, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                //alert(res.data.message);
                document.getElementById("agentPasswordChangeForm").reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById("viewagentPasswordChangeModal"));
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
                    window.location.href = "/agent/login";
                });
            } else {
                if(res.data.status === "error"){
                    document.getElementById("agent_old_password_error").innerHTML = res.data.message;
                }
                //alert(res.data.message);
            }

        } catch (error) {
            if (error.response && error.response.status === 422) {
                let errors = error.response.data.errors;
                if (errors.old_password)
                    document.getElementById("agent_old_password_error").innerHTML = errors.old_password[0];
                if (errors.new_password)
                    document.getElementById("agent_new_password_error").innerHTML = errors.new_password[0];
                if (errors.password)
                    document.getElementById("agent_confirm_password_error").innerHTML = errors.password[0];
            } else {
                alert(error.response?.data?.message || "Something went wrong. Please try again later.");
                console.error(error);
            }
        }
    }
</script>
