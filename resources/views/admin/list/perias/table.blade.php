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
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <a href="#modalHasilRias" data-toggle="modal" class="btn btn-success" onclick="getDetailGambar({{ $item->id }})">{{$item->nama }}</a>
                        </td>
                        <td>{{ number_format($item->harga) }}</td>
                        <td>{{ $item->kategori_perias->nama }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a href="#modalEditPerias" data-toggle="modal" onclick="getEditForm({{ $item->id }})"
                                class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger"
                                onclick="hapusPerias({{ $item->id }},'{{ csrf_token() }}')"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>