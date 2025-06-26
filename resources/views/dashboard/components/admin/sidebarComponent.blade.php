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
                     <a class="nav-link" href="{{url('/admin/profile/create')}}" target="_blank">
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
                                 data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                                 Admins
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="collapseAdmins" data-bs-parent="#sidenavAccordionUser">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="">Add Admin</a>
                                     <a class="nav-link" href="{{url('/admin/lists')}}" target="_blank">Admin List</a>
                                 </nav>
                             </div>

                             <!-- Staffs Submenu -->
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                 data-bs-target="#collapseStaffs" aria-expanded="false" aria-controls="collapseStaffs">
                                 Staffs
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="collapseStaffs" data-bs-parent="#sidenavAccordionUser">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="{{url('/staff/create')}}" target="_blank">Add Staff</a>
                                     <a class="nav-link" href="{{url('/staffs/lists')}}" target="_blank">Staff List</a>
                                 </nav>
                             </div>

                             <!-- Agents Submenu -->
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                 data-bs-target="#collapseAgents" aria-expanded="false" aria-controls="collapseAgents">
                                 Agents
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="collapseAgents" data-bs-parent="#sidenavAccordionUser">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="">Add Agent</a>
                                     <a class="nav-link" href="">Agent List</a>
                                 </nav>
                             </div>

                         </nav>
                     </div>







                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                         data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                         <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                         Pages
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                         data-bs-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                 data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                 aria-controls="pagesCollapseAuth">
                                 Authentication
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                 data-bs-parent="#sidenavAccordionPages">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="login.html">Login</a>
                                     <a class="nav-link" href="register.html">Register</a>
                                     <a class="nav-link" href="password.html">Forgot Password</a>
                                 </nav>
                             </div>
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                 data-bs-target="#pagesCollapseError" aria-expanded="false"
                                 aria-controls="pagesCollapseError">
                                 Error
                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                             </a>
                             <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                 data-bs-parent="#sidenavAccordionPages">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="401.html">401 Page</a>
                                     <a class="nav-link" href="404.html">404 Page</a>
                                     <a class="nav-link" href="500.html">500 Page</a>
                                 </nav>
                             </div>
                         </nav>
                     </div>
                     <div class="sb-sidenav-menu-heading">Addons</div>
                     <a class="nav-link" href="charts.html">
                         <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                         Charts
                     </a>
                     <a class="nav-link" href="tables.html">
                         <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                         Tables
                     </a>
                 </div>
             </div>
             <div class="sb-sidenav-footer">
                 <div class="small">Logged in as:</div>
                 Start Bootstrap
             </div>
         </nav>
     </div>
     <div id="layoutSidenav_content">
         <main>
