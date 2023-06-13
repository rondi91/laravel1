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
            <button class="btn btn-primary"  onclick="showEditDialog('{{ $transaction->id }}')">Edit</button>
           
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- Dialog Box Edit -->
<div id="editDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Transaksi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="editForm" action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                      <label for="nama_pelanggan">Nama Pelanggan</label>
                      <input type="hidden" class="form-control" id="transaction_id" name="transaction_id" >
                      <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required readonly>
                  </div>

                  <div class="form-group">
                      <label for="tanggal_transaksi">Tanggal Transaksi</label>
                      <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required readonly>
                  </div>

                  <div class="form-group">
                      <label for="total_harga">Total Harga</label>
                      <input type="number" class="form-control" id="total_harga" name="total_harga" required readonly>
                  </div>

                  <div class="form-group">
                      <label for="metode_pembayaran">Metode Pembayaran</label>
                      <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                          <option value="cash">Cash</option>
                          <option value="credit">Credit</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="status_pembayaran">Status Pembayaran</label>
                      <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                          <option value="paid">Paid</option>
                          <option value="unpaid">Unpaid</option>
                          
                      </select>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<script>
  function showEditDialog(transaksiId) {
    console.log(transaksiId);
      // Ambil data transaksi berdasarkan ID dari server
      $.ajax({
          url: '/transactions/' + transaksiId,
          type: 'GET',
          success: function(respon) {
          
            console.log(respon);
              // Isi nilai input dengan data transaksi yang diterima
              $('#transaction_id').val(respon.id);
              $('#nama_pelanggan').val(respon.nama_pelanggan);
              $('#tanggal_transaksi').val(respon.transaction_date);
              $('#total_harga').val(respon.total_price);  
              $('#metode_pembayaran').val(respon.payment_method);
              $('#status_pembayaran').val(respon.payment_status);
              


              // Tampilkan dialog box edit
              $('#editDialog').modal('show');
          },
          error: function(xhr) {
              console.log(xhr.responseText);
          }
      });
  }
</script>
@endsection