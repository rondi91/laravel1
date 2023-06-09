<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }


    public function pelanggan()
    {
        // 1 transaction punya 1 pelanggan 
        return $this->belongsTo(Pelanggan::class);
    }
}
