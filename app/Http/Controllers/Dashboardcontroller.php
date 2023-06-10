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

        // Mendapatkan data transaksi per bulan dari database
        $transactionData = Transactions::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
        ->groupBy('month')
        ->get();

        // Menginisialisasi array untuk menyimpan data bulan dan total transaksi
        $months = [];
        $transactionTotals = [];

        // Iterasi data transaksi per bulan
        foreach ($transactionData as $data) {
        $month = Carbon::createFromFormat('m', $data->month)->format('F');
        $months[] = $month;
        $transactionTotals[] = $data->total;
        }

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
            'transactionTotals',
            'transactionData'
        ));
    }
}
