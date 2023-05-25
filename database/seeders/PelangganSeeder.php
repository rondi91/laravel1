<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'nama_pelanggan' => 'John Doe',
                'alamat' => 'Jalan ABC No. 123',
                'nomor_telepon' => '08123456789',
                'langganan_id' => 1,
            ],
            [
                'nama_pelanggan' => 'Jane Smith',
                'alamat' => 'Jalan XYZ No. 456',
                'nomor_telepon' => '08234567890',
                'langganan_id' => 2,
            ],
        ]);
    
    }
}
