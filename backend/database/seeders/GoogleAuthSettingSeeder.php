<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoogleAuthSetting;

class GoogleAuthSettingSeeder extends Seeder
{
    public function run(): void
    {
        GoogleAuthSetting::updateOrCreate(['id' => 1], [
            'client_id' => '765986041608-1975arkf89frfobth1h4mdfljtvsjhii.apps.googleusercontent.com',
            'client_secret' => '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',
            'redirect_uri' => 'https://688f-103-70-122-202.ngrok-free.app/auth/callback/google',
        ]);
    }
}
