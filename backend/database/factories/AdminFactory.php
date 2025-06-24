<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AdminFactory extends Factory
{
    protected $model = \App\Models\Admin::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role' => 'admin'])->id,
            'nama_lengkap' => $this->faker->name(),
            'jabatan' => $this->faker->jobTitle(),
        ];
    }
}
