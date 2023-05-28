<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pelanggan;
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
        $this->call([
            
            PaketSeeder::class
             ]);
        // $this->call([
            
        //     PelangganSeeder::class
        //      ]);
        $this->call([
            
            LanggananSeeder::class
             ]);
        $this->call([
            
            PembayaranSeeder::class
             ]);





        //  Pelanggan::factory()->count(10)->create();




        
        // Pelanggan::create([
        //     'nama_pelanggan' =>'solekah',
        //     'alamat'=>'rt kidul'
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
