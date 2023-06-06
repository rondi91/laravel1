@extends('layouts.main')

{{-- {{ dd(__FILE__,__LINE__,$pakets); }} --}}
@section('content')
<div class="container">
    <h1>Pakets</h1>
        <div class="mb-3">
            <form action="{{ route('paket.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari paket">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

    <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">Tambah paket</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>Nama PAKET</th>
                <th>Kecepatan_Internet</th>
                <th>Kuota</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
                        $number = ($pakets->currentPage() - 1) * $pakets->perPage() + 1;
                    @endphp
        <tbody id="paket-table">
            @foreach ($pakets as $data)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $data->Nama_Paket }}</td>
                    <td>{{ $data->Kecepatan_Internet }}</td>
                    <td>{{ $data->Kuota }}</td>
                    <td>{{ $data->Durasi }}</td>
                    <td>
                        <a href="{{ route('paket.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('paket.destroy', $data->id) }}" method="POST" class="d-inline">
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
        {{ $pakets->links() }}
    </div>
    
  </div>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#searchinput').on('keyup', function() {
            var query = $(this).val();
            console.log(query);
    
            $.ajax({
                url: "{{ route('paket.search') }}",
                type: "GET",
                data: {
                    search: query
                },
                success: function(data) {
                    $('#paket-table').html(data);
                }
            });
        });
    });
    </script>
    
@endsection
