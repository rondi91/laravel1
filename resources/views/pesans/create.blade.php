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
                    <select class="pelanggan-search form-control " name="pelanggan_id" id="pelanggan" placeholder= "Pilih pelanggan"></select>
                   
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

                    {{-- <div class="form-group">
                        <label for="produk">Produk:</label>
                        <select class="form-control" id="produk" name="produk" required>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                <div id="pesan-container">
                    <div class="pesan-group">
                      <label for="produk">Produk:</label>
                      <input type="text" name="" id="" value="{{ $produk->produk->nama_produk }}" readonly>

                      
                
                
                      <label for="jumlah">Jumlah:</label>
                      <input type="text" name="jumlah[]" class="jumlah-input" >
                    </div>
                  </div>
                
                  <button type="button" onclick="tambahPesan()">Tambah Pesan</button>
                  <button type="submit">Simpan</button>
                </form>
                
               
        </div>
    </div>
</div>

        <script>
            $(document).ready(function() {
                $('.pelanggan-search').select2({
                    
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
