<?php

namespace Database\Factories;

use App\Models\Langganan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;
    /**
     * Define the model's default state.
    
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nama_pelanggan' => $this->faker->name,
            'alamat' => $this->faker->address,
            'nomor_telepon' => $this->faker->phoneNumber,
            'langganan_id' => function () {
                return Langganan::factory()->create()->langganan_id;
            },
        
            //
        ];
    }
}
