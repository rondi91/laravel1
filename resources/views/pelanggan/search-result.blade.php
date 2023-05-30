
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="pelanggan-table">
        @foreach ($pelanggan as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->Nama_Pelanggan }}</td>
                <td>{{ $data->Alamat_Pelanggan }}</td>
                <td>{{ $data->Nomor_Telepon }}</td>
                <td>
                    <a href="{{ route('pelanggan.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('pelanggan.destroy', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>