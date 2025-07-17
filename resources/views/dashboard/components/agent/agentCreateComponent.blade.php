<style>
/* HTML: <div class="loader"></div> */
.loader {
  height: 5px;
  width: 100%;
  --c:no-repeat linear-gradient(rgba(191, 120, 226, 0.804));
  background: var(--c),var(--c),#e6e2ea;
  background-size: 60% 100%;
  animation: l16 3s infinite;
}
@keyframes l16 {
  0%   {background-position:-150% 0,-150% 0}
  66%  {background-position: 250% 0,-150% 0}
  100% {background-position: 250% 0, 250% 0}
}
</style>


<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">AGENT CREATE</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto position-relative" id="form_card">
        <div class="loader d-none" id="loader"></div>
        <div class="overlay d-none" id="form_overlay"></div>
        <div class="card-header">
            <i class="fas fa-user"></i> AGENT CREATION FORM
        </div>
        <div class="card-body ">
            <form action="" method="" id="agent_form">
                <!-- Optional: CSRF Token (for Laravel or frameworks) -->


                <!-- Hidden Admin ID (if needed) -->
                <div class="row">
                    <div class="col-md-12 mb-3" hidden>
                        <label for="admin_id">Admin ID</label>
                        <input type="text" class="form-control" id="admin_id" name="admin_id" readonly>
                    </div>
                </div>

                <!-- Name Input -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="agent_name" name="name"
                            placeholder="Enter full name">
                        <span class="text-danger" id="agent_name_error"></span>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="agent_email" name="email"
                            placeholder="Enter email address">
                        <span class="text-danger" id="agent_email_error"></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4" onclick="createagent(event)">Create
                        agent</button>
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
            //console.log(res.data)

            if (res.data.status == "success") {
                let id = res.data.data.id
                if (!id) {
                    alert("agent page admin id not found");
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


    async function createagent(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        //span error message clear
        document.getElementById('agent_email_error').innerHTML = '';
        document.getElementById('agent_name_error').innerHTML = '';

        let admin_id = document.getElementById('admin_id').value;
        let email = document.getElementById('agent_email').value;
        let name = document.getElementById('agent_name').value;
        let isError = false

        if (email == '') {
            document.getElementById('agent_email_error').innerHTML = 'Email is required';
            isError = true;
        }
        if (name == '') {
            document.getElementById('agent_name_error').innerHTML = 'Name is required';
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

    // 🟡 Show loader, overlay, disable button
    document.getElementById('loader').classList.remove('d-none');
    document.getElementById('form_overlay').classList.remove('d-none');
    let btn = event.target;
    btn.disabled = true;

        try {
            let res = await axios.post('/admin/create/agent/store', data, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            if (res.data.status == 'success') {
                    Swal.fire({
                    icon: 'success',
                    title: 'agent Created',
                    text: res.data.message,
                    timer: 2500,
                    showConfirmButton: false
                });

               document.getElementById('agent_email').value = '';
               document.getElementById('agent_name').value = '';
            } else {
               Swal.fire('Error', res.data.message);
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Validation errors from backend
                let errors = error.response.data.errors;
                if (errors.email) {
                    document.getElementById('agent_email_error').textContent = errors.email[0];
                }
                if (errors.name) {
                    document.getElementById('agent_name_error').textContent = errors.name[0];
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
        }finally{
         document.getElementById('loader').classList.add('d-none');
        document.getElementById('form_overlay').classList.add('d-none');
        btn.disabled = false;
        }
    }
</script>
