<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionsFactory extends Factory
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
            'pelanggan_id' => Pelanggan::factory()->create()->id,
            'produk_id' => Produk::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'total_price' => $this->faker->randomFloat(2, 50, 500),
            'payment_method' => $this->faker->randomElement(['Kartu Kredit', 'Transfer Bank', 'Dompet Digital']),
            'payment_status' => $this->faker->randomElement(['Lunas', 'Menunggu Pembayaran']),
            'transaction_date' => $this->faker->date()
        ];
    }
}
