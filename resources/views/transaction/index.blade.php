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
          <th>
            Action
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
          <td>
            <button class="btn btn-primary" onclick="showDialog('{{ $transaction->id }}')">Edit</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Dialog box untuk mengedit transaksi -->
<div class="modal" id="editDialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title">Edit Transaksi</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form id="editTransaksiForm" action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="nama">Nama Transaksi:</label>
                      <input type="text" class="form-control" name="nama" id="nama" value="{{ $transaksi->nama_transaksi }}">
                  </div>
                  <div class="form-group">
                      <label for="tanggal">Tanggal:</label>
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $transaksi->tanggal }}">
                  </div>
                  <div class="form-group">
                      <label for="jumlah">Jumlah:</label>
                      <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ $transaksi->jumlah }}">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" form="editTransaksiForm">Simpan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
      </div>
  </div>
</div>

<script>
  function showDialog(transaksiId) {
      // Set nilai transaksiId pada input tersembunyi di dalam form
      document.getElementById('transaksiId').value = transaksiId;
      
      // Munculkan dialog box
      $('#editDialog').modal('show');
  }
</script>

@endsection