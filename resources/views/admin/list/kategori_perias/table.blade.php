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
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $key => $item)
            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->desc }}</td>
              <td>
                <a href="#modalEdit" data-toggle="modal" onclick="getEditForm({{ $item->id }})"  class="btn btn-success" ><i class="fa fa-edit"></i></a>
                <button class="btn btn-danger" onclick="hapusKategoriPerias({{ $item->id }},'{{ csrf_token() }}')"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>