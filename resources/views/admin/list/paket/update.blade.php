<div class="modal-header">
    <h4 class="modal-title">Edit Paket {{ $paket->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="FormEditPaket">
        <input type="hidden" name="data_paket_edit" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $paket->nama }}" placeholder="Masukan Nama">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Harga</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="number" value="{{ $paket->harga }}" name="harga" class="form-control"
                    placeholder="Masukan Harga" required>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Deskripsi</label>
            <textarea name="deskripsi" name="deskripsi" class="form-control" id=""
                rows="5">{{ $paket->desc }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Jumlah Gaun</label>
            <input type="number" value="{{ $paket->jumlah_gaun }}" name="jumlah_gaun" class="form-control" placeholder="Masukan Jumlah Gaun" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Jumlah Perias</label>
            <input type="number" value="{{ $paket->jumlah_perias }}" name="jumlah_perias" class="form-control" placeholder="Masukan Jumlah Perias" required>
        </div>

    </form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="updatePaket({{ $paket->id }})">Save changes</button>
</div>