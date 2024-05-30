<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Mail\DynamicMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);

Route::post('/authenticate', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/public-profile/{id}', [App\Http\Controllers\HomeController::class, 'publicProfile']);

Route::middleware(['auth', 'role_check:user', 'verified'])->group(function () {

    Route::get('/account/statistics', [App\Http\Controllers\HomeController::class, 'accountStatistics'])->name('accountStatistics');
    Route::get('/wallet/deposit', [App\Http\Controllers\HomeController::class, 'walletDeposit'])->name('wallet-deposit');
    Route::get('/wallet/withdraw', [App\Http\Controllers\HomeController::class, 'walletWithdraw'])->name('wallet-withdraw');
    Route::post('/wallet/withdraw', [App\Http\Controllers\HomeController::class, 'walletWithdrawStore'])->name('wallet-withdraw-store');

    Route::get('/wallet/deposit/usdt', [App\Http\Controllers\HomeController::class, 'walletDepositUsdt'])->name('wallet-deposit-usdt');
    Route::get('/wallet/withdraw/usdt', [App\Http\Controllers\HomeController::class, 'walletWithdrawUsdt'])->name('wallet-withdraw-usdt');
    Route::post('/wallet/withdraw/usdt', [App\Http\Controllers\HomeController::class, 'walletWithdrawStoreUsdt'])->name('wallet-withdraw-store-usdt');

});


// Admin
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showAdminLoginForm']);
    Route::post('login', [LoginController::class, 'adminLogin'])->name('admin.login');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'role_check:admin']);

Route::prefix('admin')->middleware(['auth', 'role_check:admin'])->group(function () {
    Route::resource('/category', CategoryController::class);
});

Route::get('/send-email', function () {
    $data = ['name' => 'John Doe'];
    $view = 'dynamic_mail.test';
    Mail::to('recipient@example.com')->send(new DynamicMail($view, $data));
    return "Email sent successfully!";
});