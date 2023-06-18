{{-- Data --}}
<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Jumlah Gaun</th>
            <th>Jumlah Perias</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($data as $key => $item)
          <tr>
            <td>{{ $key+1  }}</td>
            <td>
              <a href="#modalDetailGambar" data-toggle="modal" class="btn btn-success" onclick="getDetailGambar({{$item->id}})">{{ $item->nama }}</a>
            </td>
            <td>{{ $item->desc }}</td>
            <td>{{ number_format($item->harga) }}</td>
            <td>{{ $item->jumlah_gaun }}</td>
            <td>{{ $item->jumlah_perias }}</td>
            <td>
              <a href="#modalEditPaket" data-toggle="modal" onclick="getEditForm({{ $item->id }})"  class="btn btn-success" ><i class="fa fa-pen"></i></a>
              <button class="btn btn-danger" onclick="hapusPaket({{ $item->id }},'{{ csrf_token() }}')"><i class="fa fa-trash"></i></button>
            </td>
          </tr> 
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Jumlah Gaun</th>
            <th>Jumlah Perias</th>
            <th>Aksi</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>