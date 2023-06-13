<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Nomor Pemesanan {{ $pemesananGaun->nomor_pemesanan }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <h4>Data Pemesanan</h4>
    <div class="table-responsive">
        <table id="TransaksiPemesananGaun" class="table">
            <tr>
                <td>
                    Nama
                </td>
                <td>
                    Telepon
                </td>
                <td>
                    Alamat
                </td>
            </tr>
            <tr>
                <td>
                    {{ $pemesananGaun->nama }}
                </td>
                <td>
                    {{ $pemesananGaun->telepon }}
                </td>
                <td>
                    {{ $pemesananGaun->alamat }}
                </td>
            </tr>
        </table>
    </div>
    <h4 class="mt-2">Jenis Gaun</h4>
    <div class="table-responsive">
        <table id="TransaksiPemesananGaun" class="table">
            <tr>
                <td width="15%">
                    Nama
                </td>
                <td>
                    Harga Sewa
                </td>
            </tr>
            @foreach ($pemesananGaun->gaun as $item)
            <tr>
                <td width="15%">
                    {{ $item->nama }}
                </td>
                <td>
                    Rp. {{ number_format($item->harga_sewa) }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <h4 class="mt-2">Keterangan</h4>
    <div class="table-responsive">
        <table id="TransaksiPemesananGaun" class="table">
            <tr>
                <td>
                    Mulai Sewa
                </td>
                <td>
                    Akhir Sewa
                </td>
                <td>
                    Total
                </td>
            </tr>
            <tr>
                <td>
                    {{ $pemesananGaun->mulai_sewa }} 
                </td>
                <td>
                    {{ $pemesananGaun->akhir_sewa }} 
                </td>
                <td>
                    Rp. {{ number_format($pemesananGaun->total_pembayaran) }}
                </td>
            </tr>
        </table>
    </div>
    <form id="FormPemesananTransaksi">
        <div class="row mb-2">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input rdo-pembayaran" value="1" type="radio" onchange="rdoPembayaran()" name="flexRadioDefault" id="lunas">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Lunas
                    </label>
                  </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input rdo-pembayaran" value="0" type="radio" onchange="rdoPembayaran()" name="flexRadioDefault" id="tidak_lunas">
                    <label class="form-check-label" for="flexRadioDefault2">
                      Tidak Lunas
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Bukti Pembayaran (Max 2 MB)</label>
            <input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran">
            
        </div>
        <input type="hidden" value="{{ $pemesananGaun->total_pembayaran }}" name="total_pembayaran" id="total_pembayaran">
        <div id="data_tidak_lunas">
        </div>
       
          
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-default text-white" onclick="submitPembayaran({{$pemesananGaun->id}})" style="background-color:#89375F">Bayar</button>
</div>
<script >
  
</script>
