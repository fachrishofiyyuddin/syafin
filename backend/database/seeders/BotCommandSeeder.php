<?php

namespace Database\Seeders;

use App\Models\BotCommand;
use Illuminate\Database\Seeder;

class BotCommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $commands = [
            [
                'command' => '/start',
                'label' => 'Memulai bot',
                'response' => "Hai! 👋 Selamat datang di *Syva Bot*.\n\nAku siap bantu kamu yang butuh solusi keuangan cepat, aman, dan praktis! 🧾💡\n\nKetik /menu untuk lihat apa aja yang bisa Syva bantu. Yuk, ngobrol!",
            ],
            [
                'command' => '/menu',
                'label' => 'Lihat daftar perintah',
                'response' => "Berikut daftar bantuan yang bisa kamu akses:\n\n/pengertian – Apa sih keuangan online?\n/jenis – Macam-macam kebutuhan yang bisa diajukan\n/cara – Langkah mudah untuk ajukan\n/durasi – Secepat apa cairnya?\n/risiko – Hal yang perlu kamu tahu",
            ],
            [
                'command' => '/pengertian',
                'label' => 'Apa itu kebutuhan keuangan online?',
                'response' => "Kebutuhan keuangan online itu proses pengajuan dana yang dilakukan lewat HP/website tanpa ribet datang ke kantor. Praktis, aman, dan bisa diakses kapan saja ✨",
            ],
            [
                'command' => '/jenis',
                'label' => 'Apa saja jenis pengajuan kebutuhan keuangan online?',
                'response' => "Jenis pengajuan yang bisa kamu ajukan:\n\n• *Kebutuhan Konsumtif* – liburan, pernikahan, gadget, dll.\n• *Kebutuhan Produktif* – usaha, modal kerja, investasi.\n• *Kebutuhan Darurat* – biaya rumah sakit, musibah, kehilangan penghasilan.\n\nTinggal pilih yang paling sesuai dengan kondisi kamu!",
            ],
            [
                'command' => '/cara',
                'label' => 'Bagaimana cara mengajukan kebutuhan keuangan online?',
                'response' => "Cukup isi formulir online kami 📋, lalu tunggu proses verifikasi. Semua bisa dilakukan dari rumah, tanpa perlu antre atau datang ke kantor!",
            ],
            [
                'command' => '/durasi',
                'label' => 'Berapa lama proses pencairan dana?',
                'response' => "Kalau semua dokumen lengkap dan pengajuan disetujui, dana bisa cair dalam 1–3 hari kerja. Cepat dan langsung ke rekening kamu! 💸",
            ],
            [
                'command' => '/risiko',
                'label' => 'Apakah ada risiko kebutuhan keuangan online?',
                'response' => "Setiap layanan keuangan pasti punya risiko. Tapi tenang, selama kamu menggunakan platform resmi dan membaca syarat ketentuannya, kamu aman kok. Kami pastikan semua proses transparan dan mudah dipahami.",
            ],
        ];

        foreach ($commands as $cmd) {
            \App\Models\BotCommand::updateOrCreate(
                ['command' => $cmd['command']],
                [
                    'label' => $cmd['label'],
                    'response' => $cmd['response'],
                    'is_active' => true
                ]
            );
        }
    }
}
