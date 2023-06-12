@extends('layouts.main')
{{-- {{ dd(__FILE__,__LINE__,'ok'); }} --}}

@section('content')
<div class="container">
    
    <h1>Detail Pesan</h1>

    <h3>Informasi Pesan</h3>
    <p><strong>ID Pesan:</strong> {{ $pesan->id }}</p>
    <p><strong>Nama Pelanggan:</strong> {{ $pesan->pelanggan->nama_pelanggan }}</p>
    <p><strong>Tanggal Pesan:</strong> {{ $pesan->created_at }}</p>

    <h3>Daftar Produk</h3>
    <div class="table-responsive pt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                
                    <th>
                        Nama Produk
                    </th>
                    
                    <th>
                    Jumlah
                    </th>
                    <th>
                        Harga
                    </th>
                    <th>
                        Total Harga
                    </th>
                </tr>  
            
            </thead>
            <tbody>
                @foreach ($pesan->detailPesanan as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->unit_price }}</td>
                        <td>{{ $detail->jumlah*$detail->unit_price }}</td>
                    </tr>
                @endforeach
                @php
                        $totalKeseluruhan = 0;

                foreach ($pesan->detailPesanan as $item) {
                    $item_price = $item->unit_price;
                    $jumlah = $item->jumlah;

                    $total = $item_price * $jumlah;
                    $totalKeseluruhan += $total;
                }
                    @endphp
            </tbody>
        </table>
    </div>
    <h3> Total bayar : {{ $totalKeseluruhan }}</h3>
    {{-- {{ dd(__FILE__,__LINE__,$pesan->id); }} --}}
    {{-- {{ dd(__FILE__,__LINE__,$pesan->transaksi->pesan_id); }} --}}
    @if ($pesan->id == $pesan->transaksi()->exists())
        <p>Pesanan sudah dibayar.</p>
    @else
        <a href="{{ route('transactions.create', ['pesanan_id' => $pesan->id]) }}" class="btn btn-primary">Bayar</a>
    @endif
    
</div>
@endsection

