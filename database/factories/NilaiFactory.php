<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nilai>
 */
class NilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'kelas' => fake()->numberBetween(1,3),
            'mapel' => fake()->streetName(),
            'nilai' => fake()->numberBetween(1,100),
            'siswa_id' => Siswa::factory()
        ];
    }
}
