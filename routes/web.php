<?php

use App\Models\PackageCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AgentProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffProfileController;
use App\Http\Controllers\PackageCategoryController;
use App\Http\Controllers\PackageDiscountController;
use App\Http\Controllers\CustomerPackagePdfController;

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



// ====================== Customer Auth Routes ======================
Route::get('/customer/login', [CustomerController::class, 'customerLoginPage']);
Route::post('/customer/login/store', [CustomerController::class, 'customer_login_store']);


//====================== Customer Dashoboard Routes ======================
Route::get('/customer/dashboard', [CustomerController::class, 'customerDashboard'])->name('customer.dashboard');
Route::get('/customer/my-package', [CustomerController::class, 'myPackageDetailsPage']);
Route::get('/customer/payment/status', [CustomerController::class, 'paymentPage']);

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

// ===================== customer create page =======================
Route::get('/admin/create/customer', [AdminController::class, 'customerCreatePage']);
Route::get('agent/customer/create', [AgentController::class, 'customerCreatePage']);





//===================== Package Managemant get route======================
Route::get("/create/package/category", [PackageCategoryController::class, 'createPackageCategoryPage']);
Route::get("/package/lists", [PackageController::class, 'packageListsPage']);


//===================== Package Coupon get route======================
Route::get('/coupon/lists', [PackageDiscountController::class, 'couponDiscountListsPage']);





// ====================== Admin Protected Routes ======================
Route::middleware(['auth:sanctum'])->group(function () {
    //Admin all data cont
      Route::get('/admin/dashboard/counts', [AdminController::class, 'dashboardCounts']);
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
    Route::get('/admin/package-category/lists', [PackageCategoryController::class, 'CategoryLists']);
    Route::post("/admin/package-category/store", [PackageCategoryController::class, 'CategoryStore']);
    Route::post("/admin/package-category/details", [PackageCategoryController::class, 'CategoryDetails']);
    Route::post("/admin/package-category/update", [PackageCategoryController::class, 'CategoryUpdate']);
    Route::post("/admin/category/delete", [PackageCategoryController::class, 'CategoryTrash']);
   





    //package trash category
    Route::get('/admin/package-category-trash/lists', [PackageCategoryController::class, 'CategoryTrashLists']);
    Route::post('/admin/package-category/restore', [PackageCategoryController::class, 'CategoryRestore']);
    Route::post('/admin/package-category/permanent-delete', [PackageCategoryController::class, 'CategoryPermanentDelete']);



    //package
    Route::get('/admin/package-category/active/lists', [PackageController::class, 'packageActiveLists']);
    Route::post("/admin/package/store", [PackageController::class, 'packageStore']);
    Route::get("/admin/package/lists",[PackageController::class, 'packageLists']);
    Route::post("/admin/package/details", [PackageController::class, 'packageDetails']);
    Route::post("/admin/package-category/delete",[PackageController::class, 'packageTrash']);

    Route::get("/admin/package-trash/lists", [PackageController::class, 'packageTrashLists']);
    Route::post("/admin/package/permanent-delete",[PackageController::class, 'packagePermanentDelete']);
    Route::post("/admin/package/restore",[PackageController::class, 'packageRestore']);
    Route::post("/admin/package/update",[PackageController::class, 'packageUpdate']);




    //package Discout or coupon 
    Route::post('/package-coupon-list',[PackageDiscountController::class, 'packageCouponList']);
    Route::post('/admin/package-coupon-discount', [PackageDiscountController::class, 'packageCouponDiscount']);
    Route::post('/admin/package-coupon/delete', [PackageDiscountController::class, 'packageCouponDelete']);
    Route::post('/admin/package-coupon/edit-details', [PackageDiscountController::class, 'detailsCouponDiscountshow']);
    Route::post('/admin/package-coupon/update', [PackageDiscountController::class, 'couponDiscountUpdate']);


    Route::post('/admin/package-coupon/trash-list', [PackageDiscountController::class, 'packageCouponTrashList']);
    Route::post('/admin/package-coupon/restore', [PackageDiscountController::class, 'packageCouponRestoreList']);
    Route::post('/admin/package-coupon/permanent-delete', [PackageDiscountController::class, 'packageCouponPermanentDelete']);



    //admin added customer 
   Route::get('/category-all/lists', [CustomerController::class, 'allCategoryLists']);
   Route::post('/admin/package/lists/by/category', [CustomerController::class, 'packageListByCategory']);
   Route::post('/admin/package/lists/details/by/catgory', [CustomerController::class, 'packageListDetailsByCategory']);
   Route::post('/admin/package/price/update', [CustomerController::class, 'packagePriceUpdateCustomer']);
   Route::post('/admin/package/apply-coupon', [CustomerController::class, 'packageApplyCoupon']);
   Route::post('/admin/customer/create', [CustomerController::class, 'customerCreateByAdmin']);
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







//===================== for customer =====================
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth/customer', [CustomerController::class, 'customerDetails']);
    Route::post('/customer/package/details-by-id', [CustomerController::class, 'customerPackageDetailsById']);
    Route::post('/customer/update', [CustomerController::class, 'customerUpdate']);
    Route::post('/customer/logout', [CustomerController::class, 'logout']);
    // Route::post('/agent/logout', [AgentController::class, 'logout']);

    // Route::get('/user/details/agent', [AgentController::class, 'agentDetails']);
    // Route::post('/agent/name/update-by-email', [AgentController::class, 'agentNameUpdateByEmail']);
    // Route::post('/agent/profile/store', [AgentProfileController::class, 'agentProfileStore']);
    // Route::post('/agent/profile/details', [AgentProfileController::class, 'agentProfileDetails']);
    // Route::post('/agent/reset/password', [AgentController::class, 'agentResetPassword']);


    //pdf for customer 
    //Route::post('/customer/package/pdf/view', [CustomerPackagePdfController::class, 'customerPackageGeneratePackagePdfView']);
    Route::post('/customer/package/pdf/view-by-id', [PdfController::class, 'customerPackageDetailsView']);
});
