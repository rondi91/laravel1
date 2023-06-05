@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>
            <div class="mb-3">
                <form action="{{ route('produk.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2">
                        <input type="text" name="search" id="searchinput" class="form-control" placeholder="Cari pelanggan">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>stock</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="produk-table">
                     @php
        
                        $number = ($produks->currentPage() - 1) * $produks->perPage() + 1;
                    @endphp
                {{-- cobah pindah commit --}}
                @foreach ($produks as $produk)
                <div class="produk-item">
                    <tr>
                        <td>{{ $number++ }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'nama_produk', this.innerHTML)">{{ $produk->produk->nama_produk }}</td>
                       {{-- <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'warna', this.innerHTML)">{{ $produk->harga ? $produk->warna->warna : '-' }}</td> --}}
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'warna_id', this.innerHTML)">{{ $produk->warna->warna }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'size', this.innerHTML)">{{ $produk->harga ? $produk->size->size : '-' }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'stock', this.innerHTML)">{{ $produk->harga ? $produk->stock : '-' }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'harga', this.innerHTML)">{{ $produk->harga ? $produk->harga : '-' }}</td> 
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary edit-btn" data-id="{{ $produk->id }}">Edit</a>
                            
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                </div>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $produks->links() }}
        </div>
    </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            function updateProduk(id, field, value) {
                axios.patch(`/produk/${id}`, {
                        [field]: value
                    })
                    .then(response => {
                        if (response.status === 200) {
                            console.log('Produk berhasil diperbarui');
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        </script>


        {{-- live search --}}
        {{-- <script>
            $(document).ready(function() {
                $('#searchinput').on('keyup', function() {
                    var query = $(this).val();
                    console.log(query);
            
                    $.ajax({
                        url: "{{ route('produk.search') }}",
                        type: "GET",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $('#produk-table').html(data);
                        }
                    });
                });
            });
            </script> --}}
            
        
@endsection

