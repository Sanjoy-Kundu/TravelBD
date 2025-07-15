<style>
    .navbar-brand {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    .dropdown-menu li {
        padding: 0.4rem 1rem;
    }
</style>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-sm">
    <!-- Brand/Logo -->
    <a class="navbar-brand ps-3 fw-bold text-uppercase" href="/agent/dashboard">
        <i class="fas fa-user-tie me-1"></i> Agent Panel
    </a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-dark btn-sm order-1 order-lg-0 me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Welcome Message -->
    <span class="text-white d-none d-md-block me-auto">
        Welcome, <b class="agent_name"></b>
    </span>

    <!-- Search Bar -->
    {{-- <form class="d-none d-md-inline-block form-inline me-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search..." aria-label="Search" />
            <button class="btn btn-outline-light" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form> --}}

    <!-- Profile Dropdown -->
    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                <li class="dropdown-item text-center">
                    <i class="fas fa-id-badge me-2"></i><span class="nav_agent_user_code fw-bold"></span>
                </li>
                <li class="dropdown-item text-center">
                    <i class="fas fa-envelope me-2"></i><span class="nav_agent_user_email"></span>
                </li>
                <li class="dropdown-item text-center">
                    <i class="fas fa-user-tag me-2"></i><span class="nav_agent_user_role text-capitalize"></span>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item" href="{{ url('/agent/view/profile') }}" target="_blank">
                        <i class="fas fa-user-cog me-2"></i> View Profile
                    </a>
                </li>
                <li>
                    <button class="dropdown-item text-danger" onclick="onLogout(event)">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </li>
            </ul>
        </li>
    </ul>
</nav>

 <script>
async function onLogout(event) {
    event.preventDefault();
    try {
        let res = await axios.post("/agent/logout", {}, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        });
        if (res.data.status == "success") {
            localStorage.clear();
            window.location.href = "/agent/login";
        } else {
            console.log("Logout error:", res.data.message);
        }
    } catch (error) {
        console.error("Logout failed:", error);
    }
}

 </script>
