@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Penambahan Stock</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Tanggal Penambahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tambahstok as $penambahan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penambahan->produk->nama_produk }}</td>
                        <td>{{ $penambahan->jumlah }}</td>
                        <td>{{ $penambahan->tanggal_penambahan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
