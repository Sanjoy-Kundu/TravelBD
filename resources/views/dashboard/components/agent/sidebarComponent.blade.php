<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">

          {{-- Core Section --}}
          <div class="sb-sidenav-menu-heading">Core</div>
          <a class="nav-link" href="{{ url('/agent/dashboard') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>

          {{-- Customer Section --}}
          <div class="sb-sidenav-menu-heading">Customers</div>

          <a class="nav-link" href="{{ url('/agent/customer/create') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
            Add Customer
          </a>

          <a class="nav-link" href="{{ url('/agent/customer/lists') }}" target="_blank">
            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
            Customer List
          </a>

          {{-- Commission & Status Tracking --}}
          <div class="sb-sidenav-menu-heading">Tracking</div>
          <a class="nav-link" href="{{ url('/agent/commissions') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
            Commissions
          </a>

          <a class="nav-link" href="{{ url('/agent/status') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
            Customer Status
          </a>

          {{-- Optional: Notification --}}
          <div class="sb-sidenav-menu-heading">Notifications</div>
          <a class="nav-link" href="{{ url('/agent/notifications') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
            Notifications
          </a>

        </div>
      </div>
    </nav>
  </div>

  <div id="layoutSidenav_content">
    <main>
      {{-- Main Content Will Go Here --}}

