<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\Size;
use App\Models\Warna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Harga>
 */
class HargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produk_id' => Produk::factory()->create()->id,
            'warna_id' => Warna::factory()->create()->id,
            'size_id' => Size::factory()->create()->id,
            'stock' => $this->faker->numberBetween(10,20),
            'harga' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
