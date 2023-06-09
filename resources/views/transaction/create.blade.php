@extends('layouts.main')

@section('content')
<div class="container">
    
    <h1>Pembayaran Pesanan</h1>

    {{-- {{ dd(__FILE__,__LINE__,$pesans->id); }} --}}
    @php
            $totalKeseluruhan = 0;

            foreach ($pesans->detailPesanan as $item) {
            $item_price = $item->unit_price;
            $jumlah = $item->jumlah;

            $total = $item_price * $jumlah;
            $totalKeseluruhan += $total;
            }
    @endphp

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <input type="hidden" name="pesan_id" value="{{ $pesans->id }}">
        <input type="hidden" name="pelanggan_id" value="{{ $pesans->pelanggan_id }}">

        <div class="form-group">
            <label for="total_price">Jumlah Bayar:</label>
            <input type="number" name="total_price" id="total_price" class="form-control" value="{{ $totalKeseluruhan }}" required readonly>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>

</div>
@endsection
