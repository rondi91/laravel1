@extends('layouts.main')
<!-- resources/views/posts/index.blade.php -->
{{-- {{ dd(__FILE__,__LINE__,$pakets);  }} --}}


@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pakets</h4>
        
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  no
                </th>
                <th>
                  Nama Pakets
                </th>
                <th>
                  Deskripsi
                </th>
                
               </tr>
            </thead>
            <tbody>
                @foreach ($pakets as $pkt )
                    
                
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ $pkt->nama_paket }}
                </td>
                
                <td>
                    {{ $pkt->deskripsi }}
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
