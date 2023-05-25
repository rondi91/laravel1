<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_paket' => $this->faker->word,
            'kecepatan_internet' => $this->faker->randomElement(['10 Mbps', '25 Mbps', '50 Mbps']),
            'harga_paket' => $this->faker->randomFloat(2, 50, 200),
            'kuota_maksimum' => $this->faker->randomElement(['Unlimited', '100 GB', '200 GB']),
        ];
    }
}
