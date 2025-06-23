<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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

Route::post("/admin/login/store", [AdminController::class, "admin_login_store"]);
Route::post("/admin/registration/store", [AdminController::class, "admin_registration_store"]);
Route::post("/otp/verify/store", [AdminController::class, "otp_verify_store"]);


//admin dashboard
Route::get("/admin/dashboard", [AdminController::class, "adminDashboardPage"]);