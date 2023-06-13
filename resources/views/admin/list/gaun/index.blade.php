@extends('layouts.admin')
@section('name_page')
    Daftar Gaun
@endsection
@section('page')
    Gaun
@endsection
@section('content')
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
    Tambah Gaun
</button>
{{-- Data --}}
<div id="data">
</div>


{{-- Tambah Gaun --}}
@include('admin/list/gaun/tambah')

{{-- Detail Gambar Gaun --}}
<div class="modal fade"  id="modalDetailGambar" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalContentDetailGambar">

    </div>
  </div>
</div>

{{-- Edit Gaun --}}
<div class="modal fade"   id="modalEditGaun" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalContentEditGaun">

    </div>
  </div>
</div>

@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/gaun.js') }}"></script>
@endsection

