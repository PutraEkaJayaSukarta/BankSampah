<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Superuser\AdminManagementController;
use App\Http\Controllers\Superuser\DashboardController as SuperuserDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Area Superuser
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:superuser'])->prefix('superuser')->group(function () {
    Route::get('/dashboard', SuperuserDashboardController::class)
        ->name('superuser.dashboard');

    Route::get('/admins', [AdminManagementController::class, 'index'])
        ->name('superuser.admins.index');
    Route::get('/admins/create', [AdminManagementController::class, 'create'])
        ->name('superuser.admins.create');
    Route::post('/admins', [AdminManagementController::class, 'store'])
        ->name('superuser.admins.store');
    Route::delete('/admins/{admin}', [AdminManagementController::class, 'destroy'])
        ->name('superuser.admins.destroy');
});

/*
|--------------------------------------------------------------------------
| Area Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)
        ->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Area User
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', UserDashboardController::class)
        ->name('user.dashboard');
});
