<div class="modal fade" id="modal-lg" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Paket</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="FormTambahPaket">
              <input type="hidden" name="data_paket" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Harga</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" name="harga" class="form-control"  placeholder="Masukan Harga" required>
                </div>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="" rows="5"></textarea>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Jumlah Gaun</label>
                <input type="number" name="jumlah_gaun" class="form-control"  placeholder="Masukan Jumlah Gaun" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Jumlah Perias</label>
                <input type="number" name="jumlah_perias" class="form-control"  placeholder="Masukan Jumlah Perias" required>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Gambar Max 2 MB</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="gambar[]" class="custom-file-input" id="exampleInputFile"  multiple="multiple">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
              </div>
              
            
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="tambahPaket()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>