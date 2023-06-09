@extends('layouts.main')

@section('content')
<div class="container">
    
    <h1>Daftar Transaksi</h1>

<div class="table-responsive pt-3">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>
            ID Transaksi
          
            
          </th>
          <th>
            Nama Pelanggan
          </th>
          
          <th>
            Tanggal Transaksi
          </th>
          <th>
            Total Harga
          </th>
          <th>
            Metode Pembayaran 
          </th>
          <th>
            Status Pembayaran
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transactions as $transaction)
        <tr>
          <td>
            {{ $transaction->id }}
          </td>
          <td>
            {{ $transaction->pelanggan->nama_pelanggan }}
          </td>
         
          <td>
            {{ $transaction->transaction_date }}
          </td>
          <td>
            {{ $transaction->total_price }}
          </td>
          <td>
            {{ $transaction->payment_method }}
          </td>
          <td>
            {{ $transaction->payment_status }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection