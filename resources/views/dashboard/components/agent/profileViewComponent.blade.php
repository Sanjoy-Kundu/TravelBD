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
                    <img id="profile_image_preview" alt="Profile Image" class="img-thumbnail rounded-circle mb-3"
                        style="width: 200px; height: 200px; object-fit: cover;">
                </div>


                <!-- Profile Details -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="d-none">
                                <th>agent_id</th>
                                <td><input type="number" name="" id="agent_profile_view_id" readonly></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td id="agent_profile_view_role">Loading...</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td id="agent_profile_view_name">Loading...</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="agent_profile_view_email">Loading...</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td id="agent_profile_view_gender">Loading...</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td id="agent_profile_view_phone">Loading...</td>
                            </tr>
                            <tr>
                                <th>Alternate Phone</th>
                                <td id="agent_profile_view_alternate_phone">Loading...</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td id="agent_profile_view_city">Loading...</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td id="agent_profile_view_state">Loading...</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td id="agent_profile_view_country">Loading...</td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td id="agent_profile_view_zip_code">Loading...</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td id="agent_profile_view_designation">Loading...</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td id="agent_profile_view_facebook">Loading...</td>
                            </tr>
                            <tr>
                                <th>Twitter</th>
                                <td id="agent_profile_view_twitter">Loading...</td>
                            </tr>
                            <tr>
                                <th>LinkedIn</th>
                                <td id="agent_profile_view_linkedin">Loading...</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td id="agent_profile_view_website">Loading...</td>
                            </tr>
                            <tr>
                                <th>About</th>
                                <td id="agent_profile_view_about">Loading...</td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td>
                                    <button class="btn btn-info text-white change_agent_password" data-bs-toggle="modal" data-bs-target="#viewagentPasswordChangeModal">Change
                                        Password</button>
                                    <a href="{{ url('agent/profile/create') }}" class="btn btn-primary text-white">Edit
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
    loadagentProfileView();
    async function loadagentProfileView() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
            return;
        }

        try {
            // Fetch agent basic info
            let userRes = await axios.get("/user/details/agent", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (userRes.data.status === "success") {
                let data = userRes.data.data;
                document.querySelector("#agent_profile_view_id").value = data.id ?? "N/A";
                document.querySelector(".user_name_view").innerHTML = data.name ?? "N/A";
                document.querySelector("#agent_profile_view_name").innerHTML = data.name ?? "N/A";
                document.querySelector("#agent_profile_view_email").innerHTML = data.email ?? "N/A";
                document.querySelector("#agent_profile_view_role").innerHTML = data.role ?? "N/A";
            }

            let agent_id = document.querySelector("#agent_profile_view_id").value;
            console.log(agent_id);
            // Fetch profile details
            let profileRes = await axios.post("/agent/profile/details", {
                agent_id: agent_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (profileRes.data.status === "success") {
                let profile = profileRes.data.data;
                document.querySelector("#agent_profile_view_phone").innerHTML = profile.phone ?? "N/A";
                document.querySelector("#agent_profile_view_alternate_phone").innerHTML = profile.alternate_phone ??
                    "N/A";
                document.querySelector("#agent_profile_view_city").innerHTML = profile.city ?? "N/A";
                document.querySelector("#agent_profile_view_state").innerHTML = profile.state ?? "N/A";
                document.querySelector("#agent_profile_view_country").innerHTML = profile.country ?? "N/A";
                document.querySelector("#agent_profile_view_zip_code").innerHTML = profile.zip_code ?? "N/A";
                document.querySelector("#agent_profile_view_designation").innerHTML = profile.designation ?? "N/A";
                document.querySelector("#agent_profile_view_facebook").innerHTML = profile.facebook ?? "N/A";
                document.querySelector("#agent_profile_view_twitter").innerHTML = profile.twitter ?? "N/A";
                document.querySelector("#agent_profile_view_linkedin").innerHTML = profile.linkedin ?? "N/A";
                document.querySelector("#agent_profile_view_website").innerHTML = profile.website ?? "N/A";
                document.querySelector("#agent_profile_view_about").innerHTML = profile.about ?? "N/A";
                document.querySelector("#agent_profile_view_gender").innerHTML = profile.gender ?? "N/A";

                document.querySelector("#profile_image_preview").src =
                    profile.profile_image && profile.profile_image.trim() !== "" ?
                    `/upload/dashboard/images/agent/${profile.profile_image}` :
                    '/upload/dashboard/images/agent/default.png';

            }

        } catch (error) {
            if (error.response && error.response.status === 401) {
                //alert(error.response.data.message);
                localStorage.removeItem('token');
                window.location.href = "/agent/login";
            } else {
                console.error("Unexpected error:", error);
                // alert("Something went wrong!");
            }
        }
    }

    document.querySelector('.change_agent_password').addEventListener('click', async function() {
        let agentId = document.getElementById('agent_profile_view_id').value;
        if(!agentId){
            console.log("agent id not found for agent profile view page")
            window.location.href = "/agent/login";
        }
        
        //show modal and pass id 
        //thi is the modal id viewagentPasswordChangeModal
        await getagentPasswordReset(agentId);
         
        
    });
</script>
