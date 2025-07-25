<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="row g-4">
        <!-- Admin Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/admin/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 bg-primary text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Admins</h5>
                            <p class="mb-1 fs-5"><span id="count_admins">0</span></p>
                            <small>Trash: <span id="trash_admins">0</span></small>
                        </div>
                        <div><i class="fas fa-user-shield fa-3x opacity-75"></i></div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-white fw-semibold">
                        View All Admins <i class="fas fa-arrow-right ms-2"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Staff Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/staffs/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 bg-success text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Staffs</h5>
                            <p class="mb-1 fs-5"><span id="count_staffs">0</span></p>
                            <small>Trash: <span id="trash_staffs">0</span></small>
                        </div>
                        <div><i class="fas fa-users-cog fa-3x opacity-75"></i></div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-white fw-semibold">
                        View All Staffs <i class="fas fa-arrow-right ms-2"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Agent Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/agent/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 bg-info text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Agents</h5>
                            <p class="mb-1 fs-5"><span id="count_agents">0</span></p>
                            <small>Trash: <span id="trash_agents">0</span></small>
                        </div>
                        <div><i class="fas fa-user-tie fa-3x opacity-75"></i></div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-white fw-semibold">
                        View All Agents <i class="fas fa-arrow-right ms-2"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Packages Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/package/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 bg-danger text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Packages</h5>
                            <p class="mb-1 fs-5"><span id="count_packages">0</span></p>
                            <small>Trash: <span id="trash_packages">0</span></small>
                        </div>
                        <div><i class="fas fa-box fa-3x opacity-75"></i></div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-white fw-semibold">
                        View All Packages <i class="fas fa-arrow-right ms-2"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <div class="row mt-4 g-4">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-3">
                <div class="card-header">
                    <h5>User Role Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="userRoleChart"></canvas>
                </div>
            </div>
        </div>
         <div class="col-md-6">
        <div class="card shadow-sm rounded-3">
            <div class="card-header">
                <h5>Monthly Packages Sold</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
        let token = localStorage.getItem("token");
        if (!token) {
            window.location.href = "{{ url('/admin/login') }}";
            return;
        }

        try {
            const res = await axios.get('/admin/dashboard/counts', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                const counts = res.data.data;

                document.getElementById('count_admins').innerText = counts.admins ?? 0;
                document.getElementById('trash_admins').innerText = counts.admins_trash ?? 0;

                document.getElementById('count_staffs').innerText = counts.staffs ?? 0;
                document.getElementById('trash_staffs').innerText = counts.staffs_trash ?? 0;

                document.getElementById('count_agents').innerText = counts.agents ?? 0;
                document.getElementById('trash_agents').innerText = counts.agents_trash ?? 0;

                document.getElementById('count_packages').innerText = counts.packages ?? 0;
                document.getElementById('trash_packages').innerText = counts.packages_trash ?? 0;
            }
        } catch (error) {
            console.error('Dashboard count fetch error:', error);
        }
    });



    document.addEventListener("DOMContentLoaded", () => {
    // Pie Chart - User Role Distribution
    const userRoleCtx = document.getElementById('userRoleChart').getContext('2d');
    const userRoleChart = new Chart(userRoleCtx, {
        type: 'pie',
        data: {
            labels: ['Admins', 'Staffs', 'Agents'],
            datasets: [{
                data: [
                    parseInt(document.getElementById('count_admins').innerText),
                    parseInt(document.getElementById('count_staffs').innerText),
                    parseInt(document.getElementById('count_agents').innerText)
                ],
                backgroundColor: ['#007bff', '#28a745', '#17a2b8'],
                hoverOffset: 10
            }]
        }
    });

    // Bar Chart - Monthly Packages Sold (Example static data)
    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    const monthlySalesChart = new Chart(monthlySalesCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Packages Sold',
                data: [12, 19, 8, 15, 10, 7],  // এখানে তোমার ডাইনামিক ডেটা বসাবে
                backgroundColor: '#dc3545'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>
