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
@include('admin/jadwal/perias')
@else
@include('admin/jadwal/gaun')
@endif



<br>

@include('admin/jadwal/tambah')

@endsection

@section('js_admin')
<script>
</script>
@endsection

