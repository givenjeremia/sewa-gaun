<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Perias</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="FormTambahPerias">
              <input type="hidden" name="data_tambah_perias" value="{{ csrf_token() }}">
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
                <label for="exampleInputFile">Kategori Perias</label>
                <select name="kategori_perias" class="form-control">
                    @foreach ($kategori_perias as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
              </div>
              {{-- Hasil Rias --}}
              <button type="button" class="btn btn-primary" onclick="tambahFormHasilRias()">Tambah Hasil Rias</button>
              <div id="hasil-rias" class="mt-2">

                <div id="form-hasil-rias_1" class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Hasil Rias 1</label>
                      <input type="text" class="form-control" name="nama_hasil_rias[]" placeholder="Masukan Nama Hasil Rias">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Gambar Rias 1</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="input_file_1" name="gambar[]" id="exampleInputFile"  multiple="multiple">
                          <label class="custom-file-label" id="name_input_file_1" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>

              {{-- <div class="form-group">
                <label for="exampleInputFile">Gambar Max 2 MB</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile"  multiple="multiple">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
              </div> --}}
             
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="tambahPerias()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>