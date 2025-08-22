<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;

// frontend routes here

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('explore');
    } else {
        return view('front.pages.guest_entry');
    }
})->name('home');

Route::get('/explore', [BlogController::class, 'index'])->name('explore');

Route::get('/post/{slug}', [BlogController::class, 'readPost'])->name('read_post'); //singlePost
Route::get('/posts/category/{slug}', [BlogController::class, 'CategoryPosts'])->name('category_posts'); //post with selected category
Route::get('/posts/author/{username}',[BlogController::class, 'authorPosts'])->name('author_posts'); //post with selected author
Route::get('/posts/tag/{any}',[BlogController::class, 'tagPosts'])->name('tag_posts'); //post with selected tag
Route::get('/search',[BlogController::class, 'searchPosts'])->name('search_posts'); //search posts

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
            Route::get('/profile/edit','editProfile')->name('edit_profile');
            Route::post('/profile/update','updateProfile')->name('update_profile');
            
        });

        Route::controller(PostController::class)->group(function(){
            Route::get('/post/new','addPost')->name('add_post');
            Route::post('/post/create','createPost')->name('create_post');
            Route::get('/posts','allPosts')->name('posts');
            Route::get('/post/{id}/edit','editPost')->name('edit_post');
            Route::post('/post/update', 'updatePost')->name('update_post');

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
            Route::get('/categories', 'categoriesPage')->name('categories');
            Route::get('/allUsers','usersList')->name('users-list');
            Route::get('/all-posts','usersPosts')->name('users-posts');

        });
    });
});