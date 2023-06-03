<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Langganan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $langganan = Langganan::latest()->get();
        return view('pembayaran.form', compact('langganan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembayaranRequest $request)
    {
        Pembayaran::create($request->all());
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran created successfully');
   
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.detail', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $langganan = Langganan::all();
        return view('pembayaran.form', compact('pembayaran', 'langganan'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    public function update($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(request()->all());
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran deleted successfully');
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

    public function AdminDashboard()
    {
        // Total Pembayaran Hari Ini
        $totalPembayaranHariIni = Pembayaran::whereDate('Tanggal_Pembayaran', Carbon::today())->sum('Jumlah_Pembayaran');

        // Total Pembayaran Bulan Ini
        $totalPembayaranBulanIni = Pembayaran::whereMonth('Tanggal_Pembayaran', Carbon::now()->month)->sum('Jumlah_Pembayaran');

        // Total Pembayaran Tahun Ini
        $totalPembayaranTahunIni = Pembayaran::whereYear('Tanggal_Pembayaran', Carbon::now()->year)->sum('Jumlah_Pembayaran');

        // Pembayaran Terakhir
        $pembayaranTerakhir = Pembayaran::orderBy('Tanggal_Pembayaran', 'desc')->take(10)->get();
        // Data untuk grafik
        $chartData = DB::table('pembayarans')
        ->select(DB::raw('MONTH(Tanggal_Pembayaran) AS month'), DB::raw('SUM(Jumlah_Pembayaran) AS total'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total')
        ->toArray();

        $chartLabels = DB::table('pembayarans')
            ->select(DB::raw('MONTH(Tanggal_Pembayaran) AS month'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        // Data Pembayaran Bulan Ini
        $dataPembayaranBulanIni = Pembayaran::whereMonth('Tanggal_Pembayaran', Carbon::now()->month)
        ->select('Tanggal_Pembayaran', DB::raw('SUM(Jumlah_Pembayaran) as total'))
        ->groupBy('Tanggal_Pembayaran')
        ->get();

        $labels = $dataPembayaranBulanIni->pluck('Tanggal_Pembayaran')->toArray();
        $data = $dataPembayaranBulanIni->pluck('total')->toArray();

        $dataPembayaranBulanIni = [
        'labels' => $labels,
        'data' => $data,
        ];

        return view('admin.dashboard', compact('totalPembayaranHariIni', 'totalPembayaranBulanIni', 'totalPembayaranTahunIni',         
        'pembayaranTerakhir','dataPembayaranBulanIni'));


    
    }
    public function getDataPembayaran(Request $request)
{
    $tahun = $request->input('tahun');

    // Query untuk mengambil data pembayaran berdasarkan tahun
    $dataPembayaran = Pembayaran::select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('SUM(Jumlah_Pembayaran) as total'))
        ->whereYear('tanggal', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // Proses data pembayaran untuk disiapkan ke JavaScript
    $labels = [];
    $data = [];

    foreach ($dataPembayaran as $item) {
        $labels[] = $item->bulan;
        $data[] = $item->total;
    }

    $response = [
        'labels' => $labels,
        'data' => $data,
    ];

    return response()->json($response);
}


}
