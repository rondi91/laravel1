@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Order</h5>
                        <p class="card-text">{{ $totalOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Pending Order</h5>
                        <p class="card-text">{{ $pendingOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk Terjual</h5>
                        <p class="card-text">{{ $totalProdukTerjual }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Today Produk Order</h5>
                        <p class="card-text">{{ $todayProdukOrder }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan Produk Bulan Ini</h5>
                        <p class="card-text">{{ $penjualanBulanIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">{{ $totalPendapatan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Hari Ini</h5>
                        <p class="card-text">{{ $pendapatanHariIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Bulan Ini</h5>
                        <p class="card-text">{{ $pendapatanBulanIni }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Tahun Ini</h5>
                        <p class="card-text">{{ $pendapatanTahunIni }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
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
                        <div class="form-group">
                            <label for="yearSelect">Pilih Tahun:</label>
                            <select id="yearSelect" class="form-control">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- area chart  --}}

        <canvas id="dailyTransactionsChart"></canvas>
    

    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // Ambil data transaksi dari server
        var transactionData = {!! json_encode($transactionData) !!};

        // Ambil tahun unik dari data transaksi
        var years = [...new Set(transactionData.map(data => data.year))];

        // Buat chart menggunakan Chart.js
        var ctx = document.getElementById('transactionChart').getContext('2d');
        var transactionChart;

        function createChart(year) {
            var filteredData = transactionData.filter(data => data.year == year);
            // var months = filteredData.map(data => data.month);
            var months = filteredData.map(data => moment().month(data.month - 1).format('MMMM'));
            var totals = filteredData.map(data => data.total);
            if (transactionChart) {
                transactionChart.destroy(); // Menghapus chart yang ada
            }
            //console.log(transactionData);
            transactionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Total Transaksi',
                        data: totals,
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
}

        // Inisialisasi chart dengan tahun pertama
        createChart(years[0]);

        // Event listener saat pemilihan tahun berubah
        document.getElementById('yearSelect').addEventListener('change', function() {
            var selectedYear = this.value;
            createChart(selectedYear);
        });
        
    </script>

    {{-- script area chart  --}}

<script>
    // Mengambil data transaksi harian dari server
    fetch("{{ route('dashboard.transactions.daily') }}")
        .then(response => response.json())
        .then(data => {
            // Mengubah format data menjadi array tanggal dan total transaksi
            const dates = data.map(item => item.date);
            const totals = data.map(item => item.total);
            console.log(totals  );

            // Membuat chart
            const ctx = document.getElementById('dailyTransactionsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Transaksi Harian',
                        data: totals,
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
        });
</script>
@endsection