<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Nasabah;

class PengajuanFactory extends Factory
{
    protected $model = \App\Models\Pengajuan::class;

    public function definition()
    {
        $jenis = ['Kebutuhan Konsumtif', 'Kebutuhan Produktif', 'Kebutuhan Darurat'];
        $status = ['pending' => 'menunggu', 'approved' => 'disetujui', 'rejected' => 'ditolak'];

        return [
            'nasabah_id' => Nasabah::factory(),
            'jenis_pengajuan' => $this->faker->randomElement($jenis),
            'jumlah_dana' => $this->faker->numberBetween(1000000, 10000000),
            'status' => $this->faker->randomElement(array_values($status)),
            'keterangan' => $this->faker->sentence(),
            'bukti_ktp' => 'ktp_' . $this->faker->unique()->numberBetween(1, 100) . '.jpg',
        ];
    }
}
