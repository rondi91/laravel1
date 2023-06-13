<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\PenambahanStok;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenambahanStokController extends Controller
{
    public function index (){


        $tambahstok = PenambahanStok::with('produk')->orderBy('produk_id')->get();
        return view('tambahstoks.index',compact('tambahstok'));
    }


    public function tambahstock(Request $request)
    {
        
        // Validasi input
        $request->validate([
            'produk_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            
        ]);
    
        // Simpan penambahan stok ke database
        $penambahanStok = PenambahanStok::create([
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tanggal_penambahan' => now(),
        ]);
    
        // Update stok produk terkait
        $produk = Harga::find($request->produk_id);
        $produk->stock += $request->jumlah;
        $produk->save();
    
        // ...
    
        return redirect()->route('produk.index')->with('success', 'Penambahan stok berhasil ditambahkan.');
    }
}
