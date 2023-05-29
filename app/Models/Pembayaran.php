<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;



    public function pelanggan ()
	{           // 1 post punya 1 category
		return $this->belongsTo(Pelanggan::class);
	}


}
