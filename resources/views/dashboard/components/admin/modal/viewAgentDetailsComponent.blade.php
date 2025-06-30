<!-- agent View Modal -->
<div class="modal fade" id="viewAgentDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="agentDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header text-white" style="background-color:#e7c2c2">
                <h5 class="modal-title" id="agentDetailsLabel">👤 Agent Profile View</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color:rgb(222, 221, 221)">
                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img id="agent_profile_image" src="/upload/dashboard/images/agent/default.png"
                        class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;"
                        alt="agent Image">
                </div>

                <!-- agent Info Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td id="agent_name_td">N/A</td>
                                <th>Email</th>
                                <td id="agent_email_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td id="agent_phone_td">N/A</td>
                                <th>Alternate Phone</th>
                                <td id="agent_alternate_phone_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td id="agent_designation_td">N/A</td>
                                <th>Verified Status</th>
                                <td id="agent_verified_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td id="agent_role_td">N/A</td>
                                <th>Gender</th>
                                <td id="agent_gender_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td id="agent_address_td">N/A</td>
                                <th>City</th>
                                <td id="agent_city_td">N/A</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td id="agent_state_td">N/A</td>
                                <th>Country</th>
                                <td id="agent_country_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td id="agent_zip_code_td">N/A</td>
                                <th>About</th>
                                <td id="agent_about_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td id="agent_facebook_td">N/A</td>
                                <th>LinkedIn</th>
                                <td id="agent_linkedin_td">N/A</td>
                            </tr>
                            <tr>
                                <th>Twitter</th>
                                <td id="agent_twitter_td">N/A</td>
                                <th>Website</th>
                                <td id="agent_website_td">N/A</td>
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
    async function getViewagentDetailsModalFillup(id) {
    
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.post("/agent/view/details/modal", { id: id }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                let agent = res.data.data;
                let profile = agent.profile ?? {};
                console.log(profile);

                // Set text in table cells
                document.getElementById("agent_name_td").innerText = agent.name ?? 'N/A';
                document.getElementById("agent_email_td").innerText = agent.email ?? 'N/A';
                document.getElementById("agent_phone_td").innerText = profile.phone ?? 'N/A';
                document.getElementById("agent_alternate_phone_td").innerText = profile.alternate_phone ?? 'N/A';
                document.getElementById("agent_designation_td").innerText = profile.designation ?? 'N/A';
                document.getElementById("agent_verified_td").innerText = agent.is_verified == 1 ? '✅ Verified' : '❌ Not Verified';
                document.getElementById("agent_role_td").innerText = agent.role ?? 'N/A';
                document.getElementById("agent_gender_td").innerText = profile.gender ?? 'N/A';

                document.getElementById("agent_address_td").innerText = profile.address ?? 'N/A';
                document.getElementById("agent_city_td").innerText = profile.city ?? 'N/A';
                document.getElementById("agent_state_td").innerText = profile.state ?? 'N/A';
                document.getElementById("agent_country_td").innerText = profile.country ?? 'N/A';
                document.getElementById("agent_zip_code_td").innerText = profile.zip_code ?? 'N/A';
                document.getElementById("agent_about_td").innerText = profile.about ?? 'N/A';

                document.getElementById("agent_facebook_td").innerText = profile.facebook ?? 'N/A';
                document.getElementById("agent_linkedin_td").innerText = profile?.linkedin ?? 'N/A';
                document.getElementById("agent_twitter_td").innerText = profile.twitter ?? 'N/A';
                document.getElementById("agent_website_td").innerText = profile.website ?? 'N/A';

                // Profile Image
                const image = profile.profile_image
                    ? `/upload/dashboard/images/agent/${profile.profile_image}`
                    : `/upload/dashboard/images/agent/default.png`;
                document.getElementById("agent_profile_image").src = image;
            }

        } catch (error) {
            console.error("Modal Load Error:", error);
        }
    }
</script>
