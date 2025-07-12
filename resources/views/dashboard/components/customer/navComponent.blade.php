<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark no-print">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="{{ url('/customer/dashboard') }}">Dashboard</a>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-link btn-sm me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Welcome Message -->
    <span class="text-white text-center">Welcome back, <strong class="customer_name">Customer</strong></span>

    <!-- Right Side Icons -->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li class="dropdown-item">
                    <i class="fas fa-envelope me-2"></i> <span class="nav_customer_user_email">Email</span>
                </li>
                <li class="dropdown-item">
                    <i class="fas fa-envelope me-2"></i> <input type="number" hidden readonly class="customer_id">
                </li>
                <li class="dropdown-item">
                    <i class="fas fa-user-tag me-2"></i> Role: <span class="nav_customer_user_role">Customer</span>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ url('/customer/view/profile') }}" target="_blank">
                        <i class="fas fa-user-circle me-2"></i> Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li class="dropdown-item" onclick="onLogout(event)" style="cursor: pointer;">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    async function onLogout(event) {
        event.preventDefault();
        try {
            let res = await axios.post("/customer/logout", {}, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (res.data.status === "success") {
                localStorage.clear();
                window.location.href = "/customer/login";
            } else {
                console.error("Logout failed:", res.data.message);
            }
        } catch (error) {
            console.error("Logout error:", error);
        }
    }
</script>
