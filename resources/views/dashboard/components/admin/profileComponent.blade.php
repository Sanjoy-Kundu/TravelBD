<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Profile Create</li>
    </ol>

    <!-- Card wrapper -->
    <div class="card mb-4 shadow w-75 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Admin Profile Information
        </div>
        <div class="card-body">
            <form action="" method="" enctype="multipart/form-data">

                <div class="row">
                     <!-- Row 0 -->
                    <div class="col-md-12 mb-3">
                        <label for="phone">Admin Id</label>
                        <input type="tel" name="admin_id" class="form-control" id="profile_admin_id">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="tel" name="" class="form-control" id="profile_admin_name" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="tel" name="" class="form-control bg-danger text-white" id="profile_admin_email" readonly>
                    </div>
                </div>

                <!--Row 1-->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" id="phone"
                            value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alternate_phone">Alternate Phone</label>
                        <input type="tel" name="alternate_phone" class="form-control" id="alternate_phone"
                            value="{{ old('alternate_phone') }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Row 2 -->
                    <div class="col-md-12 mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address"
                            value="{{ old('address') }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Row 3 -->
                    <div class="col-md-12 mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city"
                            value="{{ old('city') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" id="state"
                            value="{{ old('state') }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Row 4 -->
                    <div class="col-md-12 mb-3">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" id="country"
                            value="{{ old('country') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" name="zip_code" class="form-control" id="zip_code"
                            value="{{ old('zip_code') }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Row 5 -->
                    <div class="col-md-12 mb-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" class="form-control" id="designation"
                            value="{{ old('designation') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control-file" id="profile_image">
                    </div>
                </div>

                <div class="row">
                    <!-- Row 6 -->
                    <div class="col-md-12 mb-3">
                        <label for="about">About</label>
                        <textarea name="about" class="form-control" id="about" rows="4">{{ old('about') }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- Social Links Row 7 -->
                    <div class="col-md-12 mb-3">
                        <label for="facebook">Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" id="facebook"
                            value="{{ old('facebook') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="twitter">Twitter URL</label>
                        <input type="url" name="twitter" class="form-control" id="twitter"
                            value="{{ old('twitter') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="linkedin">LinkedIn URL</label>
                        <input type="url" name="linkedin" class="form-control" id="linkedin"
                            value="{{ old('linkedin') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="website">Website</label>
                        <input type="url" name="website" class="form-control" id="website"
                            value="{{ old('website') }}">
                    </div>
                </div>


                <!-- Submit -->
                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    getUserProfileInfo();
    async function getUserProfileInfo(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = "/admin/login";
        }
        try{
          let res = await axios.get("/user/details/admin",{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})

        if(res.data.status == "success"){
            //console.log(res.data.data)
            document.querySelector("#profile_admin_id").value = res.data.data.id;
            document.querySelector("#profile_admin_name").value = res.data.data.name;
            document.querySelector("#profile_admin_email").value = res.data.data.email;
        }
        }catch(error){
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
</script>