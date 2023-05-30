<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { $search = $request->input('search');

        if ($search) {
            $pakets = Paket::where('Nama_Paket', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Paket', 'like', '%' . $search . '%')
                ->orWhere('Nomor_Telepon', 'like', '%' . $search . '%')
                ->get();
        } else {
            $pakets = Paket::latest()->paginate(5)->withQueryString();
        }
    
        return view('Pakets.index', compact('pakets'));
        
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
    public function store(StorePaketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaketRequest $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        //
    }
}
