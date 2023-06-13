<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DetailPesanan;
use App\Models\Harga;
use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\Size;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Warna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(5)->create(); 
        // Pelanggan::factory(10)->create(); 
        Produk::factory(5)->create(); 
        Warna::factory(3)->create(); 
        Size::factory(4)->create(); 
        Pesan::factory(15)->create(); 
        DetailPesanan::factory(5)->create(); 
        Harga::factory(5)->create(); 
        Transactions::factory(5)->create(); 
        
        // Post::factory(10)->create();
        // memanggil postseeder
        $this->call([
            PostSeeder::class
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
