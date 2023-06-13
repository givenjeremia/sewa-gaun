<div class="modal fade" id="modal-sm">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Jadwal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
        
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input type="date" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jam</label>
                <input type="time" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="" rows="5"></textarea>
              </div>   
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>