<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori Gaun</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="FormTambahKategoriGaun">
            <input type="hidden" name="data_kat_gaun" value="{{ csrf_token() }}">

              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Deskripsi</label>
                <textarea name="desc" class="form-control" rows="5"></textarea>
              </div>
              
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="tambahKategoriPerias()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>