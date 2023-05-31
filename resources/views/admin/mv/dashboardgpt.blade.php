@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>SkyDash qqqqq Admin</h1>
        
        <div class="row">
            <div class="col-md-6">
                <h3>Total Pembayaran Hari Ini</h3>
                <p>{{ $totalPembayaranHariIni }}</p>
            </div>
            <div class="col-md-6">
                <h3>Total Pembayaran Bulan Ini</h3>
                <p>{{ $totalPembayaranBulanIni }}</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h3>Total Pembayaran Tahun Ini</h3>
                <p>{{ $totalPembayaranTahunIni }}</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h3>Tabel Pembayaran Terakhir</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Total Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaranTerakhir as $index => $pembayaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pembayaran->langganan->pelanggan->Nama_Pelanggan }}</td>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->Tanggal_Pembayaran)->format('d F Y') }}</td>
                                <td>{{ $pembayaran->Jumlah_Pembayaran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
