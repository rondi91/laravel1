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
        <tbody>
            @foreach ($pesan as $psn)
                <tr>
                    <td>{{ $psn->id }}</td>
                    <td>{{ $psn->pelanggan->nama_pelanggan }}</td>
                    {{-- <td>{{ $psn->produk->nama_produk}}</td> --}}
                    <td>{{ $psn->status }}</td>
                    <td>
                        <a href="{{ route('pesan.show', $psn->id) }}" class="btn btn-sm btn-warning">show</a>
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
@section('scripts')
    <script>
        function filterPesan(status) {
            window.location.href = "{{ route('pesan.index') }}?status=" + status;
        }
    </script>