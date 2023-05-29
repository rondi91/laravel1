<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;


	public function langganan()
    {
        return $this->belongsTo(Langganan::class);
    }


}
