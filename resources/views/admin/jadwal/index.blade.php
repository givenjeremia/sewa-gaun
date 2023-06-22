@extends('layouts.admin')

@section('name_page')
    Jadwal {{ $role }}
@endsection
@section('page')
    Jadwal
@endsection

@section('content')
{{-- Cek Auth Login Role --}}
{{-- jika gaun tampilkan gaun jika tidak tampilkan perias --}}



<div class="row ">
    <div class="col">

        <div class="form-group">
            <input type="hidden" id="jenis" value="{{ $role }}">
            <input type="month" id="sort_by" class="form-control" name="sort_by" required>
        </div>

    </div>
    <div class="col">
        <div class="form-group">
            {{-- <p></p> --}}
            <div></div>
            <button type="button" id="btncari" class="btn btn-primary ">Cari</button>
            <div></div>
        </div>
    </div>
    <div class="col">   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm">
            Tambah Jadwal
        </button>
    </div>
</div>

@if ($role == 'Perias')
<div id="table-perias">
    @include('admin/jadwal/perias')
</div>
@else
<div id="table-gaun">
    @include('admin/jadwal/gaun')
</div>
@endif



<br>

{{-- <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog" role="document">
      <div class="modal-content" id="modalContentDetail">
       
      </div>
    </div>
</div> --}}


<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" id="modalContentDetail">
       
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@include('admin/jadwal/tambah')

@endsection

@section('js_admin')
@section('js_admin')
<script src="{{ asset('js/admin_js/jadwal.js') }}"></script>
@endsection
@endsection

