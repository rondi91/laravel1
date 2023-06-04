<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
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
