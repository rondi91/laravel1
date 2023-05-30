@extends('layouts.main')


@section('content')
<div class="container">
    <h1>Pelanggan</h1>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    

    <div class="mb-3">
        <form action="{{ route('pelanggan.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="searchinput" id="searchinput" class="form-control" placeholder="Cari Pelanggan" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" id="search-btn" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
                        $number = ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + 1;
                    @endphp
        <tbody id="pelanggan-table">
            @foreach ($pelanggan as $data)
                <tr>
                    <td>{{ $number++}}</td>
                    <td>{{ $data->Nama_Pelanggan }}</td>
                    <td>{{ $data->Alamat_Pelanggan }}</td>
                    <td>{{ $data->Nomor_Telepon }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
            
            
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $pelanggan->links() }}
        </div>

    

  {{-- <script>
    $(document).ready(function() {
      $('#searchinput').keyup(function(event) {
        var keyPressed = event.key;
        console.log('Key Pressed:', keyPressed);
      });
    });
  </script> --}}
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#searchinput').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();

            $('tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
            });
        });
    });
</script>
  
@endsection
