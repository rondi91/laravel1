<!-- resources/views/posts/create.blade.php -->

@extends('layouts.main')
<!-- pelanggan/create.blade.php -->


@section('content')
<div class="container">
    <h1>Tambah Pelanggan</h1>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="Nama_Pelanggan" id="nama" class="form-control">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea name="Alamat_Pelanggan" id="alamat" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="no_telepon">No. Telepon:</label>
            <input type="text" name="Nomor_Telepon" id="no_telepon" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
