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
                    <select class="pelanggan-search form-control " name="pelanggan_id" id="pelanggan"></select>
                   
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
                      <select name="produk[]" class="produk-select">
                        <option value="">Pilih Produk</option>
                        @foreach($produk as $p)
                          <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                        @endforeach
                      </select>
                
                      <label for="jumlah">Jumlah:</label>
                      <input type="text" name="jumlah[]" class="jumlah-input">
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

            <script>
                function tambahPesan() {
                console.log('ok');
                var pesanGroup = document.createElement('div');
                pesanGroup.className = 'pesan-group';
            
                var produkLabel = document.createElement('label');
                produkLabel.textContent = 'Produk:';
                var produkSelect = document.createElement('select');
                produkSelect.name = 'produk[]';
                produkSelect.className = 'produk-select';
            
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Pilih Produk';
                produkSelect.appendChild(defaultOption);
            
                @foreach($produk as $p)
                    var option = document.createElement('option');
                    option.value = '{{ $p->id }}';
                    option.textContent = '{{ $p->nama_produk }}';
                    produkSelect.appendChild(option);
                @endforeach
            
                var jumlahLabel = document.createElement('label');
                jumlahLabel.textContent = 'Jumlah:';
                var jumlahInput = document.createElement('input');
                jumlahInput.type = 'text';
                jumlahInput.name = 'jumlah[]';
                jumlahInput.className = 'jumlah-input';
            
                pesanGroup.appendChild(produkLabel);
                pesanGroup.appendChild(produkSelect);
                pesanGroup.appendChild(jumlahLabel);
                pesanGroup.appendChild(jumlahInput);
            
                var container = document.getElementById('pesan-container');
                container.appendChild(pesanGroup);
                }
            </script>
    
@endsection
