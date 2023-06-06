<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

<<<<<<< HEAD
use App\Models\DetailPesanan;
use App\Models\Harga;
use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\Size;
use App\Models\Transactions;
=======
use App\Models\Langganan;
use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
>>>>>>> 3dbebb6
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

<<<<<<< HEAD
        User::factory(10)->create(); 
        // Pelanggan::factory(10)->create(); 
        Produk::factory(10)->create(); 
        Warna::factory(3)->create(); 
        Size::factory(4)->create(); 
        Pesan::factory(3)->create(); 
        DetailPesanan::factory(3)->create(); 
        Harga::factory(10)->create(); 
        Transactions::factory(10)->create(); 
        
        // Post::factory(10)->create();
        // memanggil postseeder
        $this->call([
            PostSeeder::class
             ]);
=======
        Pelanggan::factory(20)->create();
        Paket::factory(5)->create();
        // Langganan::factory(5)->create();
        // Pembayaran::factory(5)->create();

        Langganan::factory(20)->create()->each(function ($langganan) {
            $langganan->pembayaran()->saveMany(
                Pembayaran::factory(rand(1, 3))->create(['langganan_id' => $langganan->id])
            );
        });
>>>>>>> 3dbebb6





        // User::factory(10)->create(); 

        // // Post::factory(10)->create();
        // // memanggil postseeder
        // $this->call([
        //     PostSeeder::class
        //      ]);
        // $this->call([
            
        //     CategorySeeder::class
        //      ]);
        // $this->call([
            
        //     PaketSeeder::class
        //      ]);
        // // $this->call([
            
        // //     PelangganSeeder::class
        // //      ]);
        // $this->call([
            
        //     LanggananSeeder::class
        //      ]);
        // $this->call([
            
        //     PembayaranSeeder::class
        //      ]);





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
