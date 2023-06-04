<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\Size;
use App\Models\Warna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPesanan>
 */
class DetailPesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pesan_id' => Pesan::factory()->create()->id,
            // 'pelanggan_id' => Pelanggan::factory()->create()->id,
            'produk_id' => Produk::factory()->create()->id,
            'warna_id' => Warna::factory()->create()->id,
            'size_id' => Size::factory()->create()->id,
            'jumlah' => $this->faker->numberBetween(1, 5),
        ];
    }
}
