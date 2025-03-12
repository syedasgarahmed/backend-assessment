<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\TimesheetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Admin|User Login Routes
Route::group(['middleware' => ['web']], function () {

    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login.form');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

    // User Routes
    Route::get('/user/login', [AuthController::class, 'showUserLoginForm'])->name('user.login.form');
    Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard')->middleware('auth:user');
});
