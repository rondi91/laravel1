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
    public function show(Transactions $transactions)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
