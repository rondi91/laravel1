<?php

namespace Database\Factories;

use App\Models\Paket;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Langganan>
 */
class LanggananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Langganan::class;
    public function definition(): array
    {

        return [


            'pelanggan_id' => function () {
                return Pelanggan::factory()->create()->id;
            },
            'paket_id' => function () {
                return paket::factory()->create()->id;
            },
        ];



        //     'pelanggan_id' => function () {
        //         // return factory(\App\Models\Pelanggan::class)->create()->pelanggan_id;
        //         return Pelanggan::factory()->create()->pelanggan_id;
        //     },
        //     'paket_id' => function () {
        //         return Paket::factory()->create()->paket_id;
        //     },
        //     'tanggal_mulai' => $this->faker->date(),
        //     'tanggal_berakhir' => $this->faker->date(),
        
        // ];
    }
}
