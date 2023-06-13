<div class="modal-header">
    <h4 class="modal-title">Hasil Rias - {{ $perias->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="FormEditKategoriPerias">
        <input type="hidden" name="data_kat_edit_perias" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama</label>
          <input type="text" value="{{ $katergoryPerias->nama }}" class="form-control" name="nama" placeholder="Masukan Nama">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Deskripsi</label>
          <textarea name="desc" class="form-control" rows="5">{{ $katergoryPerias->desc }}</textarea>
        </div>
    </form>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="editKategoriPerias({{ $katergoryPerias->id }})">Save changes</button>
  </div>
