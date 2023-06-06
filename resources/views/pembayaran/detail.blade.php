@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Detail Pembayaran</h1>

        <div id="print-area">
            <h2>Nota Pembayaran</h2>
            <hr>
            <table class="table table-bordered">
                <tr>
                    <th>ID Pembayaran</th>
                    <td>{{ $pembayaran->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $pembayaran->langganan->pelanggan->Nama_Pelanggan }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>Rp. {{ $pembayaran->Jumlah_Pembayaran }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{  \Carbon\Carbon::parse($pembayaran->Tanggal_Pembayaran)->format('d F Y') }}</td>
                </tr>
            </table>
        </div>

        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        <button onclick="printPage()" class="btn btn-primary">Cetak</button>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #print-area, #print-area * {
                visibility: visible;
            }
            #print-area {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <script>
        function printPage() {
            window.print();
        }
    </script>
@endsection
