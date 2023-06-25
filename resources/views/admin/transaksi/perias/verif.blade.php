<div class="modal-header">
    <h4 class="modal-title">Verifikasi Pembayaran {{ $pembayaran->nomor_pembayaran }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <h4>Bukti Pembayaran</h4>
 
    <img src="{{ asset('transaksi/perias/'.$pembayaran->id.'/'.$pembayaran->gambar_pembayaran[0]->nama_file) }}" width="50%">
    <hr>
    <h4>Verifikasi Pembayaran</h4>
    <select class="form-control" id="status_option" name="status_option" >
        @foreach ([ 0 => 'Belum Di Verifikasi', 1 => 'Sudah Di Verifikasi'] as $key => $Label)
        <option value="{{ $key }}" {{ $pembayaran->status_pembayaran == $key ? 'selected' : '' }}>{{ $Label }}</option>
        @endforeach
    </select>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitVerif({{ $pembayaran->id }})">Verif</button>
  </div>