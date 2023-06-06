<?php

namespace Database\Factories;

<<<<<<< HEAD
=======
use App\Models\Langganan;
>>>>>>> 3dbebb6
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
<<<<<<< HEAD
            //
=======
            'langganan_id' => function () {
                return \App\Models\Langganan::factory()->create()->id;
            },
            'Tanggal_Pembayaran' => $this->faker->date,
            'Jumlah_Pembayaran' => $this->faker->randomFloat(2, 100, 1000),
        
>>>>>>> 3dbebb6
        ];
    }
}
