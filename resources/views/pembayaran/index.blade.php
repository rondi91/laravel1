@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Data Pembayaran</h1>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

        <div class="mb-3">
            <form action="{{ route('pembayaran.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari pembayaran">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
        <table class="table table-bordered" id="pembayaran-table">
            <thead>
                <tr>
                    <th>ID Pembayaran</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->langganan->pelanggan->Nama_Pelanggan }}</td>
                        <td>{{ $data->Jumlah_Pembayaran }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->Tanggal_Pembayaran)->format('d F Y')  }}</td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('pembayaran.detail', $data->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('pembayaran.print', $data->id) }}" class="btn btn-success">Cetak</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pembayaran->links() }}
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#searchinput').on('keyup', function() {
              var query = $(this).val();
              console.log(query);
      
              $.ajax({
                  url: "{{ route('pembayaran.search') }}",
                  type: "GET",
                  data: {
                      search: query
                  },
                  success: function(data) {
                      $('#pembayaran-table').html(data);
                  }
              });
          });
      });
      </script>
      
@endsection
