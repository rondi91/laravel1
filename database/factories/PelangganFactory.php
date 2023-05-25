<?php

namespace Database\Factories;

use App\Models\Langganan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    
    /**
     * Define the model's default state.
    
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nama_pelanggan' => $this->faker->name,
            'alamat' => $this->faker->address,
            
        
            //
        ];
    }
}
