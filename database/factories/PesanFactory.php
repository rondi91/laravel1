<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesan>
 */
class PesanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pelanggan_id' => Pelanggan::factory()->create()->id,
            'tanggal' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Belum Diproses', 'Dalam Pengiriman', 'Selesai']),
   
        ];
    }
}
