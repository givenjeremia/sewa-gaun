@extends('layouts.client')
@section('content')
<input type="hidden" id="landing_page"  value="{{ csrf_token() }}">
<div class="daftar_paket">
    @include('client/landing-page/paket')
</div>

<div class="rekomendasi_gaun">
    @include('client/landing-page/rekomendasi_gaun')
</div>

<div class="rekomendasi_perias">
    @include('client/landing-page/rekomendasi_perias')
</div>

{{-- Detail Paket --}}
<div class="modal fade" id="detailPaket" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailPaket">
  
      </div>
    </div>
</div>

{{-- Detail Gaun --}}
<div class="modal fade" id="detailGaun" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailGaun">
  
      </div>
    </div>
</div>

{{-- Detail Perias --}}
<div class="modal fade" id="detailPerias" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailPerias">
  
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
<script>
    $(document).ready(function() {
        $('.slider').slick({
            //   dots: true,
            //   autoplay: true,
            //   autoplaySpeed: 2500,

            slidesToShow: 4
            , slidesToScroll: 1
            , arrows: true
        });
    });

</script>
<script src="{{ asset('js/client_js/landing_page.js') }}"></script>


@endsection