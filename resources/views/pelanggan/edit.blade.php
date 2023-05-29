@extends('layouts.main')

<!-- pelanggan/edit.blade.php -->


@section('content')

<div class="container">
    <h1>Edit Pelanggan</h1>

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Nama_Pelanggan">Nama:</label>
            <input type="text" name="Nama_Pelanggan" id="Nama_Pelanggan" class="form-control" value="{{ $pelanggan->Nama_Pelanggan }}">
        </div>
        <div class="form-group">
            <label for="Alamat_Pelanggan">Alamat:</label>
            <textarea name="Alamat_Pelanggan" id="Alamat_Pelanggan" class="form-control">{{ $pelanggan->Alamat_Pelanggan }}</textarea>
        </div>
        <div class="form-group">
            <label for="Nomor_Telepon">No. Telepon:</label>
            <input type="text" name="Nomor_Telepon" id="Nomor_Telepon" class="form-control" value="{{ $pelanggan->Nomor_Telepon }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
