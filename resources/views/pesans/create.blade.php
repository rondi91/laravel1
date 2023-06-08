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
                

                <div id="pesan-container">
                    <div class="pesan-group">
                      <label for="produk">Produk:</label>
                      <select name="produk[]" class="produk-select" onchange="updateHarga(this)">
                        <option value="">Pilih Produk</option>
                        @foreach($harga as $p)
                          <option value="{{ $p->produk->id }}" data-harga="{{ $p->harga }}">{{ $p->produk->nama_produk }}</option>
                        @endforeach
                      </select>
                
                      <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" id="jumlah"  class="jumlah-input form-control" min="1" value="1" onchange="updateTotal(this)">
                      </div>
                
                      <label for="harga">Harga:</label>
                      <input type="number" name="harga[]" class="harga-input" readonly>
                
                      <label for="total_harga">Total Harga:</label>
                      <input type="text" name="total_harga[]" class="total-input" readonly>
                    </div>
                  </div>

                  
                  <button type="button" onclick="tambahPesan()">Tambah Pesan</button>
                  <button type="submit">Simpan</button>
                </form>
                
                  <button type="button" onclick="tambahPesan()">Tambah Pesan</button>
                  <button type="submit">Simpan</button>
                </form>
                
                <script>
                function updateHarga(input) {
                var pesanGroup = input.parentNode;
                var produkSelect = pesanGroup.querySelector('.produk-select');
                var hargaInput = pesanGroup.querySelector('.harga-input');
                var jumlahInput = pesanGroup.querySelector('.jumlah-input');
                var totalInput = pesanGroup.querySelector('.total-input');

                if (produkSelect) {
                  var harga = produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga');
                  var jumlah = jumlahInput.value;

                  if (harga && jumlah) {
                    var hargaPerJumlah = parseFloat(harga);
                    var totalHarga = hargaPerJumlah * parseFloat(jumlah);

                    hargaInput.value = hargaPerJumlah.toFixed(2);
                    totalInput.value = totalHarga.toFixed(2);
                  } else {
                    hargaInput.value = '';
                    totalInput.value = '';
                  }
                }
              }

              function updateTotal() {
                var pesanGroups = document.querySelectorAll('.pesan-group');

                pesanGroups.forEach(function (pesanGroup) {
                  var jumlahInput = pesanGroup.querySelector('.jumlah-input');
                  var hargaInput = pesanGroup.querySelector('.harga-input');
                  var totalInput = pesanGroup.querySelector('.total-input');

                  var hargaPerJumlah = parseFloat(hargaInput.value);
                  var jumlah = parseFloat(jumlahInput.value);

                  var totalHarga = hargaPerJumlah * jumlah;
                  totalInput.value = totalHarga.toFixed(2);
                });

                
                  function tambahPesan() {
                    var pesanGroup = document.createElement('div');
                    pesanGroup.className = 'pesan-group';
                
                    var produkLabel = document.createElement('label');
                    produkLabel.textContent = 'Produk:';
                    var produkSelect = document.createElement('select');
                    produkSelect.name = 'produk[]';
                    produkSelect.className = 'produk-select';
                    produkSelect.onchange = function() {
                      updateHarga(this);
                    }
                
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Pilih Produk';
                    produkSelect.appendChild(defaultOption);
                
                    @foreach($produk as $p)
                      var option = document.createElement('option');
                      option.value = '{{ $p->id }}';
                      option.setAttribute('data-harga', '{{ $p->harga }}');
                      option.textContent = '{{ $p->nama_produk }}';
                      produkSelect.appendChild(option);
                    @endforeach
                
                    var jumlahLabel = document.createElement('label');
                    jumlahLabel.textContent = 'Jumlah:';
                    var jumlahInput = document.createElement('input');
                    jumlahInput.type = 'text';
                    jumlahInput.name = 'jumlah[]';
                    jumlahInput.className = 'jumlah-input';
                    jumlahInput.onkeyup = function() {
                      updateHarga(this);
                    }
                
                    var hargaLabel = document.createElement('label');
                    hargaLabel.textContent = 'Harga Per Jumlah:';
                    var hargaInput = document.createElement('input');
                    hargaInput.type = 'text';
                    hargaInput.name = 'harga[]';
                    hargaInput.className = 'harga-input';
                    hargaInput.readOnly = true;
                
                    var totalLabel = document.createElement('label');
                    totalLabel.textContent = 'Total Harga:';
                    var totalInput = document.createElement('input');
                    totalInput.type = 'text';
                    totalInput.name = 'total[]';
                    totalInput.className = 'total-input';
                    totalInput.readOnly = true;
                
                    pesanGroup.appendChild(produkLabel);
                    pesanGroup.appendChild(produkSelect);
                    pesanGroup.appendChild(jumlahLabel);
                    pesanGroup.appendChild(jumlahInput);
                    pesanGroup.appendChild(hargaLabel);
                    pesanGroup.appendChild(hargaInput);
                    pesanGroup.appendChild(totalLabel);
                    pesanGroup.appendChild(totalInput);
                
                    var container = document.getElementById('pesan-container');
                    container.appendChild(pesanGroup);
                  }
                }
                </script>
@endsection
