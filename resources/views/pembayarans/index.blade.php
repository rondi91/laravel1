@extends('layouts.main')
<!-- resources/views/posts/index.blade.php -->
{{-- {{ dd(__FILE__,__LINE__,$Pembayarans);  }} --}}


@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pembayarans</h4>
        
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  no
                </th>
                <th>
                  Nama Pelanggan
                </th>
                <th>
                  Total Bayar
                </th>
                
                <th>
                  Tanggal Pembayaran
                </th>
                
               </tr>
            </thead>
            <tbody>
                @foreach ($bayars as $bayar )
                    
                
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ $bayar->pelanggan->nama_pelanggan }}
                </td>
                
                <td>
                    {{ $bayar->jumlah_pembayaran }}
                </td>
                <td>
                    {{ $bayar->tanggal_pembayaran }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
