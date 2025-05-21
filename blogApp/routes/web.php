<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

// testing layout routes
Route::view('/eg-page', 'example-page');
Route::view('/auth-page', 'example-auth');

// routes for registered users
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest', 'preventBackHistory'])->group(function(){
        Route::controller(AuthController::class)->group(function(){

            Route::get('/login','loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');

            Route::get('/register','registerForm')->name('register');
            Route::post('/register', 'registerStore')->name('register.store');

            Route::get('/forgot-password','forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'SendPasswordResetLink')->name('send_password_reset_link');
            
            Route::get('/password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    Route::middleware(['auth','preventBackHistory'])->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/dashboard', 'userDashboard')->name('dashboard');
            Route::post('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'profileView')->name('profile');
        });
    });
});

// admin routes
Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware('guest')->group(function () {
        Route::controller(AdminAuthController::class)->group(function(){
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
        });
    });

    Route::middleware('auth:admin')->group(function () {
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard', 'adminDashboard')->name('admin-dashboard');
            Route::post('/logout', 'logoutHandler')->name('logout');
        });
    });
});