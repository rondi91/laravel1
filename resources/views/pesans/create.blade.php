@extends('layouts.main')

@section('content')
<div class="container">
   
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pesan.store') }}">
                @csrf

                

                <div class="form-group">
                    <div class="form-group">
                        <label for="pelanggan_id">Pelanggan</label>
                        <select class="form-control select-search-pelanggan" name="langganan_id"> </select>
                    </div>

                    {{-- <label for="pelanggan">Pelanggan:</label>
                    <select class="form-control select-search-pelanggan" id="pelanggan" name="pelanggan" required>
                        @foreach ($pelanggans as $pl)
                            <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                        @endforeach
                    </select> --}}
                </div>

                <div class="form-group">
                    <label for="produk">Produk:</label>
                    <select class="form-control" id="produk" name="produk" required>
                        @foreach ($produks as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div> 

{{-- live search  --}}

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>    --}}


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
