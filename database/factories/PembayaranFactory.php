<?php

namespace Database\Factories;

use App\Models\Langganan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'langganan_id' => function () {
                return \App\Models\Langganan::factory()->create()->id;
            },
            'Tanggal_Pembayaran' => $this->faker->date,
            'Jumlah_Pembayaran' => $this->faker->randomFloat(2, 100, 1000),
        
        ];
    }
}
