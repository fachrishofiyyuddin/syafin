<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class NasabahFactory extends Factory
{
    protected $model = \App\Models\Nasabah::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role' => 'nasabah'])->id,
            'nama_lengkap' => $this->faker->name(),
            'nomor_telegram' => $this->faker->numerify('##########'),
        ];
    }
}
