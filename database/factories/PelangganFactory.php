<?php

namespace Database\Factories;

<<<<<<< HEAD
=======
use App\Models\Langganan;
use App\Models\Pelanggan;
>>>>>>> 3dbebb6
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
<<<<<<< HEAD
    /**
     * Define the model's default state.
     *
=======
    protected $model = Pelanggan::class;
    
    /**
     * Define the model's default state.
    
>>>>>>> 3dbebb6
     * @return array<string, mixed>
     */
    public function definition(): array
    {
<<<<<<< HEAD
        return [
            'nama_pelanggan' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
             'password' => bcrypt('password'),
=======

        return [
            'Nama_Pelanggan' => $this->faker->name,
            'Alamat_Pelanggan' => $this->faker->address,
            'Nomor_Telepon' => $this->faker->phoneNumber,
            'updated_at' => now(),
            'created_at' => now(),
        
            //
>>>>>>> 3dbebb6
        ];
    }
}
