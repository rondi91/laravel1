@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>
            <div class="mb-3">
                <form action="{{ route('produk.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2">
                        <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari pelanggan">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>stock</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                     @php
        
                        $number = ($produks->currentPage() - 1) * $produks->perPage() + 1;
                    @endphp
            <tbody id="produk-table">
                {{-- cobah pindah commit --}}
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $number++ }}</td>
                        <td>{{ $produk->produk->nama_produk }}</td>
                        <td>{{ $produk->harga ? $produk->warna->warna : '-' }}</td>
                        <td>{{ $produk->harga ? $produk->size->size : '-' }}</td>
                        <td>{{ $produk->harga ? $produk->stock : '-' }}</td>
                        <td>{{ $produk->harga ? $produk->harga : '-' }}</td> 
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $produks->links() }}
        </div>
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#searchinput').on('keyup', function() {
                    var query = $(this).val();
                    console.log(query);
            
                    $.ajax({
                        url: "{{ route('produk.search') }}",
                        type: "GET",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $('#produk-table').html(data);
                        }
                    });
                });
            });
            </script>
            
        
@endsection

