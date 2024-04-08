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
          <form id="FormTambahJadwal">
            <input type="hidden" value="{{ csrf_token() }}" name="data_page_tambah_jadwal">
            @if($role == 'gaun')
            <div class="form-group">
              <label for="exampleInputEmail1">Gaun</label>
              <select name="gaun" class="form-control">
                @foreach($gaun as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
            @else
            <div class="form-group">
              <label for="exampleInputEmail1">Perias</label>
              <select name="perias" class="form-control">
                @foreach($perias as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
            @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jam</label>
                <input type="time" class="form-control" name="jam" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="" rows="5"></textarea>
              </div>   
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="tambahJadwal('{{ $role }}')">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>