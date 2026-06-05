<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS untuk semua URL yang di-generate Laravel (paginator, route(), dll)
        URL::forceScheme('https');
        // \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
