@extends('layouts.admin')
@section('name_page')
    Daftar Perias
@endsection
@section('page')
    Perias
@endsection
@section('content')
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
    Tambah Perias
</button>
{{-- Data --}}
<div id="data">

</div>
{{-- Tambah Perias --}}
@include('admin/list/perias/tambah')

{{-- Detail Hasil Perias --}}
<div class="modal fade" id="modalHasilRias" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentDetailGambar">

    </div>
  </div>
</div>

{{-- Update Perias --}}
<div class="modal fade" id="modalEditPerias" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContentEditPerias">

    </div>
  </div>
</div>

@endsection

@section('js_admin')
<script src="{{ asset('js/admin_js/perias.js') }}"></script>
@endsection

