@extends('layouts.admin')
@section('name_page')
    Daftar Transaksi
@endsection
@section('page')
    Transaksi
@endsection
@section('content')
<input type="hidden" id="list_pengembalian-gaun" value="{{ csrf_token() }}">
{{-- Data --}}
<div id="data-transaksi"></div>


{{-- Detail Gambar Gaun --}}
<div class="modal fade" id="modalDetailGambar" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentDetailGambar">

    </div>
  </div>
</div>

{{-- Update Gaun --}}

@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/pengembalian_gaun.js') }}"></script>
@endsection

