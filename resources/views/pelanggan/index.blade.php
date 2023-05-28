@extends('layouts.main')
<!-- resources/views/posts/index.blade.php -->
{{-- {{ dd(__FILE__,__LINE__,$pelanggans);  }} --}}


@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pelanggan</h4>
        
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
                  Alamat
                </th>
                
               </tr>
            </thead>
            <tbody>
                @foreach ($pelanggans as $plg )
                    
                
              <tr>
                <td>
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ $plg->nama_pelanggan }}
                </td>
                
                <td>
                    {{ $plg->alamat }}
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
