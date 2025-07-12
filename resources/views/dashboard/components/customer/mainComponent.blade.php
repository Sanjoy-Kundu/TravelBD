<style>
    .dashboard-card {
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Welcome, <span class="customer_name text-primary fw-bold"></span></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Dashboard</li>
    </ol>

    <div class="row g-4">

        <!-- My Package -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-box-open fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">My Package</h6>
                        <small>See what you purchased</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                    <a class="text-white text-decoration-none small" href="{{ url('/customer/my-package') }}">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #04a2ba, #3fbecc);">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-credit-card fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Payment Status</h6>
                        <small>Check your dues</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                    <a class="text-white text-decoration-none small" href="{{ url('/customer/payment/status') }}">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>

        <!-- Visa Status -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #28a745, #1e7e34);">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-passport fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Visa Status</h6>
                        <small>Track your visa</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                    <a class="text-white text-decoration-none small" href="{{ url('/customer/visa-status') }}">Track Visa</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>

        <!-- Fly Schedule -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #dc3545, #a71d2a);">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-plane-departure fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Fly Schedule</h6>
                        <small>Flight & travel date</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                    <a class="text-white text-decoration-none small" href="{{ url('/customer/fly-status') }}">See Schedule</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>

    </div>
</div>
