@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>
        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <table class="table">
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
            <tbody>
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
@endsection
