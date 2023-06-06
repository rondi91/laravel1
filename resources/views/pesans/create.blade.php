@extends('layouts.main')

{{-- {{ dd(__FILE__,__LINE__,$langganan);}} --}}

@section('content')
    <div class="container">
        <h1>{{ isset($pembayaran) ? 'Edit Pembayaran' : 'Tambah Pembayaran' }}</h1>

        <form action="{{ isset($pembayaran) ? route('pembayaran.update', $pembayaran->id) : route('pembayaran.store') }}" method="POST">
            @csrf
            @if(isset($pembayaran))
                @method('PUT')
            @endif

            <div class="mb-3">
                <div class="form-group">
                    <label for="pelanggan_id">Pelanggan</label>
                    <select class="form-control select-search-pelanggan" name="langganan_id"> </select>
                </div>
                
            </div>

            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" value="{{ isset($pembayaran) ? $pembayaran->Jumlah_Pembayaran : old('jumlah_pembayaran') }}">
            </div>

            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" value="{{ isset($pembayaran) ? $pembayaran->Tanggal_Pembayaran : old('tanggal_pembayaran') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    
    <script>
        $(document).ready(function() {
            $('.select-search-pelanggan').select2({
                placeholder: 'Pilih pelanggan',
                ajax: {
                    url: '{{ route("pembayaran.searchPelanggan") }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        });
        </script>
        
@endsection
