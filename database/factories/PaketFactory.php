<?php

namespace Database\Factories;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    protected $model = Paket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nama_Paket' => $this->faker->word,
            'Kecepatan_Internet' => $this->faker->randomElement(['50 Mbps', '100 Mbps', '200 Mbps']),
            'Kuota' => $this->faker->randomElement(['100GB', '200GB', '500GB']),
            'Durasi' => $this->faker->numberBetween(30, 90),
        ];
    }
}
