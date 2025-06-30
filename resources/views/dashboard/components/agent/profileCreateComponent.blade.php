<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Profile Create</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto">

        {{-- success alert message --}}
        <div id="agent_profile_success_alert" class="alert alert-success w-100 text-center mb-2 d-none" role="alert">
            Profile has been uploaded successfully!
        </div>

        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Agent Profile Information
        </div>
        <div class="card-body">
            <form action="" method="" enctype="multipart/form-data" id="agent_profile_form">
                <div class="row" hidden>
                    <div class="col-md-12 mb-3">
                        <label for="phone">agent Id</label>
                        <input type="tel" class="form-control" id="profile_agent_id" name="agent_id" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="profile_agent_name">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="profile_agent_name" readonly
                                onclick="enableNameEdit()">
                            <button class="btn btn-warning" type="button" onclick="updateAgentName()">Update</button>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control bg-danger text-white" id="profile_agent_email"
                            readonly>
                    </div>
                </div>

                <!-- Phone -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" id="profile_agent_phone"
                            placeholder="Enter Your Phone">
                        <span class="text-danger" id="profile_agent_phone_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alternate Phone (optional)</label>
                        <input type="tel" class="form-control" id="profile_agent_alternate_phone"
                            placeholder="Enter Your Alternate Phone">
                    </div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <input type="text" class="form-control" id="profile_agent_address"
                            placeholder="Enter Your Address">
                        <span class="text-danger" id="profile_agent_address_error"></span>
                    </div>
                </div>

                <!-- City, State -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>City</label>
                        <input type="text" class="form-control" id="profile_agent_city"
                            placeholder="Enter Your City">
                        <span class="text-danger" id="profile_agent_city_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>State</label>
                        <input type="text" class="form-control" id="profile_agent_state"
                            placeholder="Enter Your State">
                        <span class="text-danger" id="profile_agent_state_error"></span>
                    </div>
                </div>

                <!-- Country, Zip -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" id="profile_agent_country"
                            placeholder="Enter Your Country">
                        <span class="text-danger" id="profile_agent_country_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" id="profile_agent_zip_code"
                            placeholder="Enter Your Zip Code">
                        <span class="text-danger" id="profile_agent_zip_code_error"></span>
                    </div>
                </div>

                <!-- Designation & Image -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Designation</label>
                        <input type="text" class="form-control" id="profile_agent_designation"
                            placeholder="Enter Your Designation">
                        <span class="text-danger" id="profile_agent_designation_error"></span>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Profile Image</label>
                        <input type="file" class="form-control-file" id="profile_agent_profile_image"
                            onchange="agentPreviewProfileImage(event)">
                        <span class="text-danger" id="profile_agent_profile_image_error"
                            style="font-size: 14px;"></span>
                    </div>
                    <img src="/upload/dashboard/images/agent/default.png" id="profile_agent_profile_image_preview"
                        class="" alt="Profile Image"
                        style="width: 200px;height: 200px;border-radius: 18px;margin-top: 10px;">
                </div>

                <!-- About -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>About</label>
                        <textarea class="form-control" id="profile_agent_about" rows="4"></textarea>
                        <span class="text-danger" id="profile_agent_about_error"></span>
                    </div>
                </div>

                <!-- gender -->
                <div class="col-md-12 mb-3">
                    <label for="profile_agent_gender">Gender</label>
                    <select class="form-control" id="profile_agent_gender" name="gender">
                        <option value="" selected disabled>Choose Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <!-- Error message span -->
                    <span id="profile_agent_gender_error" class="text-danger" style="font-size: 14px;"></span>
                </div>

                <!-- Social -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Facebook URL</label>
                        <input type="url" class="form-control" id="profile_agent_facebook"
                            placeholder="https://facebook.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Twitter URL</label>
                        <input type="url" class="form-control" id="profile_agent_twitter"
                            placeholder="https://twitter.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>LinkedIn URL</label>
                        <input type="url" class="form-control" id="profile_agent_linkedin"
                            placeholder="https://linkedin.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Website</label>
                        <input type="url" class="form-control" id="profile_agent_website"
                            placeholder="https://yourwebsite.com/">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4" onclick="agentProfileUpload(event)">Save
                        Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fetch Agent Basic Info
    // getUserProfileInfo().then(() => {
    //     getAgentProfileDetails();
    // });

    // Only name enable
    function enableNameEdit() {
        const nameInput = document.querySelector("#profile_agent_name");
        nameInput.removeAttribute("readonly");
        nameInput.focus();
    }

    // Update agent name
    async function updateAgentName() {
        const email = document.querySelector("#profile_agent_email").value.trim();
        const name = document.querySelector("#profile_agent_name").value.trim();
        const token = localStorage.getItem("token");

        if (name === "") {
            alert("Name field is required");
            return;
        }

        try {
            const res = await axios.post("/agent/name/update-by-email", {
                email: email,
                name: name
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                await getUserProfileInfo();
                let alertBox = document.querySelector("#agent_profile_success_alert");
                alertBox.textContent = "Name updated successfully!";
                alertBox.classList.remove("d-none");
                alertBox.classList.add("show");
                
                setTimeout(() => {
                    alertBox.classList.add("d-none");
                }, 2000);

                document.querySelector("#profile_agent_name").setAttribute("readonly", true);
            } else {
                alert("Update failed: " + res.data.message);
            }

        } catch (error) {
            console.error(error);
            alert("Something went wrong! Server Error or Token Expired");
        }
    }

    // Get Agent Info (email, id, name)
    getUserProfileInfo();
    async function getUserProfileInfo() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
        }

        try {
            let res = await axios.get("/user/details/agent", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                console.log(res.data.data);
                document.querySelector("#profile_agent_id").value = res.data.data.id;
                document.querySelector("#profile_agent_name").value = res.data.data.name;
                document.querySelector("#profile_agent_email").value = res.data.data.email;
            }
            return true;
        } catch (error) {
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message);
                localStorage.removeItem('token');
                window.location.href = "/agent/login";
            } else {
                alert("Something went wrong!");
                console.error(error);
            }
        }
    }

    // Upload Agent Profile
    async function agentProfileUpload(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        // Clear Errors
        const errorFields = [
            "phone", "address", "city", "state", "country",
            "zip_code", "designation", "about", "gender", "profile_image"
        ];
        errorFields.forEach(field => {
            document.querySelector(`#profile_agent_${field}_error`).innerHTML = "";
        });

        // Collect Values
        const id = document.querySelector("#profile_agent_id").value.trim();
        const phone = document.querySelector("#profile_agent_phone").value.trim();
        const altPhone = document.querySelector("#profile_agent_alternate_phone").value.trim();
        const address = document.querySelector("#profile_agent_address").value.trim();
        const city = document.querySelector("#profile_agent_city").value.trim();
        const state = document.querySelector("#profile_agent_state").value.trim();
        const country = document.querySelector("#profile_agent_country").value.trim();
        const zip = document.querySelector("#profile_agent_zip_code").value.trim();
        const image = document.querySelector("#profile_agent_profile_image").files[0];
        const about = document.querySelector("#profile_agent_about").value.trim();
        const designation = document.querySelector("#profile_agent_designation").value.trim();
        const facebook = document.querySelector("#profile_agent_facebook").value.trim();
        const twitter = document.querySelector("#profile_agent_twitter").value.trim();
        const linkedin = document.querySelector("#profile_agent_linkedin").value.trim();
        const website = document.querySelector("#profile_agent_website").value.trim();
        const gender = document.querySelector("#profile_agent_gender").value.trim();

        let isError = false;

        // Validation
        if (phone === "") {
            document.querySelector("#profile_agent_phone_error").innerHTML = "Phone is required";
            isError = true;
        }
        if (address === "") {
            document.querySelector("#profile_agent_address_error").innerHTML = "Address is required";
            isError = true;
        }
        if (city === "") {
            document.querySelector("#profile_agent_city_error").innerHTML = "City is required";
            isError = true;
        }
        if (state === "") {
            document.querySelector("#profile_agent_state_error").innerHTML = "State is required";
            isError = true;
        }
        if (country === "") {
            document.querySelector("#profile_agent_country_error").innerHTML = "Country is required";
            isError = true;
        }
        if (zip === "") {
            document.querySelector("#profile_agent_zip_code_error").innerHTML = "Zip Code is required";
            isError = true;
        }
        if (designation === "") {
            document.querySelector("#profile_agent_designation_error").innerHTML = "Designation is required";
            isError = true;
        }
        if (about === "") {
            document.querySelector("#profile_agent_about_error").innerHTML = "About is required";
            isError = true;
        }
        if (gender === "") {
            document.querySelector("#profile_agent_gender_error").innerHTML = "Gender is required";
            isError = true;
        }

        if (isError) return;

        // Prepare FormData
        let data = new FormData();
        data.append("agent_id", id);
        data.append("phone", phone);
        data.append("alternate_phone", altPhone);
        data.append("address", address);
        data.append("city", city);
        data.append("state", state);
        data.append("country", country);
        data.append("zip_code", zip);
        data.append("designation", designation);
        data.append("about", about);
        data.append("facebook", facebook);
        data.append("twitter", twitter);
        data.append("linkedin", linkedin);
        data.append("website", website);
        data.append("gender", gender);
        if (image) {
            data.append("profile_image", image);
        }

        try {
            let res = await axios.post("/agent/profile/store", data, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === "success") {
                document.querySelector("#profile_agent_profile_image_preview").src =
                    '/upload/dashboard/images/agent/default.png';

                await getAgentProfileDetails();
                await enableNameEdit();

                window.scrollTo({ top: 0, behavior: 'smooth' });

                let success_alert_box = document.querySelector("#agent_profile_success_alert");
                success_alert_box.classList.remove("d-none");
                success_alert_box.classList.add("show");
                success_alert_box.scrollIntoView({ behavior: "smooth" });

                setTimeout(() => {
                    success_alert_box.classList.add("d-none");
                }, 2000);
            }

        } catch (error) {
            console.error("error", error);
        }
    }

    // Agent Profile Details Load
    getAgentProfileDetails();
    async function getAgentProfileDetails() {
        const agent_id = document.querySelector("#profile_agent_id").value;
        const token = localStorage.getItem("token");

        try {
            const res = await axios.post("/agent/profile/details", {
                agent_id: agent_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                let profile = res.data.data;
                console.log('profile',profile);
                document.querySelector("#profile_agent_phone").value = profile.phone ?? "";
                document.querySelector("#profile_agent_alternate_phone").value = profile.alternate_phone ?? "";
                document.querySelector("#profile_agent_address").value = profile.address ?? "";
                document.querySelector("#profile_agent_city").value = profile.city ?? "";
                document.querySelector("#profile_agent_state").value = profile.state ?? "";
                document.querySelector("#profile_agent_country").value = profile.country ?? "";
                document.querySelector("#profile_agent_zip_code").value = profile.zip_code ?? "";
                document.querySelector("#profile_agent_about").value = profile.about ?? "";
                document.querySelector("#profile_agent_designation").value = profile.designation ?? "";
                document.querySelector("#profile_agent_facebook").value = profile.facebook ?? "";
                document.querySelector("#profile_agent_twitter").value = profile.twitter ?? "";
                document.querySelector("#profile_agent_linkedin").value = profile.linkedin ?? "";
                document.querySelector("#profile_agent_website").value = profile.website ?? "";
                document.querySelector("#profile_agent_gender").value = profile.gender?.toLowerCase() ?? "";

                document.querySelector("#profile_agent_profile_image_preview").src =
                    profile.profile_image && profile.profile_image.trim() !== ""
                        ? `/upload/dashboard/images/agent/${profile.profile_image}`
                        : '/upload/dashboard/images/agent/default.png';
            }
        } catch (error) {
            console.error("error", error);
        }
    }

    // Preview Profile Image
    function agentPreviewProfileImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("profile_agent_profile_image_preview");
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
