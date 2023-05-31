@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>{{ isset($pembayaran) ? 'Edit Pembayaran' : 'Tambah Pembayaran' }}</h1>

        <form action="{{ isset($pembayaran) ? route('pembayaran.update', $pembayaran->ID_Pembayaran) : route('pembayaran.store') }}" method="POST">
            @csrf
            @if(isset($pembayaran))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="langganan_id" class="form-label">Langganan</label>
                <select name="langganan_id" id="langganan_id" class="form-control">
                    @foreach($langganan as $data)
                        <option value="{{ $data->id }}" {{ isset($pembayaran) && $pembayaran->langganan_id == $data->id ? 'selected' : '' }}>
                            {{ $data->pelanggan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" value="{{ isset($pembayaran) ? $pembayaran->jumlah_pembayaran : old('jumlah_pembayaran') }}">
            </div>

            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" value="{{ isset($pembayaran) ? $pembayaran->tanggal_pembayaran : old('tanggal_pembayaran') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
