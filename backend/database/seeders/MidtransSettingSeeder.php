<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MidtransSetting;

class MidtransSettingSeeder extends Seeder
{
    public function run(): void
    {
        MidtransSetting::updateOrCreate(['id' => 1], [
            'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-QRtgjZ_A3NeNsAOculx9vuLk'),
            'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-7F_2M5Vd-WE49rOE'),
            'is_production' => filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
