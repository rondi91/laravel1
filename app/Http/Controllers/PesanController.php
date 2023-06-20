<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\DetailPesanan;
use App\Models\Harga;
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
        $produk = harga::with('produk','warna','size')->get();

        return view('pesans.create', compact('pelanggan', 'produk'));
    }

    public function searchPelanggan(Request $request)
    {
        // return $request;
        $searchTerm = $request->input('term');
       
        $pelanggan = Pelanggan::where('nama_pelanggan', 'LIKE', '%' . $searchTerm . '%')
        ->select('id', 'nama_pelanggan')
        ->get();

        $results = [];
        foreach ($pelanggan as $plg) {
            $results[] = [
                'id' => $plg->id,
                'text' => $plg->nama_pelanggan,
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
    //    return $request->input('produk');
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
                    $selectedOption = explode("_", $produkId);
                    $produkId = $selectedOption[1];
                    $hargaID = $selectedOption[0];
                    $detailPesanan->produk_id = $produkId;
                    $detailPesanan->warna_id = 1;
                    $detailPesanan->size_id = 2;
                    $detailPesanan->jumlah = $request->input('jumlah')[$key];
                    $detailPesanan->unit_price = 20000;
                    
                    $detailPesanan->save();

                    // dd(__FILE__,__LINE__,$hargaID);

                    $produk = Harga::find($hargaID);
                    $produk->stock -= $request->input('jumlah')[$key];;
                    $produk->save();
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
        $nama_pelanggan = $pesan->pelanggan->nama_pelanggan;
        $pesan['nama_pelanggan']= $nama_pelanggan;
         return response()->json($pesan);


        
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
        // return $request;
        $request->validate([
            'pesan_id' => 'required',
            'tanggal_pesan' => 'required|date',
            'status_pesan' => 'required',
        ]);
        $id =$request->pesan_id;
        
        // Cari transaksi berdasarkan ID
        $pesan = Pesan::find($id);
        if (!$pesan) {
            return redirect()->back()->with('error', 'pesan tidak ditemukan');
        }
        

        // Update data pesan
        $pesan->id = $request->pesan_id;
        $pesan->tanggal = $request->tanggal_pesan;
        $pesan->status = $request->status_pesan;
        $pesan->save();

        return redirect()->back()->with('success', 'Pesan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $pesan)
    {
        //
    }

    public function detail(Pesan $pesan)
    {   
        // return $pesan;
        $pesan =$pesan;
        return view('pesans.detailpesan',compact('pesan'));
    }
}
