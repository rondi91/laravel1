<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\DetailTransactionsan;
use App\Models\Pelanggan;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Dashboardcontroller extends Controller
{
    
    public function index()
    {
        $totalOrder = Pesan::count();
        $pendingOrder = Pesan::where('status', 'pending')->count();
        $totalProdukTerjual = DetailPesanan::sum('jumlah');
        $todayProdukOrder = DetailPesanan::whereDate('created_at', Carbon::today())->sum('jumlah');
        $penjualanBulanIni = DetailPesanan::whereMonth('created_at', Carbon::now()->month)->sum('jumlah');
        $totalPendapatan = Transactions::sum('total_price');
        $pendapatanHariIni = Transactions::whereDate('created_at', Carbon::today())->sum('total_price');
        $pendapatanBulanIni = Transactions::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        $pendapatanTahunIni = Transactions::whereYear('created_at', Carbon::now()->year)->sum('total_price');
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();

        $transactionData = Transactions::selectRaw('YEAR(transaction_date) as year, MONTH(transaction_date) as month, SUM(total_price) as total')
        ->groupBy('year', 'month')
        ->get();
        // return $transactionData;
    // Menginisialisasi array untuk menyimpan data tahun
    $years = [];

    // Iterasi data transaksi per bulan untuk mendapatkan tahun
    foreach ($transactionData as $data) {
        $year = $data->year;
        if (!in_array($year, $years)) {
            $years[] = $year;
        }
    }

    // area chart daily transaction 

   

        return view('dashboard.index', compact(
            'totalOrder',
            'pendingOrder',
            'totalProdukTerjual',
            'todayProdukOrder',
            'penjualanBulanIni',
            'totalPendapatan',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanTahunIni',
            'totalProduk',
            'totalPelanggan',
            'years',
            'transactionData'
        ));
    }

    public function getDailyTransactions(Request $request)
    {
        $transactions = Transactions::selectRaw('DATE(transaction_date) AS date, COUNT(*) AS total')
            ->whereDate('transaction_date', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($transactions);
    }
}
