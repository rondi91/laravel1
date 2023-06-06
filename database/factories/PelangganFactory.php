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
            'nama_pelanggan' => $this->faker->name,
            'alamat_pelanggan' => $this->faker->address,
            'nomor_telepon' => $this->faker->phoneNumber,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'password' => bcrypt('password'),
            'updated_at' => now(),
            'created_at' => now(),
        
            //

        ];
    }
}
