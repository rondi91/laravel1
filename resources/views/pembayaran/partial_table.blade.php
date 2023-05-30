
                    @php
                        $number = ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + 1;
                    @endphp
            @foreach ($pembayaran as $data)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $data->langganan->pelanggan->Nama_Pelanggan }}</td>
                    <td>{{ $data->Jumlah_Pembayaran }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->Tanggal_Pembayaran)->format('d F Y') }}</td>
                    <td>
                        <a href="{{ route('pembayaran.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="alert('yakin hapus')">Hapus</button>
                        </form>
                        <a href="{{ route('pembayaran.detail', $data->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach