<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $pembayaran = Pembayaran::where('langganan_id', 'like', '%' . $search . '%')
                ->paginate(5)->withQueryString();
        } else {
            $pembayaran = Pembayaran::latest()->paginate(5)->withQueryString();
        }
    
        return view('pembayaran.index', compact('pembayaran'));
        // $pelanggan = Pelanggan::latest()->get();
        // return view('pelanggan.index',['pembayaran'=>$pelanggan]);
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $pembayaran = Pembayaran::whereHas('langganan.pelanggan', function ($query) use ($search) {
            $query->where('Nama_Pelanggan', 'LIKE', "%{$search}%");
        })->paginate(10);

        return view('pembayaran.partial_table', compact('pembayaran'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembayaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
