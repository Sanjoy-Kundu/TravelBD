<!-- Staff View Modal -->
<div class="modal fade" id="viewStaffDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staffDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header text-white" style="background-color:#e7c2c2">
                <h5 class="modal-title" id="staffDetailsLabel">👤 Staff Profile View</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color:rgb(222, 221, 221)">
                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img id="staff_profile_image" src="/upload/dashboard/images/staff/default.png"
                        class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;"
                        alt="Staff Image">
                </div>

                <!-- Staff Info Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td id="staff_name_td">N/A</td>
                                <th>Email</th>
                                <td id="staff_email_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td id="staff_phone_td">N/A</td>
                                <th>Alternate Phone</th>
                                <td id="staff_alternate_phone_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td id="staff_designation_td">N/A</td>
                                <th>Verified Status</th>
                                <td id="staff_verified_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td id="staff_role_td">N/A</td>
                                <th>Gender</th>
                                <td id="staff_gender_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td id="staff_address_td">N/A</td>
                                <th>City</th>
                                <td id="staff_city_td">N/A</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td id="staff_state_td">N/A</td>
                                <th>Country</th>
                                <td id="staff_country_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td id="staff_zip_code_td">N/A</td>
                                <th>About</th>
                                <td id="staff_about_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td id="staff_facebook_td">N/A</td>
                                <th>LinkedIn</th>
                                <td id="staff_linkedin_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Twitter</th>
                                <td id="staff_twitter_td">N/A</td>
                                <th>Website</th>
                                <td id="staff_website_td">N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer" style="background-color:#e7c2c2">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
    async function getViewstaffDetailsModalFillup(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.post("/staff/view/details/modal", { id: id }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                let staff = res.data.data;
                let profile = staff.profile ?? {};
                console.log(profile);

                // Set text in table cells
                document.getElementById("staff_name_td").innerText = staff.name ?? 'N/A';
                document.getElementById("staff_email_td").innerText = staff.email ?? 'N/A';
                document.getElementById("staff_phone_td").innerText = profile.phone ?? 'N/A';
                document.getElementById("staff_alternate_phone_td").innerText = profile.alternate_phone ?? 'N/A';
                document.getElementById("staff_designation_td").innerText = profile.designation ?? 'N/A';
                document.getElementById("staff_verified_td").innerText = staff.is_verified == 1 ? '✅ Verified' : '❌ Not Verified';
                document.getElementById("staff_role_td").innerText = staff.role ?? 'N/A';
                document.getElementById("staff_gender_td").innerText = profile.gender ?? 'N/A';

                document.getElementById("staff_address_td").innerText = profile.address ?? 'N/A';
                document.getElementById("staff_city_td").innerText = profile.city ?? 'N/A';
                document.getElementById("staff_state_td").innerText = profile.state ?? 'N/A';
                document.getElementById("staff_country_td").innerText = profile.country ?? 'N/A';
                document.getElementById("staff_zip_code_td").innerText = profile.zip_code ?? 'N/A';
                document.getElementById("staff_about_td").innerText = profile.about ?? 'N/A';

                document.getElementById("staff_facebook_td").innerText = profile.facebook ?? 'N/A';
                document.getElementById("staff_linkedin_td").innerText = profile?.linkedin ?? 'N/A';
                document.getElementById("staff_twitter_td").innerText = profile.twitter ?? 'N/A';
                document.getElementById("staff_website_td").innerText = profile.website ?? 'N/A';

                // Profile Image
                const image = profile.profile_image
                    ? `/upload/dashboard/images/staff/${profile.profile_image}`
                    : `/upload/dashboard/images/staff/default.png`;
                document.getElementById("staff_profile_image").src = image;
            }

        } catch (error) {
            console.error("Modal Load Error:", error);
        }
    }
</script>
