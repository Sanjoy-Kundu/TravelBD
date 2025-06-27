 <div id="layoutSidenav">
     <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
             <div class="sb-sidenav-menu">
                 <div class="nav">
                     <div class="sb-sidenav-menu-heading">Core</div>
                     <a class="nav-link" href="index.html">
                         <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                         Dashboard
                     </a>
                     <div class="sb-sidenav-menu-heading">Interface</div>
                     <a class="nav-link" href="" target="_blank">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Profile Info
                    </a>
                     {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                         data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                         <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                         Layouts
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav">
                             <a class="nav-link" href="layout-static.html">Static Navigation</a>
                             <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                         </nav>
                     </div> --}}
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
                                 data-bs-target="#staffCollapseCustomer" aria-expanded="false" aria-controls="staffCollapseCustomer">
                                 Customers
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="staffCollapseCustomer" data-bs-parent="#sidenavAccordionUser">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="">Add Customer</a>
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
