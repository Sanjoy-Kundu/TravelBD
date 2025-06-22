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
Route::get("/admin/login", [LoginController::class, "adminLoginPage"]);

Route::post("/admin/registration/store", [AdminController::class, "admin_registration_store"]);
