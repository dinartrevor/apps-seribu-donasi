<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserManagement\PermissionController;
use App\Http\Controllers\UserManagement\ProfileController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('frontEnd.index');
Route::get('/login', [HomeController::class, 'login'])->name('frontEnd.login');
Route::post('/login', [HomeController::class, 'authenticate'])->name('frontEnd.authenticate');
Route::get('/logout', [HomeController::class, 'logout'])->name('frontEnd.logout');
Route::get('/about', [HomeController::class, 'about'])->name('frontEnd.about');
Route::get('/donation', [HomeController::class, 'donation'])->name('frontEnd.donation');

Route::prefix('student')->group(function () {
    Route::group(['middleware' => ['auth']], function() {
        Route::get('profile', [HomeController::class, 'student'])->name('frontEnd.student');
        Route::post('profile', [HomeController::class, 'storeStudent'])->name('frontEnd.student.store');
        Route::post('/password_reset', [HomeController::class, 'submitResetPassword'])->name("frontEnd.password.reset");
        Route::post('donation-store', [HomeController::class, 'storeDonation'])->name('frontEnd.donation.store');
        Route::post('donation-verify/{donation}', [HomeController::class, 'donationVerify'])->name('frontEnd.donation.verify');
    });
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name("login");
    Route::post('/login', [LoginController::class, 'authenticate'])->name("authenticate");
    Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name("forgot.password");
    Route::post('/forgot-password', [LoginController::class, 'sendForgotPassword'])->name("send.forgot.password");
    Route::get('/password_reset', [LoginController::class, 'resetPassword'])->name("password.reset");
    Route::post('/password_reset', [LoginController::class, 'submitResetPassword'])->name("submit.password.reset");
    Route::post('/logout', [LoginController::class, 'logout'])->name("logout");

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', DashboardController::class)->name("dashboard");
        Route::resource('profile', ProfileController::class)->except(['create','edit', 'destroy','update']);
        Route::group(['prefix'=>'user_management',], function(){
            Route::resource('user', UserController::class)->except(['create','edit']);
            Route::resource('role', RoleController::class)->except(['create','edit']);
            Route::resource('permission', PermissionController::class)->except(['create','edit']);
            Route::get('profile', [ProfileController::class, 'index'])->name("profile.index");
            Route::post('profile', [ProfileController::class, 'store'])->name("profile.store");
            Route::get('user-struktur', [UserController::class, 'getStruktur'])->name("user.getStruktur");
        });
        Route::group(['prefix'=>'master_data',], function(){
            Route::resource('payment_method', PaymentMethodController::class)->except(['create','edit']);
        });
    });
    
});
