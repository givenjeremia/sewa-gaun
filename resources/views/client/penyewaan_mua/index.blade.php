@extends('layouts.client')

@section('content')
<input type="hidden" id="penyewaan_perias_page"  value="{{ csrf_token() }}">
<h2 class="text-center display-4 custom-text-primary-poppins text-bold">Makeup Artis</h2>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="simple-results.html">
            <div class="input-group">
                <input type="search" id="input-search-perias" class="form-control form-control-lg" placeholder="Cari Makeup Artis">
            </div>
        </form>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-2">
      <div class="card card-primary card-outline me-2">
        <div class="card-body pt-2">
          <h3 class="profile-username text-center mb-3">Kategori</h3>
          <div class="form-check">
            <input class="form-check-input kategori_perias" type="radio" name="kategori_perias" value="all" checked>
            <label class="form-check-label" for="flexRadioDefault1">
              Semua
            </label>
          </div>
          @foreach($kategori as $key => $value)
          <div class="form-check">
            <input class="form-check-input kategori_perias" type="radio" name="kategori_perias" value="{{ $value->id }}">
            <label class="form-check-label" for="flexRadioDefault1">
              {{ $value->nama }}
            </label>
          </div>
            
          @endforeach
         
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-10">
        <div id="data">

          @include('client/penyewaan_mua/data')
        </div>
    </div>
    <!-- /.col -->
</div>

{{-- Detail Gambar Perias --}}
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
    <script src="{{ asset('js/client_js/perias.js') }}"></script>
@endsection

