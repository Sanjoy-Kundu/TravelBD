<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4 shadow">
                <div class="card-body">
                    Total Admins: <ol>
                        <li>Total Admins
                            <ol>
                                <li>Admin: <span id="count_admins">0</span></li>
                                <li>Trash Admin: <span id="trash_admins">0</span></li>
                            </ol>
                        </li>
                    </ol>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="text-white stretched-link" href="{{ url('/admin/lists') }}" target="_blank">View</a>
                    <i class="fas fa-user-shield fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white mb-4 shadow">
                <div class="card-body">
                    <ul>
                        <li>Total Staffs:
                            <ol>
                                <li>Staffs: <span id="count_staffs">0</span></li>
                                <li>Trash Staffs: <span id="trash_staffs">0</span></li>
                            </ol>
                        </li>
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="text-white stretched-link" href="{{ url('/staffs/lists') }}" target="_blank">View</a>
                    <i class="fas fa-users-cog fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white mb-4 shadow">
                <div class="card-body">
                    <ul>
                        <li>Total Agents: 
                            <ol>
                                <li>Agents: <span id="count_agents">0</span></li>
                                <li>Trash Agents: <span id="trash_agents">0</span></li>
                            </ol>
                        </li>
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="text-white stretched-link" href="{{ url('/agent/lists') }}" target="_blank">View</a>
                    <i class="fas fa-user-tie fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white mb-4 shadow">
                <div class="card-body">
                    <ul>
                        <li>Packages:
                                <ol type="i">
                                    <li>packages: <span id="count_packages">0</span></li>
                                    <li>Trash Packae: <span id="trash_packages">0</span></li>
                                </ol>    
                        </li>
                    </ul>
                    
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="text-white stretched-link" href="{{ url('/package/lists') }}" target="_blank">View</a>
                    <i class="fas fa-box fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
    document.addEventListener("DOMContentLoaded", async () => {
        let token = localStorage.getItem("token");
        if(!token){
            window.location.href = "{{ url('/admin/login') }}";
        }

        try {
            const res = await axios.get('/admin/dashboard/counts', {
                headers: { Authorization: `Bearer ${token}` }
            });

            if (res.data.status === 'success') {
                let counts = res.data.data;

                document.getElementById('count_admins').innerText = counts.admins;
                document.getElementById('count_staffs').innerText = counts.staffs;
                document.getElementById('count_agents').innerText = counts.agents;
                document.getElementById('count_packages').innerText = counts.packages;

                document.getElementById('trash_packages').innerText = counts.packages_trash;
            }
        } catch (err) {
            console.error("Dashboard count fetch error:", err);
        }
    });
</script>
