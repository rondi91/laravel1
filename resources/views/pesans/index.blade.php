@extends('layouts.main')

@section('content')
    <div class="container">
    <h1>Daftar Pesanan</h1>

    <a href="{{ route('pesan.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>

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
        <tbody>
            @foreach ($pesanan as $psn)
                <tr>
                    <td>{{ $psn->id }}</td>
                    <td>{{ $psn->pelanggan->nama_pelanggan }}</td>
                    {{-- <td>{{ $psn->produk->nama_produk}}</td> --}}
                    <td>{{ $psn->status }}</td>
                    <td>
                        <a href="{{ route('pesan.edit', $psn->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
@endsection
