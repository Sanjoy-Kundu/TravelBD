<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- Core Menu -->
                    <div class="sb-sidenav-menu-heading">Main</div>
                    <a class="nav-link" href="{{ url('/customer/dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <!-- Profile -->
                    <a class="nav-link" href="{{ url('/customer/view/profile') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                        My Profile
                    </a>

                    <!-- My Package -->
                    <a class="nav-link" href="{{ url('/customer/my-package') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                        My Package
                    </a>

                    <!-- Payment Status -->
                    <a class="nav-link" href="{{ url('/customer/payment-status') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                        Payment Status
                    </a>

                    <!-- Visa & Fly Info -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVisaFly"
                        aria-expanded="false" aria-controls="collapseVisaFly">
                        <div class="sb-nav-link-icon"><i class="fas fa-plane-departure"></i></div>
                        Visa & Fly Status
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseVisaFly" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ url('/customer/visa-status') }}">Visa Status</a>
                            <a class="nav-link" href="{{ url('/customer/fly-status') }}">Fly Schedule</a>
                        </nav>
                    </div>

                    <!-- Support -->
                    <a class="nav-link" href="{{ url('/customer/support') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-headset"></i></div>
                        Support
                    </a>

                </div>
            </div>
        </nav>
    </div>

    <!-- Start Main Content Area -->
    <div id="layoutSidenav_content">
        <main>
