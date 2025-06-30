<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TelegramSetting;

class TelegramSettingSeeder extends Seeder
{
    public function run(): void
    {
        TelegramSetting::updateOrCreate(['id' => 1], [
            'bot_token' => env('TELEGRAM_BOT_TOKEN', 'DEFAULT-TOKEN'),
            'bot_name' => env('TELEGRAM_BOT_NAME'), // Bisa diganti jika perlu
            'webhook_url' => env('TELEGRAM_WEBHOOK_URL', 'https://your-ngrok-url/api/webhook/telegram'),
        ]);
    }
}
