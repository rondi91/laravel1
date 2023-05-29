<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $pelanggans = Pelanggan::where('Nama_Pelanggan', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Pelanggan', 'like', '%' . $search . '%')
                ->orWhere('Nomor_Telepon', 'like', '%' . $search . '%')
                ->get();
        } else {
            $pelanggans = Pelanggan::all();
        }
    
        return view('pelanggan.index', compact('pelanggans'));
        // $pelanggan = Pelanggan::latest()->get();
        // return view('pelanggan.index',['pelanggans'=>$pelanggan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        // $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan = $pelanggan;
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        // dd(__FILE__,__LINE__,$request);
        // $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan = $pelanggan;
        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        // $pelanggan = Pelanggan::findOrFail($id); 
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan deleted successfully');
    }
}
