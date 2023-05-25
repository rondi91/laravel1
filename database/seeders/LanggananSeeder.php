<?php

namespace Database\Seeders;

use App\Models\Langganan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanggananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langganan::factory()->count(10)->create();
    }
}
