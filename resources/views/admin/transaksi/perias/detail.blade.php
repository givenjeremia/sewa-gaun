<div class="modal-header">
    <h4 class="modal-title">Detail Pembayaran {{ $pembayaran->nomor_pembayaran }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#tab1">Detail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab2">Komplain</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1">
            <div class="table-responsive">
                <table id="gambar_gaun_tabel" class="table">
                    <tr>
                        <td width="5%">
                            Client
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            Nama
                        </td>
                        <td width="5%">:</td>
                        <td>
                            <span class=" text-gray">{{ $pembayaran->pemesanan->nama }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            Alamat
                        </td>
                        <td>:</td>
                        <td>
                            {{ $pembayaran->pemesanan->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            Telepon
                        </td>
                        <td>:</td>
                        <td>
                            {{ $pembayaran->pemesanan->telepon }}
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="tab2">
            <div class="table-responsive mt-2">
                <table id="gambar_gaun_tabel" class="table">
                    @if (count($komplain) > 0  )
                    <tr>
                        <td>
                            <h4>Komplain</h4>
                        </td>
                    </tr>
                    <tr>
                    @foreach ($komplain as $item)
                  
                    <tr>
                        <td width="15%">
                            Jenis
                        </td>
                        <td width="5%">:</td>
                        <td>
                            <span class=" text-gray">{{ $item->jenis_komplain }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            Keterangan
                        </td>
                        <td width="5%">:</td>
                        <td>
                            <span class=" text-gray">{{ $item->keterangan }}</span>
                        </td>
                    </tr> 
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <h4>Belum Ada Komplain</h4>
                        </td>
                    </tr>
                    @endif
                    @if (count($rating_review) > 0 )
                    
                    <tr>
                        <td>
                            <h4>Review</h4>
                        </td>
                    </tr>
                    @foreach ($rating_review as $item)
                    <tr>
                        <td width="15%">
                            Rating
                        </td>
                        <td width="5%">:</td>
                        <td>
                            <span class=" text-gray">{{ $item->bintang }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            Review
                        </td>
                        <td width="5%">:</td>
                        <td>
                            <span class=" text-gray">{{ $item->review }}</span>
                        </td>
                    </tr> 
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <h4>Belum Ada Rating Review</h4>
                        </td>
                    </tr>
                    @endif
                    



                </table>
            </div>
        </div>
      </div>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
  </div>