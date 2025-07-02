<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AgentProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffProfileController;
use App\Http\Controllers\PackageCategoryController;
use App\Http\Controllers\PackageController;
use App\Models\PackageCategory;

// ====================== Admin Auth Routes ======================
Route::get('/admin/registration', [RegistrationController::class, 'adminRegisterPage']);
Route::get('/admin/login', [LoginController::class, 'adminLoginPage'])->name('login');
Route::get('/otp/verify', [AdminController::class, 'otpVerifyPage']);

Route::post('/admin/login/store', [AdminController::class, 'admin_login_store']);
Route::post('/admin/registration/store', [AdminController::class, 'admin_registration_store']);
Route::post('/otp/verify/store', [AdminController::class, 'otp_verify_store']);

// ====================== Staff Auth Routes ======================
Route::get('/staff/login', [LoginController::class, 'staffLoginPage'])->name('staff.login');
Route::get('/staff/otp/verify', [StaffController::class, 'otpVerifyPage']);

Route::post('/staff/login/store', [StaffController::class, 'staff_login_store']);
Route::post('/staff/otp/verify/store', [StaffController::class, 'staff_otp_verify_store']);
Route::post('/staff/resend/otp', [StaffController::class, 'staff_resend_otp']);

// ====================== Agent Auth Routes ======================
Route::get('/agent/login', [LoginController::class, 'agentLoginPage'])->name('agent.login');
Route::get('/agent/otp/verify', [AgentController::class, 'otpVerifyPage']);

Route::post('/agent/login/store', [AgentController::class, 'agent_login_store'])->name('agent.login.store');
Route::post('/agent/otp/verify/store', [AgentController::class, 'agent_otp_verify_store'])->name('agent.otp.verify.store');

// ====================== Agent Dashboard Routes ======================
Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
Route::get('/agent/profile/create', [AgentProfileController::class, 'agentProfileCreate'])->name('agent.profile.create');
Route::get('/agent/view/profile', [AgentProfileController::class, 'agentProfileViewPage']);

// ====================== Staff Dashboard Routes ======================
Route::get('/staff/dashboard', [StaffController::class, 'staffDashboardPage']);
Route::get('/staff/view/profile', [StaffController::class, 'staffProfileViewPage']);
Route::get('/staff/profile/create', [StaffProfileController::class, 'staffProfilePage']);
Route::get('/staff/customer/create', [StaffController::class, 'customerCreatePage']);

// ====================== Admin Dashboard Routes ======================
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboardPage']);
Route::get('/admin/profile/create', [AdminProfileController::class, 'adminProfilePage']);
Route::get('/admin/view/profile', [AdminProfileController::class, 'adminProfileViewPage']);
Route::get('/admin/lists', [AdminController::class, 'adminListsPage']);

Route::get('/staffs/lists', [AdminController::class, 'staffListsPage']);
Route::get('/staff/create', [StaffController::class, 'staffCreatePage']);

Route::get('/agent/create', [AgentController::class, 'agentCreatePage']);
Route::get('/agent/lists', [AdminController::class, 'agentListsPage']);

Route::get('/admin/customer/create', [AdminController::class, 'customerCreatePage']);





//===================== Package Managemant get route======================
Route::get("/create/package/category", [PackageCategoryController::class, 'createPackageCategoryPage']);
Route::get("/package/lists", [PackageController::class, 'packageListsPage']);





