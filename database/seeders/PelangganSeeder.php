<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
=======
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
>>>>>>> 3dbebb6

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        //
=======
        Pelanggan::factory()->count(5)->create();
    
>>>>>>> 3dbebb6
    }
}
