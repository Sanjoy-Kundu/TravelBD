<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\RegistrationController;
use App\Models\Staff;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/admin/registration", [RegistrationController::class, "adminRegisterPage"]);
Route::get("/admin/login", [LoginController::class, "adminLoginPage"])->name("login");
Route::get("/otp/verify", [AdminController::class, "otpVerifyPage"]);



//for staff
Route::get("/staff/login", [LoginController::class, "staffLoginPage"])->name("staff.login");
Route::get("/staff/otp/verify", [StaffController::class, "otpVerifyPage"]);




//for staff post method 
Route::post("/staff/login/store", [StaffController::class, "staff_login_store"]);
Route::post("/staff/otp/verify/store", [StaffController::class, "staff_otp_verify_store"]);
Route::post("/staff/resend/otp", [StaffController::class, "staff_resend_otp"]);


//dashboard for staff
Route::get("/staff/dashboard", [StaffController::class, "staffDashboard"]);








Route::post("/admin/login/store", [AdminController::class, "admin_login_store"]);
Route::post("/admin/registration/store", [AdminController::class, "admin_registration_store"]);
Route::post("/otp/verify/store", [AdminController::class, "otp_verify_store"]);


//dashboard page  for admin
Route::get("/admin/dashboard", [AdminController::class, "adminDashboardPage"]);
Route::get('/admin/profile/create', [AdminProfileController::class, "adminProfilePage"]);
Route::get("/admin/view/profile", [AdminProfileController::class, "adminProfileViewPage"]); #frontend page
Route::get("/admin/lists", [AdminController::class, "adminListsPage"]);



// admin create staff staff create page 
 Route::get('/staffs/lists',[AdminController::class, "staffListsPage"]);
Route::get("/staff/create", [StaffController::class, "staffCreatePage"]);



//admin dashboard
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
  Route::get("/admin/lists/all/data", [AdminController::class, "adminListsData"]);
  Route::get("/user/details/admin", [AdminController::class, "adminDetails"]);
  Route::post("/admin/logout", [AdminController::class, "adminLogout"]);
  Route::post("/admin/name/update-by-email", [AdminController::class, "adminNameUpdateByEmail"]);
//for admin profile 
  Route::post("/admin/profile/details", [AdminProfileController::class, "adminProfileDetails"]); #backend
  Route::post("/admin/profile/store", [AdminProfileController::class, "adminProfileStore"]);
  Route::post("/admin/view/details/modal",[AdminController::class, "adminViewDetailsModal"]);
  Route::post("/admin/delete-not-verified",[AdminController::class, "adminDeleteNotVerified"]);
  Route::post("/admin/reset/password",[AdminController::class, "adminResetPassword"]);
  
  
  //admni create staff 
  Route::post("/admin/create/staff/store", [AdminController::class, "CreateStaffStore"]);
  Route::get("/all/staffs/data", [AdminController::class, "allStaffsData"]);
  Route::post("/staff/trash",[AdminController::class, "stafTrash"]);
  Route::post("/staff/restore",[AdminController::class, "staffRestore"]);
  Route::post("/staff/verify",[AdminController::class, "staffVerify"]);

  Route::get("/trash/staffs/data", [AdminController::class, "trashStaffsData"]);
});






//staff dashboard
// Route::middleware(['auth', 'second'])->group(function () {
    
// });

