<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userCount = 10; // Jumlah pengguna yang sudah ada dalam sistem

        // Generate 20 posting menggunakan factory
        Post::factory()->count(50)->create();

        
    }
}
