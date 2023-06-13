<div class="modal-header">
    <h4 class="modal-title">Edit {{ $perias->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="FormEditPerias">
        <input type="hidden" name="data_edit_perias" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama</label>
          <input type="text" class="form-control" name="nama" value="{{ $perias->nama }}" placeholder="Masukan Nama">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Harga</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input type="number" name="harga" class="form-control" value="{{ $perias->harga }}"  placeholder="Masukan Harga" required>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" id="" rows="5">{{ $perias->deskripsi }}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Kategori Perias</label>
          <select name="kategori_perias" class="form-control">
              @foreach ($kategori_perias as $item)
              <option value="{{ $item->id }}" {{ $item->id == $perias->kategori_perias_id }}>{{ $item->nama }}</option>
              @endforeach
          </select> 
        </div>
       
    </form>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="updatePerias({{ $perias->id }})">Save changes</button>
  </div>