@extends('layouts.admin')
@section('name_page')
    Daftar Pengambilan Gaun
@endsection
@section('page')
    Pengambilan
@endsection
@section('content')

{{-- Data --}}
<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nomor Transksi</th>
          <th>Nama Gaun</th>
          <th>Client</th>
          <th>Sewa</th>
          <th>Status Pengambilan</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>
            <a href="#modalDetailGambar" data-toggle="modal" class="btn btn-success" onclick="">Nama</a>
          </td>
          <td>Win 95+</td>
          <td>Win 95+</td>
          <td> 4</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <th>No</th>
          <th>Nama Gaun</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th>Deskripsi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
</div>


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
<script>
  
  $(document).ready(function() {
    $('.custom-file-input').on('change', function() {
      var fileNames = '';
      Array.from(this.files).forEach(function(file) {
        fileNames += file.name + ', ';
      });
      fileNames = fileNames.slice(0, -2);
      $(this).next('.custom-file-label').html(fileNames);
    });
  });

  function getDetailGambar(id)
{
  // $.ajax({
  //   type:'POST',
  //   data:{'_token':'<?php echo csrf_token() ?>',
  //         'id':id
  //        },
  //   success: function(data){
  //      $('#modalContentDetailGambar').html(data.msg)
  //   }
  // });
}

</script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> 
@endsection

