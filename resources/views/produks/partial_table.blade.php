@php
        $pkt ="belum terdaftar";
                        $number = ($produks->currentPage() - 1) * $produks->perPage() + 1;
                    @endphp

@foreach ($produks as $produk)
<tr>
<td>{{ $number++ }}</td>
<td>{{ $produk->produk->nama_produk }}</td>
<td>{{ $produk->harga ? $produk->warna->warna : '-' }}</td>
<td>{{ $produk->harga ? $produk->size->size : '-' }}</td>
<td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'stock', this.innerHTML)">{{ $produk->harga ? $produk->stock : '-' }}</td>
<td contenteditable="true" onblur="updateProduk('{{ $produk->id }}', 'harga', this.innerHTML)">{{ $produk->harga ? $produk->harga : '-' }}</td> 
<td>
    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a>
    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
    </form>
</td>
</tr>
@endforeach