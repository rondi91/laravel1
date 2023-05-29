@extends('layouts.main')


@section('content')
<div class="container">
    <h1>Pelanggan</h1>
        <div class="mb-3">
            <form action="{{ route('pelanggan.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari pelanggan">
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
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
  </div>
@endsection
