<?php

namespace App\Providers;

use App\Models\GoogleAuthSetting;
use App\Models\MidtransSetting;
use App\Models\TelegramSetting;
use Illuminate\Support\Facades\Schema;
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

        if (Schema::hasTable('google_auth_settings')) {
            $setting = GoogleAuthSetting::first();

            config([
                'services.google.client_id' => $setting->client_id ?? env('GOOGLE_CLIENT_ID'),
                'services.google.client_secret' => $setting->client_secret ?? env('GOOGLE_CLIENT_SECRET'),
                'services.google.redirect' => $setting->redirect_uri ?? env('GOOGLE_REDIRECT_URI'),
            ]);
        }

        // Telegram Bot Setting
        if (Schema::hasTable('telegram_settings')) {
            $setting = TelegramSetting::first();

            config([
                'services.telegram.bot_token' => $setting->bot_token ?? env('TELEGRAM_BOT_TOKEN'),
                'services.telegram.webhook_url' => $setting->webhook_url ?? '',
                'services.telegram.bot_name' => $setting->bot_name ?? '',
            ]);
        }

        if (Schema::hasTable('midtrans_settings')) {
            $setting = MidtransSetting::first();

            config([
                'services.midtrans.server_key' => $setting->server_key ?? env('MIDTRANS_SERVER_KEY'),
                'services.midtrans.client_key' => $setting->client_key ?? env('MIDTRANS_CLIENT_KEY'),
                'services.midtrans.is_production' => $setting->is_production ?? env('MIDTRANS_IS_PRODUCTION', false),
            ]);
        }
    }
}
