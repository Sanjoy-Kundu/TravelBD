 <div id="layoutSidenav">
     <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
             <div class="sb-sidenav-menu">
                 <div class="nav">
                     <div class="sb-sidenav-menu-heading">Core</div>
                     <a class="nav-link" href="{{url('/agent/dashboard')}}">
                         <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                         Dashboard
                     </a>
                     <div class="sb-sidenav-menu-heading">Interface</div>
                     <a class="nav-link" href="{{url('/agent/profile/create')}}" target="_blank">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Profile Info
                    </a>
                  
                     <!-- User Management Parent -->
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                         data-bs-target="#collapseUserManagement" aria-expanded="false"
                         aria-controls="collapseUserManagement">
                         <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                         User Management
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>

                     <div class="collapse" id="collapseUserManagement" aria-labelledby="headingTwo"
                         data-bs-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionUser">

                             <!-- Admins Submenu -->
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                 data-bs-target="#agentCollapseCustomer" aria-expanded="false" aria-controls="agentCollapseCustomer">
                                 Customers
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="agentCollapseCustomer" data-bs-parent="#sidenavAccordionUser">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="{{url('/agent/customer/create')}}" target="_blank">Add Customer</a>
                                     <a class="nav-link" href="" target="_blank">Customer List</a>
                                 </nav>
                             </div>
                         </nav>
                     </div>
                 </div>
             </div>
          
         </nav>
     </div>
     <div id="layoutSidenav_content">
         <main>
