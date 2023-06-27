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
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'warna', this.innerHTML)">{{ $produk->harga ? $produk->warna->warna : '-' }}</td>
                       {{-- <td>
                        <select onchange="updateProduk('{{ $produk->id }}', 'warna_id', this.value)">
                            @foreach($warnas as $warna)
                                <option value="{{ $warna->id }}" {{ $warna->id == $warna->id ? 'selected' : '' }}>{{ $warna->warna }}</option>
                            @endforeach
                        </select>
                    </td> --}}
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'size', this.innerHTML)">{{ $produk->harga ? $produk->size->size : '-' }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'stock', this.innerHTML)">{{ $produk->harga ? $produk->stock : '-' }}</td>
                       <td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'harga', this.innerHTML)">{{ $produk->harga ? $produk->harga : '-' }}</td> 
                        <td>
                            <button class="btn btn-primary add-to-cart-btn" id="add-to-cart-btn" data-toggle="modal" data-target="#cartModal" data-product-id="{{ $produk->id }}">Add to Cart</button>
                            <button class="btn btn-sm btn-primary" data-toggle= "modal" data-target="#exampleModalCenter" onclick="showDialog('{{ $produk->id }}')">Tambah Stock</button>
                        
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary edit-btn" data-id="{{ $produk->id }}">Edit</a>
                            
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('pesan.create', $produk->id) }}" class="btn btn-sm btn-warning ">order</a>
                            
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





        

<!-- Dialog box untuk penambahan stock -->

<div class="modal" id="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Stock</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="penambahanStokForm" action="{{ route('penambahan-stok.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" id="produkId">
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="penambahanStokForm">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


    <!-- Modal Dialog add cart -->
    {{-- <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cartModalLabel">Add to Cart</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Form untuk memasukkan jumlah produk -->
              <form id="addToCartForm" action="{{ route('cart.store') }}" method="post">
                <div class="form-group">
                    @csrf
                  <label for="quantity">Quantity</label>
                  <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary addToCartButton">Add</button>
            </div>
          </div>
        </div>
      </div> --}}

       {{-- java script code  --}}

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
        


        //  live search  produk
        
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

    // code add stock    
         
    function showDialog(produkId) {
        // Set nilai produkId pada input tersembunyi di dalam form
        document.getElementById('produkId').value = produkId;
        console.log(produkId);
        // Munculkan dialog box
        $('#dialog').modal('show');
    }



 // {{-- js for add cart  --}}

 $(document).ready(function() {
    $('.add-to-cart-btn').click(function() {
        var productId = $(this).data('product-id');

        $.ajax({
            url: '{{ route('cart.store') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('Product added to cart successfully.');
                } else {
                    alert('Failed to add product to cart.');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

    </script>

@endsection
