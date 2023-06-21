@extends('layouts.admin')
@section('name_page')
    Daftar Transaksi {{ $title }}
@endsection
@section('page')
    Transaksi
@endsection
@section('content')

{{-- Data --}}
<div class="data"></div>


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

