<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

// Admin
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm']);
    Route::post('login', [LoginController::class, 'adminLogin'])->name('admin.login');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'role_check:admin']);
Route::prefix('admin')->middleware(['auth', 'role_check:admin'])->group(function () {
    Route::resource('/category', CategoryController::class);
});
