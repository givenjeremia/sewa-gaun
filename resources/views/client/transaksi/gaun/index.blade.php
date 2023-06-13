@extends('layouts.client')
@section('content')
<div class=" mx-5">
    <h4>Daftar Transaksi Gaun</h4>
    <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            @foreach ($list_status as $key => $item)
            <li class="nav-item"><a class="nav-link {{ $key == 3 ? 'active' : '' }}" href="#{{ $key }}" onclick="getData({{ $key }})" data-toggle="tab">{{ $item }}</a></li>
                
            @endforeach
            {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> --}}
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="3">
               
            </div>
            <div class="active tab-pane" id="2">
               
            </div>

            <div class="active tab-pane" id="1">
                
            </div>

            <div class="active tab-pane" id="0">
              
            </div>
           
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
</div>
@endsection

@section('js_client')
    <script src="{{ asset('js/client_js/transaksi_gaun.js') }}"></script>
@endsection