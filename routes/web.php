<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\GalleryController;




Route::get('/', [PagesController::class, 'index'])->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/app/register', [PagesController::class, 'register']);
    Route::post('/app/auth/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/app/login', [PagesController::class, 'login'])->name('login');
    Route::post('/app/auth/login', [PagesController::class, 'verify_login'])->name('verify_login');
});







Route::middleware('auth')->group(function () {
    Route::get('/app/logout', [PagesController::class, 'logout'])->name('logout');
    Route::get('/app/profile/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/app/profile/user-profile-edit/{id}', [DashboardController::class, 'user_profile_edit'])->name('user-profile-edit');
    Route::match(['get', 'put', 'post'], '/app/profile/profile/update', [ProfileController::class, 'update'])->name('profile.update');



    Route::post('/gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');
    Route::get('/app/gallery/upload', [GalleryController::class, 'show_upload']);
    Route::get('/gallery/{image}', [GalleryController::class, 'delete'])->name('gallery.delete');
});


/* Register Page Route */
Route::get('/app/profile/f/{id}', [PagesController::class, 'info_update'])->name('userProfileUpdate');
