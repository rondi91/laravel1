<?php

namespace Database\Factories;

use App\Models\Langganan;
use App\Models\Pelanggan;
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
            'Nama_Pelanggan' => $this->faker->name,
            'Alamat_Pelanggan' => $this->faker->address,
            'Nomor_Telepon' => $this->faker->phoneNumber,
            'updated_at' => now(),
            'created_at' => now(),
        
            //
        ];
    }
}
