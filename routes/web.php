<?php

use App\Models\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffProfileController;


//login get route for admin
Route::get("/admin/registration", [RegistrationController::class, "adminRegisterPage"]);
Route::get("/admin/login", [LoginController::class, "adminLoginPage"])->name("login");
Route::get("/otp/verify", [AdminController::class, "otpVerifyPage"]);



//login get route for staff
Route::get("/staff/login", [LoginController::class, "staffLoginPage"])->name("staff.login");
Route::get("/staff/otp/verify", [StaffController::class, "otpVerifyPage"]);



//login get route for agent
Route::get("/agent/login", [LoginController::class, "agentLoginPage"])->name("agent.login");



//for staff post method for login and otp verify
Route::post("/staff/login/store", [StaffController::class, "staff_login_store"]);
Route::post("/staff/otp/verify/store", [StaffController::class, "staff_otp_verify_store"]);
Route::post("/staff/resend/otp", [StaffController::class, "staff_resend_otp"]);




//=======================StaffController pages ============================
//staff controller dashboard page get route
Route::get("/staff/dashboard", [StaffController::class, "staffDashboardPage"]);
Route::get("/staff/view/profile", [StaffController::class, "staffProfileViewPage"]); #frontend page
Route::get('/staff/profile/create', [StaffProfileController::class, "staffProfilePage"]);

//staff dahbord customer create page
Route::get('/staff/customer/create', [StaffController::class, "customerCreatePage"]);







/**
 * =====================Admin Controller and Pages ==========================
 */
Route::post("/admin/login/store", [AdminController::class, "admin_login_store"]);
Route::post("/admin/registration/store", [AdminController::class, "admin_registration_store"]);
Route::post("/otp/verify/store", [AdminController::class, "otp_verify_store"]);


//dashboard page  for admin
Route::get("/admin/dashboard", [AdminController::class, "adminDashboardPage"]);
Route::get('/admin/profile/create', [AdminProfileController::class, "adminProfilePage"]);
Route::get("/admin/view/profile", [AdminProfileController::class, "adminProfileViewPage"]); #frontend page
Route::get("/admin/lists", [AdminController::class, "adminListsPage"]);



// admin dashboard staff staff create page 
Route::get('/staffs/lists',[AdminController::class, "staffListsPage"]);
Route::get("/staff/create", [StaffController::class, "staffCreatePage"]);


//admin dashboard agent create page
Route::get("/agent/create", [AgentController::class, "agentCreatePage"]);
Route::get("/agent/lists",  [AdminController::class, "agentListsPage"]);




//admin create customer create page form 
Route::get('/admin/customer/create', [AdminController::class, "customerCreatePage"]);


//admin dashboard
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
  Route::get("/admin/lists/all/data", [AdminController::class, "adminListsData"]);
  Route::get("/admin/lists/all/trash/data", [AdminController::class, "adminListsTrashData"]);
  Route::get("/user/details/admin", [AdminController::class, "adminDetails"]);
  Route::post("/admin/logout", [AdminController::class, "adminLogout"]);
  Route::post("/admin/name/update-by-email", [AdminController::class, "adminNameUpdateByEmail"]);
//for admin profile 
  Route::post("/admin/profile/details", [AdminProfileController::class, "adminProfileDetails"]); #backend
  Route::post("/admin/profile/store", [AdminProfileController::class, "adminProfileStore"]);
  Route::post("/admin/view/details/modal",[AdminController::class, "adminViewDetailsModal"]);
  Route::post("/admin/delete/trash",[AdminController::class, "adminDeleteTrash"]);
  Route::post("/admin/reset/password",[AdminController::class, "adminResetPassword"]);
  
  
  //admni create staff 
  Route::post("/admin/create/staff/store", [AdminController::class, "CreateStaffStore"]);
  Route::get("/all/staffs/data", [AdminController::class, "allStaffsData"]);
  Route::post("/admin/restore",[AdminController::class, "adminRestore"]);
  Route::post('/admin/permanent/delete',[AdminController::class, "adminPermanentDelete"]);

  Route::post("/staff/trash",[AdminController::class, "stafTrash"]);
  Route::post("/staff/restore",[AdminController::class, "staffRestore"]);
  Route::post('/staff/permanent/delete',[AdminController::class, "staffPermanentDelete"]);
  Route::post("/staff/verify",[AdminController::class, "staffVerify"]);

  Route::get("/trash/staffs/data", [AdminController::class, "trashStaffsData"]);
  Route::post("/staff/view/details/modal",[AdminController::class, "staffViewDetailsModal"]);




  //admin create agent 
  Route::get('/all/agents/data', [AdminController::class, "allAgentsData"]);
  Route::post("/admin/create/agent/store", [AdminController::class, "CreateAgentStore"]);
  Route::post("/agent/verify",[AdminController::class, "agentVerify"]);

  
});






//staff dashboard
Route::middleware(['auth:sanctum', 'staff'])->group(function () {
    Route::get('/auth/staff', [StaffController::class, "staffDetails"]);
    Route::post('/staff/logout', [StaffController::class, "logout"]);

    //staff profile 
    Route::post("/staff/profile/store", [StaffProfileController::class, "staffProfileStore"]);
    Route::post("/staff/profile/details", [StaffProfileController::class, "staffProfileDetails"]);
    Route::post("/staff/name/update-by-email", [StaffController::class, "staffNameUpdateByEmail"]);
    Route::post("/staff/reset/password",[StaffController::class, "staffResetPassword"]);
});

