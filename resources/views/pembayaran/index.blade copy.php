@extends('layouts.main')

{{-- {{ dd(__FILE__,__LINE__,$pakets); }} --}}
@section('content')
<div class="container">
    <h1>Pembayaran</h1>
        <div class="mb-3">
            <form action="{{ route('pembayaran.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari pembayaran">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah pembayaran</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>Nama Pelanggan</th>
                <th>jumlah pembayaran</th>
                <th>Tanggal Pemabayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
                        $number = ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + 1;
                    @endphp
        <tbody id="pembayaran-table">
            @foreach ($pembayaran as $data)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $data->langganan->pelanggan->Nama_Pelanggan }}</td>
                    <td>{{ $data->Jumlah_Pembayaran }}</td>
                    <td>{{ $data->Tanggal_Pembayaran->format('d F Y') }}</td>
                    <td>
                        <a href="{{ route('pembayaran.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="alert('yakin hapus')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $pembayaran->links() }}
    </div>
    
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
