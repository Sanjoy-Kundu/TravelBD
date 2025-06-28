 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
     <!-- Navbar Brand-->
     <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
     <!-- Sidebar Toggle-->
     <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
             class="fas fa-bars"></i></button>
     <span class="text-white text-center">Wellcome Back To <b class="staff_name"></b> Dashboard</span>
     <!-- Navbar Search-->
     <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
         <div class="input-group">
             <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                 aria-describedby="btnNavbarSearch" />
             <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
         </div>
     </form>
     <!-- Navbar-->
     <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="fas fa-user-cog fa-fw"></i> <!-- Updated icon to match user management style -->
             </a>
             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <li>
                     <a class="dropdown-item nav_staff_user_name" href="#!">
                         <i class="fas fa-id-badge me-2"></i><span class="nav_staff_user_code"></span>
                     </a>
                 </li>
                 <li class="dropdown-item">
                     <i class="fas fa-envelope me-2"></i><span class="nav_staff_user_email"></span>
                 </li>
                 <li class="dropdown-item">
                     <i class="fas fa-user-tag me-2"></i>Role: <span class="nav_staff_user_role"></span>
                 </li>
                  <li>
                     <a class="dropdown-item" href="{{url('/staff/view/profile')}}" target="_blank">
                         <i class="fas fa-user-circle me-2"></i>Profile
                     </a>
                 </li>
                 <li>
                     <hr class="dropdown-divider" />
                 </li>
                 <li class="dropdown-item" onclick="onLogout(event)" style="cursor: pointer;">
                     <i class="fas fa-sign-out-alt me-2"></i>Logout
                 </li>
             </ul>
         </li>
     </ul>

 </nav>

 <script>
     async function onLogout(event) {
         event.preventDefault();
         try {
             let res = await axios.post("/staff/logout", {}, {
                 headers: {
                     'Authorization': `Bearer ${localStorage.getItem('token')}`
                 }
             })
             if (res.data.status == "success") {
                 localStorage.clear();
                 window.location.href = "/staff/login";
             } else {
                 console.log("error", res.data.message)
             }

         } catch (error) {
             console.error("error", error);
         }
     }
 </script>
