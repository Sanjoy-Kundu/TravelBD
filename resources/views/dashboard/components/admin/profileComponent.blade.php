<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Profile Create</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto">

        {{-- success alert message --}}
        <div id="admin_profile_success_alert" class="alert alert-success w-100 text-center mb-2 d-none" role="alert">
            Profile has been uploaded successfully!
        </div>

        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Admin Profile Information
        </div>
        <div class="card-body">
            <form action="" method="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="phone">Admin Id</label>
                        <input type="tel" class="form-control" id="profile_admin_id" name="admin_id" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="profile_admin_name">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="profile_admin_name" readonly
                                onclick="enableNameEdit()">
                            <button class="btn btn-warning" type="button" onclick="updateAdminName()">Update</button>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control bg-danger text-white" id="profile_admin_email"
                            readonly>
                    </div>
                </div>

                <!-- Phone -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" id="profile_admin_phone"
                            placeholder="Enter Your Phone">
                        <span class="text-danger" id="profile_admin_phone_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alternate Phone (optional)</label>
                        <input type="tel" class="form-control" id="profile_admin_alternate_phone"
                            placeholder="Enter Your Alternate Phone">
                    </div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <input type="text" class="form-control" id="profile_admin_address"
                            placeholder="Enter Your Address">
                        <span class="text-danger" id="profile_admin_address_error"></span>
                    </div>
                </div>

                <!-- City, State -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>City</label>
                        <input type="text" class="form-control" id="profile_admin_city"
                            placeholder="Enter Your City">
                        <span class="text-danger" id="profile_admin_city_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>State</label>
                        <input type="text" class="form-control" id="profile_admin_state"
                            placeholder="Enter Your State">
                        <span class="text-danger" id="profile_admin_state_error"></span>
                    </div>
                </div>

                <!-- Country, Zip -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" id="profile_admin_country"
                            placeholder="Enter Your Country">
                        <span class="text-danger" id="profile_admin_country_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" id="profile_admin_zip_code"
                            placeholder="Enter Your Zip Code">
                        <span class="text-danger" id="profile_admin_zip_code_error"></span>
                    </div>
                </div>

                <!-- Designation & Image -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Designation</label>
                        <input type="text" class="form-control" id="profile_admin_designation"
                            placeholder="Enter Your Designation">
                        <span class="text-danger" id="profile_admin_designation_error"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Profile Image</label>
                        <input type="file" class="form-control-file" id="profile_admin_profile_image"
                            onchange="adminPreviewProfileImage(event)">
                    </div>
                    <img src="/upload/dashboard/images/admin/default.png" id="profile_admin_profile_image_preview"
                        class="" alt="Profile Image"
                        style="width: 200px;height: 200px;border-radius: 18px;margin-top: 10px;">
                </div>

                <!-- About -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>About</label>
                        <textarea class="form-control" id="profile_admin_about" rows="4"></textarea>
                        <span class="text-danger" id="profile_admin_about_error"></span>
                    </div>
                </div>

                <!-- Social -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Facebook URL</label>
                        <input type="url" class="form-control" id="profile_admin_facebook"
                            placeholder="https://facebook.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Twitter URL</label>
                        <input type="url" class="form-control" id="profile_admin_twitter"
                            placeholder="https://twitter.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>LinkedIn URL</label>
                        <input type="url" class="form-control" id="profile_admin_linkedin"
                            placeholder="https://linkedin.com/">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Website</label>
                        <input type="url" class="form-control" id="profile_admin_website"
                            placeholder="https://yourwebsite.com/">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4" onclick="adminProfile(event)">Save
                        Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fetch Admin Basic Info
    getUserProfileInfo().then(() => {
        getAdminProfileDetails();
    });

    //only name 
    function enableNameEdit() {
        const nameInput = document.querySelector("#profile_admin_name");
        nameInput.removeAttribute("readonly");
        nameInput.focus();
    }
    // Update name by calling backend
    async function updateAdminName() {
        const email = document.querySelector("#profile_admin_email").value.trim();
        const name = document.querySelector("#profile_admin_name").value.trim();
        const token = localStorage.getItem("token");

        if (name === "") {
            alert("Name field is required");
            return;
        }

        try {
            const res = await axios.post("/admin/name/update-by-email", {
                email: email,
                name: name
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                let alertBox = document.querySelector("#admin_profile_success_alert");
                alertBox.textContent = "Name updated successfully!";
                alertBox.classList.remove("d-none");
                alertBox.classList.add("show");

                setTimeout(() => {
                    alertBox.classList.add("d-none");
                }, 2000);

                // Make it readonly again after update
                document.querySelector("#profile_admin_name").setAttribute("readonly", true);
            } else {
                alert("Update failed: " + res.data.message);
            }

        } catch (error) {
            console.error(error);
            alert("Something went wrong! Server Error or Token Expired");
        }
    }















    async function getUserProfileInfo() {
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
            });

            if (res.data.status === "success") {
                document.querySelector("#profile_admin_id").value = res.data.data.id;
                document.querySelector("#profile_admin_name").value = res.data.data.name;
                document.querySelector("#profile_admin_email").value = res.data.data.email;
            }
            return true;
        } catch (error) {
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message);
                localStorage.removeItem('token');
                window.location.href = "/admin/login";
            } else {
                alert("Something went wrong!");
                console.error(error);
            }
        }
    }

    // Save Admin Profile
    async function adminProfile(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        // Clear all error messages
        document.querySelector("#profile_admin_phone_error").innerHTML = "";
        document.querySelector("#profile_admin_address_error").innerHTML = "";
        document.querySelector("#profile_admin_city_error").innerHTML = "";
        document.querySelector("#profile_admin_state_error").innerHTML = "";
        document.querySelector("#profile_admin_country_error").innerHTML = "";
        document.querySelector("#profile_admin_zip_code_error").innerHTML = "";
        document.querySelector("#profile_admin_designation_error").innerHTML = "";
        document.querySelector("#profile_admin_about_error").innerHTML = "";

        // Get all input values
        let admin_id = document.querySelector("#profile_admin_id").value.trim();
        let phone = document.querySelector("#profile_admin_phone").value.trim();
        let alternate_phone = document.querySelector("#profile_admin_alternate_phone").value.trim();
        let address = document.querySelector("#profile_admin_address").value.trim();
        let city = document.querySelector("#profile_admin_city").value.trim();
        let state = document.querySelector("#profile_admin_state").value.trim();
        let country = document.querySelector("#profile_admin_country").value.trim();
        let zip_code = document.querySelector("#profile_admin_zip_code").value.trim();
        let profile_image = document.querySelector("#profile_admin_profile_image").files[0];
        let about = document.querySelector("#profile_admin_about").value.trim();
        let designation = document.querySelector("#profile_admin_designation").value.trim();
        let facebook = document.querySelector("#profile_admin_facebook").value.trim();
        let twitter = document.querySelector("#profile_admin_twitter").value.trim();
        let linkedin = document.querySelector("#profile_admin_linkedin").value.trim();
        let website = document.querySelector("#profile_admin_website").value.trim();

        let isError = false;

        // Validation
        if (phone === "") {
            document.querySelector("#profile_admin_phone_error").innerHTML = "Phone is required";
            isError = true;
        }
        if (address === "") {
            document.querySelector("#profile_admin_address_error").innerHTML = "Address is required";
            isError = true;
        }
        if (city === "") {
            document.querySelector("#profile_admin_city_error").innerHTML = "City is required";
            isError = true;
        }
        if (state === "") {
            document.querySelector("#profile_admin_state_error").innerHTML = "State is required";
            isError = true;
        }
        if (country === "") {
            document.querySelector("#profile_admin_country_error").innerHTML = "Country is required";
            isError = true;
        }
        if (zip_code === "") {
            document.querySelector("#profile_admin_zip_code_error").innerHTML = "Zip Code is required";
            isError = true;
        }
        if (designation === "") {
            document.querySelector("#profile_admin_designation_error").innerHTML = "Designation is required";
            isError = true;
        }
        if (about === "") {
            document.querySelector("#profile_admin_about_error").innerHTML = "About is required";
            isError = true;
        }

        if (isError) return;

        // Prepare Data
        let data = new FormData();
        data.append('admin_id', admin_id);
        data.append('phone', phone);
        data.append('alternate_phone', alternate_phone);
        data.append('address', address);
        data.append('city', city);
        data.append('state', state);
        data.append('country', country);
        data.append('zip_code', zip_code);
        if (profile_image) {
            data.append('profile_image', profile_image);
        } else {
            data.append('profile_image', '')
        }
        data.append('about', about);
        data.append('designation', designation);
        data.append('facebook', facebook);
        data.append('twitter', twitter);
        data.append('linkedin', linkedin);
        data.append('website', website);

        //only can see when i use FormData
        // for (let keyValue of data.entries()) {
        //     console.log(keyValue[0] + ': ' + keyValue[1]);
        //     }

        try {
            let res = await axios.post("/admin/profile/store", data, {
                headers: {
                    "Authorization": `Bearer ${token}`
                }
            });

            if (res.data.status == "success") {
                await getAdminProfileDetails();
                //await updateAdminNameByEmail();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                let success_alert_box = document.querySelector("#admin_profile_success_alert")
                success_alert_box.classList.remove("d-none");
                success_alert_box.classList.add("show");

                setTimeout(() => {
                    success_alert_box.classList.add("d-none");
                }, 2000);

            } else {
                console.log(res.data)
            }
        } catch (error) {
            console.error("error", error)
        }
    }



    //admin profile details
    // getAdminProfileDetails();
    async function getAdminProfileDetails() {
        //catcg admin_id
        let admin_id = document.querySelector("#profile_admin_id").value;
        console.log(admin_id);
        let token = localStorage.getItem("token");
        try {
            //pass admin id
            let res = await axios.post("/admin/profile/details", {
                admin_id: admin_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            if (res.data.status == "success") {
                console.log(res.data.data)
                document.querySelector("#profile_admin_phone").value = res.data.data.phone;
                document.querySelector("#profile_admin_alternate_phone").value = res.data.data.alternate_phone;
                document.querySelector("#profile_admin_address").value = res.data.data.address;
                document.querySelector("#profile_admin_city").value = res.data.data.city;
                document.querySelector("#profile_admin_state").value = res.data.data.state;
                document.querySelector("#profile_admin_country").value = res.data.data.country;
                document.querySelector("#profile_admin_zip_code").value = res.data.data.zip_code;
                document.querySelector("#profile_admin_about").value = res.data.data.about;
                document.querySelector("#profile_admin_designation").value = res.data.data.designation;
                document.querySelector("#profile_admin_facebook").value = res.data.data.facebook;
                document.querySelector("#profile_admin_twitter").value = res.data.data.twitter;
                document.querySelector("#profile_admin_linkedin").value = res.data.data.linkedin;
                document.querySelector("#profile_admin_website").value = res.data.data.website;
                document.querySelector("#profile_admin_profile_image_preview").src = res.data.data.profile_image ?
                    `/upload/dashboard/images/admin/${res.data.data.profile_image}` :
                    '/upload/dashboard/images/admin/default.png';
            }
        } catch (error) {
            console.error("error", error)
        }
    }



    // image preview
    function adminPreviewProfileImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("profile_admin_profile_image_preview");
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
