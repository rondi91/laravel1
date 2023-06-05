<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }

    public function size()
    {
        return $this->belongsTo(size::class);
    }
}
