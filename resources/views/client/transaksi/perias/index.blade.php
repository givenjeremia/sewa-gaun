@extends('layouts.client')
@section('content')
<input type="hidden" id="transaksi_perias_page"  value="{{ csrf_token() }}">
<div class=" mx-5">
    <h4>Daftar Transaksi Perias</h4>
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


{{-- Detail Transaksi --}}
<div class="modal fade" id="detailTransaksi" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" id="modalContentDetailTransaksi">

    </div>
  </div>
</div>

<div class="modal fade" id="pembayaran" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" id="modalContentPembayaran">

    </div>
  </div>
</div>


<div class="modal fade" id="komplain" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentKomplain">

    </div>
  </div>
</div>

<div class="modal fade" id="rating_review" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentRatingReview">

    </div>
  </div>
</div>


@endsection

@section('js_client')
    <script src="{{ asset('js/client_js/transaksi_perias.js') }}"></script>
@endsection