<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

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

    public function boot()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
