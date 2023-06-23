@extends('layouts.client')
@section('content')
<input type="hidden" id="list_jadwal_page"  value="{{ csrf_token() }}">
<h2 class="text-center display-4 custom-text-primary-poppins text-bold">Katalog</h2>
<form action="simple-results.html">
<div class="row">
    <div class="col-3">
        <div class="input-group">
            <input id="input-search-gaun" type="date" class="form-control " placeholder="Cari Gaun">
        </div>
    </div>
    <div class="col-3">
        <div class="input-group">
            <input id="input-search-gaun" type="date" class="form-control " placeholder="Cari Gaun">
        </div>
    </div>
    <div class="col-3">
        <div class="input-group">
            <button id="btn-cari" type="button" class="form-control " >Cari</button>
        </div>
    </div>
</div>
</form>




<div id="data-jadwal">
    {{-- @include('client/jadwal/table') --}}
</div>


{{-- Detail Paket --}}
<div class="modal fade" id="detailJadwal" data-bs-scroll="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetailJadwal">
  
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
<script src="{{ asset('js/client_js/list_jadwal.js') }}"></script>


@endsection