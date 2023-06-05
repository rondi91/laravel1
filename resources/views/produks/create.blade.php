@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Tambah Produk</h1>

        <form action="{{ route('produk.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div id="variasi-form">
                <div class="variasi-group">
                    <div class="form-group">
                        <label for="ukuran">size</label>
                        <select name="variasi[0][size]" class="form-control" required>
                            <option value="">Pilih size</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select name="variasi[0][warna]" class="form-control" required>
                            <option value="">Pilih Warna</option>
                            @foreach($warna as $color)
                                <option value="{{ $color->id }}">{{ $color->warna }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="variasi[0][harga]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">stock</label>
                        <input type="number" name="variasi[0][stock]" class="form-control" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="tambah-variasi">Tambah Variasi</button>
            <button type="submit" class="btn btn-primary">save</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahVariasiButton = document.getElementById('tambah-variasi');
            const variasiForm = document.getElementById('variasi-form');

            let variasiCount = 1;

            tambahVariasiButton.addEventListener('click', function() {
                const variasiGroup = document.createElement('div');
                variasiGroup.classList.add('variasi-group');

                variasiGroup.innerHTML = `
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <select name="variasi[${variasiCount}][size]" class="form-control" required>
                            <option value="">Pilih Ukuran</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select name="variasi[${variasiCount}][warna]" class="form-control" required>
                            <option value="">Pilih Warna</option>
                            @foreach($warna as $color)
                                <option value="{{ $color->id }}">{{ $color->warna }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="variasi[${variasiCount}][harga]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">stock</label>
                        <input type="number" name="variasi[${variasiCount}][stock]" class="form-control" required>
                    </div>
                `;

                variasiForm.appendChild(variasiGroup);

                variasiCount++;
            });
        });
    </script>
@endsection
