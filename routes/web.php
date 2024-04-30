<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'index'])->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/app/register', [PagesController::class, 'register']);
    Route::post('/app/auth/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/app/login', [PagesController::class, 'login'])->name('login');
    Route::post('/app/auth/login', [PagesController::class, 'verify_login'])->name('verify_login');
});

Route::get('/app/logout', [PagesController::class, 'logout'])->name('logout');


/* Register Page Route */
Route::get('/app/profile/f/{id}', [PagesController::class, 'info_update'])->name('userProfileUpdate');
