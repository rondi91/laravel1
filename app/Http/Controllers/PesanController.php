<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        return view('pesans.create', compact('pelanggan', 'produk'));
    }

    public function searchPelanggan(Request $request)
    {
        $searchTerm = $request->input('term');
        $pelanggan = Pelanggan::where('Nama_Pelanggan', 'LIKE', "%{$searchTerm}%")
        
        ->get();
        $pelanggan = Pelanggan::where('Nama_Pelanggan', 'LIKE', '%' . $searchTerm . '%')
        ->select('id', 'Nama_Pelanggan')
        ->get();

        $results = [];
        foreach ($pelanggan as $plg) {
            $results[] = [
                'id' => $plg->id,
                'text' => $plg->Nama_Pelanggan,
                'ids' => $plg->langganan_id
            ];
        }

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePesanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePesanRequest $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $pesan)
    {
        //
    }
}
