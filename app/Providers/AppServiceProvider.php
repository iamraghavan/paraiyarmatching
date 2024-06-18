<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('loader', \App\View\Components\Loader::class);
        Blade::component('header-top', \App\View\Components\HeaderTop::class);
        Blade::component('related-profile-card', \App\View\Components\RelatedProfileCard::class);
    }
}