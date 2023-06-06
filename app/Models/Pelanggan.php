<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);

    }

    public function langganan()
    {
        return $this->hasMany(Langganan::class);

    }
}
