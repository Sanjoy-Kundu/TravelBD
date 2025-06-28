<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Profile View</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> <span class="user_name_view"></span> Profile Overview
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Profile Image -->
                <div class="col-md-4 text-center">
                    <img id="profile_image_preview" src="{{asset('/upload/dashboard/images/staff/default.png')}}" alt="Profile Image" class="img-thumbnail rounded-circle mb-3"
                        style="width: 200px; height: 200px; object-fit: cover;">
                </div>


                <!-- Profile Details -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="d-none">
                                <th>staff_id</th>
                                <td><input type="number" name="" id="staff_profile_view_id" readonly></td>
                            </tr>
                            <tr class="">
                                <th>Your Code</th>
                                <td><input type="text" name="staff_code" id="staff_code_id" ></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td id="staff_profile_view_role">Loading...</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td id="staff_profile_view_name">Loading...</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="staff_profile_view_email">Loading...</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td id="staff_profile_view_gender">Loading...</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td id="staff_profile_view_phone">Loading...</td>
                            </tr>
                            <tr>
                                <th>Alternate Phone</th>
                                <td id="staff_profile_view_alternate_phone">Loading...</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td id="staff_profile_view_city">Loading...</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td id="staff_profile_view_state">Loading...</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td id="staff_profile_view_country">Loading...</td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td id="staff_profile_view_zip_code">Loading...</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td id="staff_profile_view_designation">Loading...</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td id="staff_profile_view_facebook">Loading...</td>
                            </tr>
                            <tr>
                                <th>Twitter</th>
                                <td id="staff_profile_view_twitter">Loading...</td>
                            </tr>
                            <tr>
                                <th>LinkedIn</th>
                                <td id="staff_profile_view_linkedin">Loading...</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td id="staff_profile_view_website">Loading...</td>
                            </tr>
                            <tr>
                                <th>About</th>
                                <td id="staff_profile_view_about">Loading...</td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td>
                                    <button class="btn btn-info text-white change_staff_password" data-bs-toggle="modal" data-bs-target="#viewstaffPasswordChangeModal">Change
                                        Password</button>
                                    <a href="{{ url('staff/profile/create') }}" class="btn btn-primary text-white">Manage
                                        Your Profile</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    loadstaffProfileView();
    async function loadstaffProfileView() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/staff/login";
            return;
        }

        try {
            // Fetch staff basic info
            let userRes = await axios.get("/auth/staff", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (userRes.data.status === "success") {
                let data = userRes.data.data;
                console.log(data)
                document.querySelector("#staff_profile_view_id").value = data.id ?? "N/A";
                document.querySelector("#staff_code_id").value = data.staff_code ?? "N/A";
                document.querySelector(".user_name_view").innerHTML = data.name ?? "N/A";
                document.querySelector("#staff_profile_view_name").innerHTML = data.name ?? "N/A";
                document.querySelector("#staff_profile_view_email").innerHTML = data.email ?? "N/A";
                document.querySelector("#staff_profile_view_role").innerHTML = data.role ?? "N/A";
            }

            let staff_id = document.querySelector("#staff_profile_view_id").value;
            console.log(staff_id);
            // Fetch profile details
            let profileRes = await axios.post("/staff/profile/details", {
                staff_id: staff_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (profileRes.data.status === "success") {
                let profile = profileRes.data.data;
                document.querySelector("#staff_profile_view_phone").innerHTML = profile.phone ?? "N/A";
                document.querySelector("#staff_profile_view_alternate_phone").innerHTML = profile.alternate_phone ??
                    "N/A";
                document.querySelector("#staff_profile_view_city").innerHTML = profile.city ?? "N/A";
                document.querySelector("#staff_profile_view_state").innerHTML = profile.state ?? "N/A";
                document.querySelector("#staff_profile_view_country").innerHTML = profile.country ?? "N/A";
                document.querySelector("#staff_profile_view_zip_code").innerHTML = profile.zip_code ?? "N/A";
                document.querySelector("#staff_profile_view_designation").innerHTML = profile.designation ?? "N/A";
                document.querySelector("#staff_profile_view_facebook").innerHTML = profile.facebook ?? "N/A";
                document.querySelector("#staff_profile_view_twitter").innerHTML = profile.twitter ?? "N/A";
                document.querySelector("#staff_profile_view_linkedin").innerHTML = profile.linkedin ?? "N/A";
                document.querySelector("#staff_profile_view_website").innerHTML = profile.website ?? "N/A";
                document.querySelector("#staff_profile_view_about").innerHTML = profile.about ?? "N/A";
                document.querySelector("#staff_profile_view_gender").innerHTML = profile.gender ?? "N/A";

                document.querySelector("#profile_image_preview").src =
                    profile.profile_image && profile.profile_image.trim() !== "" ?
                    `/upload/dashboard/images/staff/${profile.profile_image}` :
                    '/upload/dashboard/images/staff/default.png';

            }

        } catch (error) {
            if (error.response && error.response.status === 401) {
                //alert(error.response.data.message);
                localStorage.removeItem('token');
                window.location.href = "/staff/login";
            } else {
                console.error("Unexpected error:", error);
                // alert("Something went wrong!");
            }
        }
    }

    document.querySelector('.change_staff_password').addEventListener('click', async function() {
        let staffId = document.getElementById('staff_profile_view_id').value;
        if(!staffId){
            console.log("staff id not found for staff profile view page")
            window.location.href = "/staff/login";
        }
        
        //show modal and pass id 
        //thi is the modal id viewstaffPasswordChangeModal
        await getstaffPasswordReset(staffId);
         
        
    });
</script>
