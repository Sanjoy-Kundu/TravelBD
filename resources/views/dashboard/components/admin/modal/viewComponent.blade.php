<!-- Admin View Modal -->
<div class="modal fade" id="viewAdminDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="adminDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header text-white" style="background-color:#b8b5b5">
                <h5 class="modal-title" id="adminDetailsLabel">Admin Profile View</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color:#f7f6f6">
                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img id="admin_profile_image" src="/upload/dashboard/images/admin/default.png"
                        class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;"
                        alt="Admin Image">
                </div>

                <form>
                    <div class="row g-3">
                        <input type="text" id="admin_id" hidden>
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input readonly type="text" class="form-control" id="admin_name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input readonly type="email" class="form-control" id="admin_email">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input readonly type="text" class="form-control" id="admin_phone">
                            </div>
                            <div class="form-group">
                                <label>Alternate Phone</label>
                                <input readonly type="text" class="form-control" id="admin_alternate_phone">
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input readonly type="text" class="form-control" id="admin_designation">
                            </div>
                            <div class="form-group">
                                <label>Verified Status</label>
                                <input readonly type="text" class="form-control" id="admin_verified">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input readonly type="text" class="form-control" id="admin_role">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input readonly type="text" class="form-control" id="admin_gender">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input readonly type="text" class="form-control" id="admin_address">
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input readonly type="text" class="form-control" id="admin_city">
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input readonly type="text" class="form-control" id="admin_state">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input readonly type="text" class="form-control" id="admin_country">
                            </div>
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input readonly type="text" class="form-control" id="admin_zip_code">
                            </div>
                            <div class="form-group">
                                <label>About</label>
                                <textarea readonly class="form-control" id="admin_about" rows="4">N/A</textarea>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Social Links -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label>Facebook</label>
                            <input readonly type="text" class="form-control" id="admin_facebook">
                        </div>
                        <div class="col-md-4">
                            <label>LinkedIn</label>
                            <input readonly type="text" class="form-control" id="admin_linkedin">
                        </div>
                        <div class="col-md-4">
                            <label>Twitter</label>
                            <input readonly type="text" class="form-control" id="admin_twitter">
                        </div>
                        <div class="col-md-12">
                            <label>Website</label>
                            <input readonly type="text" class="form-control" id="admin_website">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer" style="background-color:#b8b5b5">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






<script>
    async function getViewAdminDetailsModalFillup(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        console.log("modal console id", id)
        document.getElementById('admin_id').value = id;
        try {

            let res = await axios.post("/admin/view/details/modal", {
                id: id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            if (res.data.status === "success") {
                let admin = res.data.admin_details;
                let profile = admin.profile?? {};
                //reset field 
                // Reset all input/textarea/image fields
                document.getElementById("admin_name").value = '';
                document.getElementById("admin_email").value = '';
                document.getElementById("admin_phone").value = '';
                document.getElementById("admin_alternate_phone").value = '';
                document.getElementById("admin_designation").value = '';
                document.getElementById("admin_verified").value = '';
                document.getElementById("admin_role").value = '';
                document.getElementById("admin_address").value = '';
                document.getElementById("admin_city").value = '';
                document.getElementById("admin_state").value = '';
                document.getElementById("admin_country").value = '';
                document.getElementById("admin_zip_code").value = '';
                document.getElementById("admin_about").value = '';
                document.getElementById("admin_facebook").value = '';
                document.getElementById("admin_linkedin").value = '';
                document.getElementById("admin_twitter").value = '';
                document.getElementById("admin_website").value = '';
                document.getElementById("admin_gender").value = '';
                document.getElementById("admin_profile_image").src = '/upload/dashboard/images/admin/default.png';







                // Assign with fallback
                document.getElementById("admin_name").value = admin.name ?? 'N/A';
                document.getElementById("admin_email").value = admin.email ?? 'N/A';
                document.getElementById("admin_phone").value = profile.phone ?? 'N/A';
                document.getElementById("admin_alternate_phone").value = profile.alternate_phone ?? 'N/A';
                document.getElementById("admin_designation").value = profile.designation ?? 'N/A';
                document.getElementById("admin_verified").value = admin.is_verified == 1 ? '✅ Verified' :
                    '❌ Not Verified';
                document.getElementById("admin_role").value = admin.role ?? 'N/A';
                document.getElementById("admin_address").value = profile.address ?? 'N/A';
                document.getElementById("admin_city").value = profile.city ?? 'N/A';
                document.getElementById("admin_state").value = profile.state ?? 'N/A';
                document.getElementById("admin_country").value = profile.country ?? 'N/A';
                document.getElementById("admin_zip_code").value = profile.zip_code ?? 'N/A';
                document.getElementById("admin_about").value = profile.about ?? 'N/A';
                document.getElementById("admin_facebook").value = profile.facebook ?? 'N/A';
                document.getElementById("admin_linkedin").value = profile.linkedin ?? 'N/A';
                document.getElementById("admin_twitter").value = profile.twitter ?? 'N/A';
                document.getElementById("admin_website").value = profile.website ?? 'N/A';
                document.getElementById("admin_gender").value = profile.gender ?? 'N/A';

                // Profile Image set
                let image = profile.profile_image ?
                    `/upload/dashboard/images/admin/${profile.profile_image}` :
                    `/upload/dashboard/images/admin/default.png`;
                document.getElementById("admin_profile_image").src = image;

            }


        } catch (error) {
            console.error("error", error)
        }
    }
</script>
