@extends('layouts.client')

@section('content')
<input type="hidden" id="penyewaan_gaun_page"  value="{{ csrf_token() }}">
<h2 class="text-center display-4 custom-text-primary-poppins text-bold">Katalog</h2>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="simple-results.html">
            <div class="input-group">
                <input id="input-search-gaun" type="search" class="form-control form-control-lg" placeholder="Cari Gaun">
            </div>
        </form>
    </div>
</div>

<div id="data" class="m-4">
    @include('client/penyewaan_gaun/data')
</div>


{{-- Detail Gambar Gaun --}}
<div class="modal fade" id="detailGaun" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailGaun">
  
      </div>
    </div>
</div>

{{-- Pemesanan --}}
<div class="modal fade" id="pemesanan" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentPemesanan">
  
      </div>
    </div>
</div>

{{-- Pembayaran --}}
<div class="modal fade" id="pembayaran" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentPembayaran">
  
      </div>
    </div>
</div>

@endsection

@section('js_client')
    <script src="{{ asset('js/client_js/gaun.js') }}"></script>
@endsection


