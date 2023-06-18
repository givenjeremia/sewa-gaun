@extends('layouts.admin')
@section('name_page')
    Daftar Paket
@endsection
@section('page')
    Paket
@endsection
@section('content')
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
    Tambah Paket
</button>
{{-- Data --}}
<div id="data">
</div>


{{-- Tambah Gaun --}}
@include('admin/list/paket/tambah')

{{-- Detail Gambar Gaun --}}
<div class="modal fade"  id="modalDetailGambar" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalContentDetailGambar">

    </div>
  </div>
</div>

{{-- Edit Gaun --}}
<div class="modal fade"   id="modalEditPaket" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalContentEditPaket">

    </div>
  </div>
</div>

@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/paket.js') }}"></script>
@endsection

