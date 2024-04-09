@extends('layouts.client')

@section('content')
<input type="hidden" id="penyewaan_gaun_page"  value="{{ csrf_token() }}">
<input type="hidden" id="landing_page"  value="{{ csrf_token() }}">
<h2 class="text-center display-4 custom-text-primary-poppins text-bold">Paket</h2>
<div id="data" class=" justify-content-center align-content-center">
    @include('client/paket/data')
</div>


{{-- Detail Paket --}}
<div class="modal fade" id="detailPaket" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailPaket">
  
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
<script src="{{ asset('js/client_js/landing_page.js') }}"></script>
@endsection


