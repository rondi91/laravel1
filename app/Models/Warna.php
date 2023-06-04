<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;

    public function harga()
    {
        return $this->hasMany(Harga::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
