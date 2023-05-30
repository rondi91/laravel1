
@php
                        $number = ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + 1;
                    @endphp
@foreach ($pembayaran as $data)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $data->langganan->pelanggan->Nama_Pelanggan }}</td>
                    <td>{{ $data->Jumlah_Pembayaran }}</td>
                    <td>{{ $data->Tanggal_Pembayaran }}</td>
                    <td>
                        <a href="{{ route('pembayaran.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="alert('yakin hapus')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach