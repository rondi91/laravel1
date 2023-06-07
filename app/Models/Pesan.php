<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
