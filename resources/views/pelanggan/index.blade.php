@extends('layouts.main')


@section('content')
<div class="container">
    <h1>Pelanggan</h1>
        <div class="mb-3">
            <form action="{{ route('pelanggan.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari pelanggan">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>PAKET </th>
                <th>Aksi</th>
            </tr>
        </thead>
        

        @php
        $pkt ="belum terdaftar";
                        $number = ($pelanggans->currentPage() - 1) * $pelanggans->perPage() + 1;
                    @endphp
        <tbody id="pelanggan-table">
            @foreach ($pelanggans as $data)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $data->Nama_Pelanggan }}</td>
                    <td>{{ $data->Alamat_Pelanggan }}</td>
                    
                    {{-- @foreach ($data->langganan as $langganan)
                    @endforeach --}}

                    <td>
                        @if ($data->langganan->count() > 0)
                            @foreach ($data->langganan as $langganan)
                                {{ $langganan->paket->Kecepatan_Internet }}
                            @endforeach
                        @else
                            Belum berlangganan paket
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('pelanggan.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $data->id) }}" method="POST" class="d-inline">
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
        {{ $pelanggans->links() }}
    </div>
    
  </div>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#searchinput').on('keyup', function() {
            var query = $(this).val();
            console.log(query);
    
            $.ajax({
                url: "{{ route('pelanggan.search') }}",
                type: "GET",
                data: {
                    search: query
                },
                success: function(data) {
                    $('#pelanggan-table').html(data);
                }
            });
        });
    });
    </script>
    
@endsection