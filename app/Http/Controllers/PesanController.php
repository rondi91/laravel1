<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\DetailPesanan;
use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        // Mengambil data pesan berdasarkan status
        $pesan = Pesan::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->with('pelanggan')
        ->latest()->get();
        
    //    $pesanan = Pesan::with('pelanggan')->get();
       return view('pesans.index',compact('pesan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return 'ok';
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
    //    return $request;
        $request->validate([
            'pelanggan_id' => 'required',
            'produk' => 'array',
            'jumlah' => 'array',


            // 'langganan_id' => 'required',
            // 'tanggal_pesan' => 'required',
            // 'produk' => 'required',
            // 'jumlah' => 'required|numeric',
        ]);
        

        $pesan = new Pesan();
        $pesan->pelanggan_id = $request->pelanggan_id;
        $pesan->tanggal = Carbon::now();
        // $pesan->produk_id = $request->produk;
        // $pesan->jumlah = $request->jumlah;
        $pesan->save();

        // Memasukkan data detail pesanan
        if ($request->has('produk')) {
            foreach ($request->input('produk') as $key => $produkId) {
                if (!empty($produkId)) {
                    $detailPesanan = new DetailPesanan();
                    $detailPesanan->pesan_id = $pesan->id;
                    $detailPesanan->produk_id = $produkId;
                    $detailPesanan->warna_id = 1;
                    $detailPesanan->size_id = 2;
                    $detailPesanan->jumlah = $request->input('jumlah')[$key];
                    $detailPesanan->unit_price = 20000;
                    
                    $detailPesanan->save();
                }
            }
        }

        return redirect()->route('pesan.index')->with('success', 'Pesanan berhasil ditambahkan');
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);

        return view('pesans.show', compact('pesan'));
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
