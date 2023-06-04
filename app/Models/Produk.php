<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

     // Relasi dengan model Harga
     public function harga()
     {
         return $this->hasOne(Harga::class);
     }
 
     // Relasi dengan model Warna melalui model Harga
     public function warna()
     {
         return $this->hasOneThrough(Warna::class, Harga::class);
     }
 
     // Relasi dengan model Ukuran melalui model Harga
     public function size()
     {
         return $this->hasOneThrough(Size::class, Harga::class);
     }
}