// ====================== Admin Protected Routes ======================
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Admin list
    Route::get('/admin/lists/all/data', [AdminController::class, 'adminListsData']);
    Route::get('/admin/lists/all/trash/data', [AdminController::class, 'adminListsTrashData']);
    Route::get('/user/details/admin', [AdminController::class, 'adminDetails']);
    Route::post('/admin/logout', [AdminController::class, 'adminLogout']);
    Route::post('/admin/name/update-by-email', [AdminController::class, 'adminNameUpdateByEmail']);

    // Admin Profile
    Route::post('/admin/profile/details', [AdminProfileController::class, 'adminProfileDetails']);
    Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore']);

    // Admin Details Modal
    Route::post('/admin/view/details/modal', [AdminController::class, 'adminViewDetailsModal']);
    Route::post('/admin/delete/trash', [AdminController::class, 'adminDeleteTrash']);
    Route::post('/admin/reset/password', [AdminController::class, 'adminResetPassword']);

    // Staff Management
    Route::post('/admin/create/staff/store', [AdminController::class, 'CreateStaffStore']);
    Route::get('/all/staffs/data', [AdminController::class, 'allStaffsData']);
    Route::post('/admin/restore', [AdminController::class, 'adminRestore']);
    Route::post('/admin/permanent/delete', [AdminController::class, 'adminPermanentDelete']);

    Route::post('/staff/trash', [AdminController::class, 'stafTrash']);
    Route::post('/staff/restore', [AdminController::class, 'staffRestore']);
    Route::post('/staff/permanent/delete', [AdminController::class, 'staffPermanentDelete']);
    Route::post('/staff/verify', [AdminController::class, 'staffVerify']);
    Route::get('/trash/staffs/data', [AdminController::class, 'trashStaffsData']);
    Route::post('/staff/view/details/modal', [AdminController::class, 'staffViewDetailsModal']);

    // Agent Management
    Route::get('/all/agents/data', [AdminController::class, 'allAgentsData']);
    Route::post('/admin/create/agent/store', [AdminController::class, 'CreateAgentStore']);
    Route::post('/agent/verify', [AdminController::class, 'agentVerify']);
    Route::post('/agent/trash', [AdminController::class, 'agentTrash']);
    Route::get('/trash/agents/data', [AdminController::class, 'trashAgentsData']);
    Route::post('/agent/permanent/delete', [AdminController::class, 'agentPermanentDelete']);
    Route::post('/agent/restore', [AdminController::class, 'agentRestore']);
    Route::post('/agent/view/details/modal', [AdminController::class, 'agentViewDetailsModal']);



    // package category
    Route::get('/admin/package-category/lists', [PackageCategoryController::class, 'packageCategoryLists']);
    Route::post("/admin/package-category/store", [PackageCategoryController::class, 'packageCategoryStore']);
    Route::post("/admin/package-category/details", [PackageCategoryController::class, 'packageCategoryDetails']);
    Route::post("/admin/package-category/update", [PackageCategoryController::class, 'packageCategoryUpdate']);
    Route::post("/admin/package-category/delete", [PackageCategoryController::class, 'packageCategoryDelete']);

    //package trash category
    Route::get('/admin/package-category-trash/lists', [PackageCategoryController::class, 'packageCategoryTrashLists']);
    Route::post('/admin/package-category/restore', [PackageCategoryController::class, 'packageCategoryRestore']);
    Route::post('/admin/package-category/permanent-delete', [PackageCategoryController::class, 'packageCategoryPermanentDelete']);



    //package
    Route::post("/admin/package/store", [PackageController::class, 'packageStore']);
    Route::get("/admin/package/lists",[PackageController::class, 'packageLists']);
    Route::post("/admin/package/details", [PackageController::class, 'packageDetails']);
    Route::post("/admin/package-category/delete",[PackageController::class, 'packageTrash']);

    Route::get("/admin/package-trash/lists", [PackageController::class, 'packageTrashLists']);
    Route::post("/admin/package/permanent-delete",[PackageController::class, 'packagePermanentDelete']);
    Route::post("/admin/package/restore",[PackageController::class, 'packageRestore']);
    Route::post("/admin/package/update",[PackageController::class, 'packageUpdate']);
});















// ====================== Staff Protected Routes ======================
Route::middleware(['auth:sanctum', 'staff'])->group(function () {
    Route::get('/auth/staff', [StaffController::class, 'staffDetails']);
    Route::post('/staff/logout', [StaffController::class, 'logout']);

    // Staff Profile
    Route::post('/staff/profile/store', [StaffProfileController::class, 'staffProfileStore']);
    Route::post('/staff/profile/details', [StaffProfileController::class, 'staffProfileDetails']);
    Route::post('/staff/name/update-by-email', [StaffController::class, 'staffNameUpdateByEmail']);
    Route::post('/staff/reset/password', [StaffController::class, 'staffResetPassword']);
});

// ====================== Agent Protected Routes ======================
Route::middleware(['auth:sanctum', 'agent'])->group(function () {
    Route::get('/auth/agent', [AgentController::class, 'agentDetails']);
    Route::post('/agent/logout', [AgentController::class, 'logout']);

    Route::get('/user/details/agent', [AgentController::class, 'agentDetails']);
    Route::post('/agent/name/update-by-email', [AgentController::class, 'agentNameUpdateByEmail']);
    Route::post('/agent/profile/store', [AgentProfileController::class, 'agentProfileStore']);
    Route::post('/agent/profile/details', [AgentProfileController::class, 'agentProfileDetails']);
    Route::post('/agent/reset/password', [AgentController::class, 'agentResetPassword']);
});
