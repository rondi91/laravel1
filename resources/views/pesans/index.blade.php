@extends('layouts.main')


@section('content')
    <div class="container">
    <h1>Daftar Pesan</h1>

    <a href="{{ route('pesan.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>


    <div class="tabs center">
        <ul class="nav nav-tabs ">
            <li class="nav-item">
                <a class="nav-link {{ request('status') == '' ? 'active' : '' }}" href="{{ route('pesan.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'belum diproses' ? 'active' : '' }}" href="{{ route('pesan.index', ['status' => 'belum diproses']) }}">Belum Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'dalam pengiriman' ? 'active' : '' }}" href="{{ route('pesan.index', ['status' => 'dalam pengiriman']) }}">Dalam Pengiriman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}" href="{{ route('pesan.index', ['status' => 'selesai']) }}">Selesai</a>
            </li>
        </ul>
    </div>

     <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                {{-- <th>Produk</th> --}}
                <th>status</th>
                <th>Aksi</th>
            </tr>
        </thead>
@if($pesan->count() > 0)
        <tbody>
            @foreach ($pesan as $psn)
                <tr>
                    <td>{{ $psn->id }}</td>
                    <td>{{ $psn->pelanggan->nama_pelanggan }}</td>
                    {{-- <td>{{ $psn->produk->nama_produk}}</td> --}}
                    <td>{{ $psn->status }}</td>
                    <td>
                        <a href="{{ route('pesan.detail', $psn->id) }}" class="btn btn-sm btn-warning">detail</a>
                        {{-- <a href="{{ route('pesan.edit', $psn->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                        <button class="btn btn-primary"  onclick="showEditDialog('{{ $psn->id }}')">Edit</button>
                        <form action="{{ route('pesan.destroy', $psn->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Dialog Box Edit -->
<div id="editDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('pesan.update', $psn->id) }}" method="POST">
                    @csrf
                    @method('PUT')
  
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="hidden" class="form-control" id="pesan_id" name="pesan_id" >
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required readonly>
                    </div>
  
                    <div class="form-group">
                        <label for="tanggal_pesan">Tanggal Pesan</label>
                        <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required readonly>
                    </div>
  
                    
  
                    <div class="form-group">
                        <label for="status_pesan">Status Pesan</label>
                        <select class="form-control" id="status_pesan" name="status_pesan" required>
                            <option value="prosses">prosses</option>
                            <option value="selesai">selesai</option>
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
  @else
<!-- Tampilkan pesan jika data pesanan kosong -->
<p>Tidak ada data pesanan yang ditemukan.</p>
@endif

  <script>
    function showEditDialog(pesaniId) {
      console.log(pesaniId);
        // Ambil data transaksi berdasarkan ID dari server
        $.ajax({
            url: '/pesan/' + pesaniId,
            type: 'GET',
            success: function(respon) {
            
              console.log(respon);
                // Isi nilai input dengan data transaksi yang diterima
                $('#pesan_id').val(respon.id);
                $('#nama_pelanggan').val(respon.nama_pelanggan);
                $('#tanggal_pesan').val(respon.tanggal);
                $('#status_pesan').val(respon.status);
                
                
  
  
                // Tampilkan dialog box edit
                $('#editDialog').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
  </script>

<script>
    function filterPesan(status) {
        window.location.href = "{{ route('pesan.index') }}?status=" + status;
    }
</script>
 
@endsection
