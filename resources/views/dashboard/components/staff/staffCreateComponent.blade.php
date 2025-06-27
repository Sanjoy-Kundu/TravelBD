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
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="admin_id">Admin ID</label>
                        <input type="text" class="form-control" id="admin_id" name="admin_id" readonly>
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
                    <button type="submit" class="btn btn-success px-4" onclick="createStaff(event)">Create
                        Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    getUserInfo();
    async function getUserInfo() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
        try {
            let res = await axios.get("/user/details/admin", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
            console.log(res.data)

            if (res.data.status == "success") {
                let id = res.data.data.id
                if (!id) {
                    alert("staff page admin id not found");
                }
                document.getElementById("admin_id").value = res.data.data.id;
            }
        } catch (error) {
            // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/admin/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }






    getAuthCheck();
    function getAuthCheck() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
    }


    async function createStaff(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        //span error message clear
        document.getElementById('staff_email_error').innerHTML = '';
        document.getElementById('staff_name_error').innerHTML = '';

        let admin_id = document.getElementById('admin_id').value;
        let email = document.getElementById('staff_email').value;
        let name = document.getElementById('staff_name').value;
        let isError = false

        if (email == '') {
            document.getElementById('staff_email_error').innerHTML = 'Email is required';
            isError = true;
        }
        if (name == '') {
            document.getElementById('staff_name_error').innerHTML = 'Name is required';
            isError = true;
        }
        if (isError) {
            return false;
        }

        let data = {
            admin_id: admin_id,
            email: email,
            name: name,
        }

        console.log(data);
        try {
            let res = await axios.post('/admin/create/staff/store', data, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            if (res.data.status == 'success') {
                    Swal.fire({
                    icon: 'success',
                    title: 'Staff Created',
                    text: res.data.message,
                    timer: 2500,
                    showConfirmButton: false
                });

               document.getElementById('staff_email').value = '';
               document.getElementById('staff_name').value = '';
            } else {
               Swal.fire('Error', res.data.message);
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Validation errors from backend
                let errors = error.response.data.errors;
                if (errors.email) {
                    document.getElementById('staff_email_error').textContent = errors.email[0];
                }
                if (errors.name) {
                    document.getElementById('staff_name_error').textContent = errors.name[0];
                }
            } else if (error.response && error.response.status === 401) {
                Swal.fire('Unauthorized', 'Session expired, please login again.', 'error').then(() => {
                    //localStorage.removeItem('token');
                    //window.location.href = "/admin/login";
                });
            } else {
                Swal.fire('Error', 'Something went wrong!', 'error');
                console.error(error);
            }
        }
    }
</script>
