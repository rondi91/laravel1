<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Harga;
use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\Size;
use App\Models\Warna;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $produks = Produk::with('harga.warna', 'harga.size')->latest()->paginate(5);
        
        $search = $request->input('search');

        if ($search) {
            $produks = Harga::whereHas('produk', function ($query) use ($search) {
                $query->where('nama_produk', 'LIKE', "%{$search}%");
            })->paginate(10);
        } else {
            $produks = Harga::with('produk', 'warna','size')->paginate(5);
        }
    
              
        
        return view('produks.index', compact('produks'));
    }
    public function search(Request $request)
    {
        
        $search = $request->input('search');
        $produks = Harga::whereHas('produk', function ($query) use ($search) {
            $query->where('nama_produk', 'LIKE', "%{$search}%");
        })->paginate(10);


        return view('produks.partial_table', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Size::all();
        $warna = Warna::all();

        return view('produks.create', compact('sizes', 'warna'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'variasi.*.size' => 'required',
            'variasi.*.warna' => 'required',
            'variasi.*.harga' => 'required|numeric',
        ]);
    
        $produk = new Produk;
        $produk->nama_produk = $request->input('nama');
        // Simpan atribut-atribut lainnya sesuai kebutuhan
    
        $produk->save();
    
        foreach ($request->input('variasi') as $variasi) {
            $sizeId = $variasi['size'];
            $colorId = $variasi['warna'];
            $stock = $variasi['stock'];
            $harga = $variasi['harga'];
    
            // Simpan variasi produk ke dalam database
            $produkVariasi = new Harga;
            $produkVariasi->produk_id = $produk->id;
            $produkVariasi->size_id = $sizeId;
            $produkVariasi->warna_id = $colorId;
            $produkVariasi->stock = $stock;
            $produkVariasi->harga = $harga;
            // Simpan atribut variasi lainnya sesuai kebutuhan
            $produkVariasi->save();
        }
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
