<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/projects', [AdminController::class, 'getProjects'])->name('api.getProjects');
    Route::get('/projects/view', [AdminController::class, 'viewProjects'])->name('projects.view');  // New route
    Route::post('/updateProject', [AdminController::class, 'updateProject'])->name('api.updateProject');
    Route::get('/getUsersList', [AdminController::class, 'getUsersList'])->name('api.getUsersList');
    Route::get('/getProjectUsers', [AdminController::class, 'getProjectUsers'])->name('api.getProjectUsers');
    Route::get('/getProjectUsersTable', [AdminController::class, 'getProjectUsersTable'])->name('api.getProjectUsersTable');
    Route::post('/api/createProject', [AdminController::class, 'createProject'])->name('api.createProject');
    Route::get('/users', [AdminController::class, 'getUsers'])->name('api.getUsers');
    Route::get('/users/view', [AdminController::class, 'viewUsers'])->name('users.view');  // New route
    Route::post('/get-user-projects', [AdminController::class, 'getUserProjects'])->name('api.getUserProject');
    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('api.deleteUser');
    Route::get('/api/getUser', [AdminController::class, 'getUser'])->name('api.getUser');
    Route::post('/api/updateUser', [AdminController::class, 'updateUser'])->name('api.updateUser');
    Route::get('/attributes', [AdminController::class, 'getAttributes'])->name('api.getAttributes');
    Route::get('/attributes/view', [AdminController::class, 'viewAttributes'])->name('attributes.view');  // New route
    Route::get('/timesheet', [AdminController::class, 'showTimesheets'])->name('timesheet.view');
    Route::get('/getTimesheets', [AdminController::class, 'getTimesheet'])->name('api.getTimesheet');
    Route::get('/get-user-timesheets/{Id}', [AdminController::class, 'getUserTimesheets'])->name('api.getUserTimesheets');
    Route::post('/update-timesheet-status', [AdminController::class, 'update_TimesheetStatus'])->name('api.update.TimesheetStatus');
    Route::post('/create-timesheet', [AdminController::class, 'createTimesheet'])->name('api.createTimesheet');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('adminLogout');
});


Route::middleware('auth:user')->prefix('user')->group(function () {
    Route::get('/get-projects', [UserController::class, 'getMyProjects'])->name('getMyProjects');
    Route::get('/projects', [UserController::class, 'getProjects'])->name('api.getUserProjects');
    Route::get('/get-timesheet', [UserController::class, 'getMyTimeSheet'])->name('getMyTimeSheet');
    Route::post('/updateTimesheetStatus', [UserController::class, 'updateTimesheetStatus'])->name('api.updateTimesheetStatus');
    Route::get('/timesheets', [UserController::class, 'getTimesheets'])->name('api.getTimesheets');
    Route::post('/logout', [AuthController::class, 'userLogout'])->name('userLogout');
});


