<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\Langganan;
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
        
        $langganan = Langganan::latest()->get();
        return view('pesans.create', compact('langganan'));
    }

    public function searchPelanggan(Request $request)
    {
        $searchTerm = $request->input('term');
        $pelanggan = Pelanggan::join('langganans', 'pelanggans.id', '=', 'langganans.pelanggan_id')
        ->where('pelanggans.Nama_Pelanggan', 'LIKE', "%{$searchTerm}%")
        ->select('pelanggans.id', 'pelanggans.Nama_Pelanggan', 'langganans.id AS langganan_id')
        ->get();

            $results = [];
            foreach ($pelanggan as $plg) {
                $results[] = [
                    'pelanggan_id' => $plg->id,
                    'text' => $plg->Nama_Pelanggan,
                    'id' => $plg->langganan_id
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
