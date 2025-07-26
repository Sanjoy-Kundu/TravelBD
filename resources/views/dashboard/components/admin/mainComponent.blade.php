<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Section 1: Summary Cards -->
    <div class="row g-4">
        <!-- Admin Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/admin/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 h-100" style="background-color: #4B6587; color: #fff;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Admins</h5>
                            <p class="mb-1 fs-5"><span id="count_admins" data-count="0">0</span></p>
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

        <!-- Customer Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/customer/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 h-100" style="background-color: #38A3A5; color: #fff;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Customers</h5>
                            <p class="mb-1 fs-5"><span id="count_customers" data-count="0">0</span></p>
                            <small>Trash: <span id="trash_customers">0</span></small>
                        </div>
                        <div><i class="fas fa-users fa-3x opacity-75"></i></div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-white fw-semibold">
                        View All Customers <i class="fas fa-arrow-right ms-2"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Agent Card -->
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/agent/lists') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-3 h-100" style="background-color: #6C5CE7; color: #fff;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Total Agents</h5>
                            <p class="mb-1 fs-5"><span id="count_agents" data-count="0">0</span></p>
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
                <div class="card shadow-sm border-0 rounded-3 h-100" style="background-color: #cb9d39; color: #fff;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold">Packages</h5>
                            <p class="mb-1 fs-5"><span id="count_packages" data-count="0">0</span></p>
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


    {{-- bar chart line chart and other charts --}}
    <div class="row g-4 mt-5">
        <div class="col-12 col-md-12">
            <div class="card shadow-sm border-0 rounded-3"
                style="background: linear-gradient(135deg, #dadcde 0%, #e4efed 100%); box-shadow: 0 4px 15px rgba(210, 224, 241, 0.3); color: #1a1a1a;">
                <div class="card-header">
                    <h5 class="mb-0">User Type Allocation</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                    <canvas id="userRoleChart" style="max-height: 100%; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="card shadow-sm border-0 rounded-3"
                style="background: linear-gradient(135deg, #dadcde 0%, #e4efed 100%); box-shadow: 0 4px 15px rgba(210, 224, 241, 0.3); color: #1a1a1a;">
                <div class="card-header">
                    <h5 class="mb-0">Customer Groth Info</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                    <canvas id="customerGrowthChart" style="max-height: 100%; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-12 mt-4">
        <div class="card shadow-sm border-0 rounded-3"
            style="background: linear-gradient(135deg, #dadcde 0%, #e4efed 100%); box-shadow: 0 4px 15px rgba(210, 224, 241, 0.3); color: #1a1a1a;">
            <div class="card-header">
                <h5 class="mb-0">Packages Sold Per Month</h5>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                <canvas id="packageSalesChart" style="max-height: 100%; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
        const token = localStorage.getItem("token");
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

                // Update summary cards if they exist
                if (document.getElementById('count_admins')) {
                    document.getElementById('count_admins').innerText = counts.admins ?? 0;
                }
                if (document.getElementById('trash_admins')) {
                    document.getElementById('trash_admins').innerText = counts.admins_trash ?? 0;
                }
                if (document.getElementById('count_agents')) {
                    document.getElementById('count_agents').innerText = counts.agents ?? 0;
                }
                if (document.getElementById('trash_agents')) {
                    document.getElementById('trash_agents').innerText = counts.agents_trash ?? 0;
                }
                if (document.getElementById('count_packages')) {
                    document.getElementById('count_packages').innerText = counts.packages ?? 0;
                }
                if (document.getElementById('trash_packages')) {
                    document.getElementById('trash_packages').innerText = counts.packages_trash ?? 0;
                }
                if (document.getElementById('count_customers')) {
                    document.getElementById('count_customers').innerText = counts.customers ?? 0;
                }
                if (document.getElementById('trash_customers')) {
                    document.getElementById('trash_customers').innerText = counts.customers_trash ?? 0;
                }

                //user role chart start
                const user_role_chart = document.getElementById('userRoleChart').getContext('2d');


                const backgroundColors = [
                    'rgba(0, 123, 61, 0.9)',
                    'rgba(207, 0, 15, 0.9)',
                    'rgba(255, 193, 7, 0.9)'
                ];

                const borderColors = [
                    'rgba(0, 123, 61, 1)',
                    'rgba(207, 0, 15, 1)',
                    'rgba(255, 193, 7, 1)'
                ];

                new Chart(user_role_chart, {
                    type: 'pie',
                    data: {
                        labels: ['ADMINS', 'AGENTS', 'CUSTOMERS'],
                        datasets: [{
                            label: 'User Roles',
                            data: [
                                counts.admins ?? 0,
                                counts.agents ?? 0,
                                counts.customers ?? 0
                            ],
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 14
                                    },
                                    padding: 15,
                                    boxWidth: 18,
                                    boxHeight: 18,
                                    usePointStyle: true,
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed || 0;
                                        const total = context.chart._metasets[context
                                            .datasetIndex].total;
                                        const percent = total > 0 ? ((value / total) * 100)
                                            .toFixed(1) : 0;
                                        return `${label}: ${value} (${percent}%)`;
                                    }
                                }
                            }
                        }
                    }
                });

                //user role chart end    

                //now customer growth chart start
                const growthRes = await axios.get('/admin/customer-growth-data', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                if (growthRes.data) {
                    const ctx = document.querySelector('#customerGrowthChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: growthRes.data.labels,
                            datasets: [{
                                label: 'New Customers',
                                data: growthRes.data.data,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0
                                    },
                                    title: {
                                        display: true,
                                        text: 'Number of Customers'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });
                }
                //now customer growth chart end



                //package sales chart start
                const packageSalesRes = await axios.get('/admin/package-sales-data', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                if (packageSalesRes.data.sales_count) {
                    const ctx = document.getElementById('packageSalesChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: packageSalesRes.data.labels,
                            datasets: [{
                                label: 'Package Sales',
                                data: packageSalesRes.data.sales_count,
                                backgroundColor: 'rgba(246, 211, 101, 0.7)', // Professional light yellow
                                borderColor: 'rgba(253, 160, 133, 1)', // Soft orange
                                borderWidth: 1,
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Sales'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                tooltip: {
                                    enabled: true,
                                    callbacks: {
                                        label: function(context) {
                                            const index = context.dataIndex;
                                            const salesCount = context.dataset.data[index];
                                            const packageNames = packageSalesRes.data
                                                .package_names[index] || 'No package sold';
                                            return `Sales: ${salesCount} (${packageNames})`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                //package sales chart end

            }
        } catch (error) {
            console.error("Dashboard count fetch error:", error);
        }
    });
</script>
