@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Order</h5>
                        <p class="card-text">{{ $totalOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Order</h5>
                        <p class="card-text">{{ $pendingOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk Terjual</h5>
                        <p class="card-text">{{ $totalProdukTerjual }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Today Produk Order</h5>
                        <p class="card-text">{{ $todayProdukOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan Produk Bulan Ini</h5>
                        <p class="card-text">{{ $penjualanBulanIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">{{ $totalPendapatan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Hari Ini</h5>
                        <p class="card-text">{{ $pendapatanHariIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Bulan Ini</h5>
                        <p class="card-text">{{ $pendapatanBulanIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Tahun Ini</h5>
                        <p class="card-text">{{ $pendapatanTahunIni }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pelanggan</h5>
                        <p class="card-text">{{ $totalPelanggan }}</p>
                    </div>
                </div>
            </div>
        </div>
    
{{-- {{ dd(__FILE__,__LINE__,$transactionTotals); }} --}}

        {{-- bar chart  --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi per Bulan</h5>
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data transaksi per bulan dari server
    var transactionData = {!! json_encode($transactionData) !!};

    // Ambil bulan dari data transaksi
    var months = transactionData.map(data => data.month);

    // Ambil total transaksi dari data transaksi
    var transactionTotals = transactionData.map(data => data.total);

    // Buat chart menggunakan Chart.js
    var ctx = document.getElementById('transactionChart').getContext('2d');
    var transactionChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Transaksi',
                data: transactionTotals,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection