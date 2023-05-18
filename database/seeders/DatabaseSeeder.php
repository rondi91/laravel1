<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(10)->create(); 

        // Post::factory(10)->create();
        // memanggil postseeder
        $this->call([
            PostSeeder::class
             ]);
        $this->call([
            
            CategorySeeder::class
             ]);






        
        // Category::create([
        //     'name' =>'Web Progaming',
        //     'slug'=>'web-progaming'
        // ]);
        
        // Category::create([
        //     'name' =>'Personal',
        //     'slug'=>'personal'
        // ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
