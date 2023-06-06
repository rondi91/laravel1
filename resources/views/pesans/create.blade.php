@extends('layouts.main')

@section('content')
<div class="containr">
    <h1>Tambah Pesanan</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pesan.store') }}">
                @csrf

                <div class="form-group">
                    <label for="pelanggan">Pelanggan:</label>
                    <select class="pelanggan-search form-control " name="langganan_id"></select>
                   
                </div>
{{-- 
                <div class="form-group">
                    <label for="pelanggan">Pelanggan:</label>
                    <select class="form-control select-search-pelanggan" id="pelanggan" name="pelanggan" required>
                        @foreach ($pelanggan as $pl)
                            <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="produk">Produk:</label>
                    <select class="form-control" id="produk" name="produk" required>
                        @foreach ($produk as $p)
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

        <script>
            $(document).ready(function() {
                $('.pelanggan-search').select2({
                    placeholder: 'Pilih pelanggan',
                    ajax: {
                        url: '{{ route("pelanggan.search") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                });
        
               
            });
        </script>
    
@endsection
