<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Staff Create</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Staff Creation Form
        </div>
        <div class="card-body">
            <form action="" method="" id="staff_form">
                <!-- Optional: CSRF Token (for Laravel or frameworks) -->


                <!-- Hidden Admin ID (if needed) -->
                <div class="row" hidden>
                    <div class="col-md-12 mb-3">
                        <label for="admin_id">Admin ID</label>
                        <input type="text" class="form-control" id="profile_admin_id" name="admin_id" readonly>
                    </div>
                </div>

                <!-- Name Input -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="staff_name" name="name"
                            placeholder="Enter full name">
                            <span class="text-danger" id="staff_name_error"></span>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="staff_email" name="email"
                            placeholder="Enter email address">
                            <span class="text-danger" id="staff_email_error"></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4" onclick="createStaff(event)">Create Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    getAuthCheck();
    function getAuthCheck() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
    }


    function createStaff(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        //span error message clear
        document.getElementById('staff_email_error').innerHTML = '';
        document.getElementById('staff_name_error').innerHTML = '';

        let email = document.getElementById('staff_email').value;
        let name = document.getElementById('staff_name').value;
        let isError = false
        
        if(email == ''){
            document.getElementById('staff_email_error').innerHTML = 'Email is required';
            isError = true;
        }
        if(name == ''){
            document.getElementById('staff_name_error').innerHTML = 'Name is required';
            isError = true;
        }
        if(isError){
            return false;
        }

        let data = {
            email: email,
            name: name,
        }

        console.log(data);
    }
</script>
