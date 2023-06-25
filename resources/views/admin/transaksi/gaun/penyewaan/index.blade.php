@extends('layouts.admin')
@section('name_page')
    Daftar Transaksi
@endsection
@section('page')
    Transaksi
@endsection
@section('content')
<input type="hidden" id="list_penyewaan_page" value="{{ csrf_token() }}">
{{-- Data --}}
<div id="data-transaksi"></div>


{{-- Detail Gambar Gaun --}}
<div class="modal fade" id="modalDetailPemesananGaun" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentDetailPemesananGaun">

    </div>
  </div>
</div>

{{-- Update Gaun --}}
<div class="modal fade" id="modalVerifStatus" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentVerifStatus">

    </div>
  </div>
</div>


@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/penyewaan_gaun.js') }}"></script>
@endsection

