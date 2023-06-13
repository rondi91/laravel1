<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;
use App\Models\Pesan;
use App\Models\Transactions;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transactions = Transactions::latest()->get();
        return view('transaction.index',compact('transactions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pesans = Pesan::find($id);
        return view('transaction.create',compact('pesans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionsRequest $request)
    {
        // return $request;
        
        // Validasi data input pembayaran
        $validatedData = $request->validate([
            'pesan_id' => 'required|exists:pesans,id',
            'pelanggan_id' => 'required',
            'tanggal_transaction' =>'tanggal',
            'total_price' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);
        
      


        // Simpan data pembayaran ke database
        $pembayaran = new Transactions;
        $pembayaran->pesan_id = $validatedData['pesan_id'];
        $pembayaran->pelanggan_id = $validatedData['pelanggan_id'];
        $pembayaran->payment_status = 'menunggu pembayaran';
        $pembayaran->total_price = $validatedData['total_price'];
        $pembayaran->transaction_date = now();
        $pembayaran->payment_method = $validatedData['metode_pembayaran'];
        $pembayaran->save();

        // Redirect ke halaman detail pesanan setelah pembayaran berhasil disimpan
        return redirect()->route('transactions.index')
            ->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transactions,$id)
    {
        $transaksi = Transactions::with('pelanggan')->findOrFail($id);
        $namaPelanggan = $transaksi->pelanggan->nama_pelanggan;
        $transaksi['nama_pelanggan'] = [ $namaPelanggan
        // 'id' => $transaksi->id,
        // 'nama_pelanggan' => $namaPelanggan,
        // // tambahkan properti lain yang ingin Anda sertakan dalam respons JSON
        ];
    // di masukan di dalam array => return response()->json(['transaksi' => $transaksiData]);
    return response()->json($transaksi);

        // return response()->json($transaksi); //langusng menggunakan (respon) console.log(response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionsRequest $request, Transactions $transactions)
    {
        // return $request;
        // Validasi input
        $request->validate([
            'transaction_id' => 'required',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
        ]);
        $id =$request->transaction_id;
        
        // Cari transaksi berdasarkan ID
        $transaksi = Transactions::find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        // Update data transaksi
        $transaksi->id = $request->transaction_id;
        $transaksi->transaction_date = $request->tanggal_transaksi;
        $transaksi->total_price = $request->total_harga;
        $transaksi->payment_method = $request->metode_pembayaran;
        $transaksi->payment_status = $request->status_pembayaran;
        $transaksi->save();

        return redirect()->back()->with('success', 'Transaksi berhasil diperbarui');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
