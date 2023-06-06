<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Models\Pembayaran;
>>>>>>> 3dbebb6
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        //
=======
        Pembayaran::factory()->count(10)->create();
>>>>>>> 3dbebb6
    }
}
