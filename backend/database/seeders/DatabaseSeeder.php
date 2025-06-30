<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // buat 3 admin
        \App\Models\Admin::factory(3)->create();

        // buat 5 nasabah
        \App\Models\Nasabah::factory(5)->create();

        // buat 10 pengajuan (otomatis relasi nasabah dibuat)
        \App\Models\Pengajuan::factory(10)->create();

        $this->call(BotCommandSeeder::class);

        $this->call([
            GoogleAuthSettingSeeder::class,
        ]);

        $this->call([
            MidtransSettingSeeder::class,
        ]);


        $this->call([
            TelegramSettingSeeder::class,
        ]);
    }
}
