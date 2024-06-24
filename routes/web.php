<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SearchResultController;
use App\Http\Controllers\LoginACValidate;

use Google\ApiCore\Page;
use Illuminate\Support\Facades\Mail;

use App\Mail\SuccessfulLoginNotification;

Route::get('/test-mail', function () {
    try {
        $loginTime = now();
        $browserInfo = request()->header('User-Agent', 'Test Browser Info');
        $userEmail = 'raghavanofficials@gmail.com';
        Mail::to($userEmail)->send(new SuccessfulLoginNotification($loginTime, $browserInfo));
        return 'Mail sent successfully';
    } catch (\Exception $e) {
        return 'Failed to send mail: ' . $e->getMessage();
    }
});


Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/membership/package', [PagesController::class, 'membership_package'])->name('membership');

Route::middleware('guest')->group(function () {
    Route::get('/app/register', [PagesController::class, 'register']);
    Route::post('/app/auth/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/app/login', [PagesController::class, 'login'])->name('login');
    Route::post('/app/auth/login', [PagesController::class, 'verify_login'])->name('verify_login');
});

Route::group(['middleware' => ['auth', 'premium']], function () {
    Route::get('/app/logout', [PagesController::class, 'logout'])->name('logout');
    Route::get('/app/profile/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/app/profile/user-profile-edit/{id}/{dummy?}', [DashboardController::class, 'user_profile_edit'])->name('user-profile-edit');
    Route::get('/app/profile/edit-personal-data/{id}/{dummy?}', [DashboardController::class, 'edit_personal_data'])->name('edit-personal-data');

    Route::match(['get', 'post', 'put'], '/app/profile/edit-personal-data/update', [ProfileController::class, 'updatePersonalData'])->name('profile.bio');

    Route::match(['get', 'put', 'post'], '/app/profile/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/upload/horoscope', [HoroscopeController::class, 'uploadHoroscope'])->name('horoscope.uploads');
    Route::get('/app/horoscope/upload', [DashboardController::class, 'horoscope_upload']);

    Route::post('/gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');
    Route::get('/app/gallery/upload', [GalleryController::class, 'show_upload']);
    Route::get('/gallery/{image}', [GalleryController::class, 'delete'])->name('gallery.delete');

    // Apart for Dashboard Routes / Common Routes

    // Route::get('/', [PagesController::class, 'index'])->name('home');
    Route::middleware('premium')
        ->get('/app/profile/f/{id}', [PagesController::class, 'info_update'])
        ->name('user-profile');

    Route::group(['prefix' => 'app/result'], function () {
        Route::post('/search-result', [SearchResultController::class, 'searchResult'])->name('searchResult');
        Route::get('/search-results', [PagesController::class, 'showSearchResults'])->name('showSearchResult');
    });

    Route::get('/app/f/{id}/membership-plan', [DashboardController::class, 'membershipPlan'])->name('membershipPlan');
});

/* Register Page Route */

Route::group(['prefix' => 'app/result'], function () {
    Route::post('/search-result', [SearchResultController::class, 'searchResult'])->name('searchResult');
    Route::get('/search-results', [PagesController::class, 'showSearchResults'])->name('showSearchResult');
    Route::Post('/search-filters', [SearchResultController::class, 'search'])->name('searchFilter');
});


//Admin Dashboard