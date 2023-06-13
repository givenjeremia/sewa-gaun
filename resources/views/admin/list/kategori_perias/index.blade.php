@extends('layouts.admin')
@section('name_page')
    Daftar Kategori Perias
@endsection
@section('page')
    Kategori
@endsection
@section('content')
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
    Tambah Kategori Perias
</button>
{{-- Data --}}
<div id="data">

</div>
{{-- Tambah Kategori Perias --}}
@include('admin/list/kategori_perias/tambah')

{{-- Detail Gambar Gaun --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentEditKatPerias">

    </div>
  </div>
</div>

{{-- Update Gaun --}}

@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/kategori_perias.js') }}"></script>
@endsection

