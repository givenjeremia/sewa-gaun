<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Nomor Pemesanan : {{ $pemesanan->nomor_pemesanan }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="detail mt-2">
        <div class="table-responsive">
            <table id="gambar_gaun_tabel" class="table">
                <tr>
                    <td width="15%">
                        Nama Gaun
                    </td>
                    <td>:</td>
                    <td width="100%">
                        @foreach ($pemesanan->gaun as $item)
                        <li class="text-start">
                            {{ $item->nama }} ( Rp. {{ $item->harga_sewa }} )
                        </li>
                        @endforeach
                    </td>
                    
                </tr>
                <tr>
                    <td width="15%">
                        Nama Perias
                    </td>
                    <td>:</td>
                    <td width="100%">
                        @foreach ($pemesanan->perias as $item)
                        <li class="text-start">
                            {{ $item->nama }} ( Rp. {{ $item->harga }} )
                        </li>
                        @endforeach
                    </td>
                    
                </tr>
               
                <tr>
                    <td width="15%">
                        Jam Event
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">{{ $pemesanan->waktu_event }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Tanggal Event
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">{{ $pemesanan->tanggal_event }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Total Pembayaran
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">Rp. {{ number_format($pemesanan->total_pembayaran) }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Status
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">{{ $list_status[$pemesanan->status_pembayaran] }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button id="btn-close-detail" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    @php
        $auth_check = Auth::user() ? Auth::user() : false;
    @endphp
    @if ($pemesanan->status_pembayaran == 1)
        <button type="button" class="btn btn-default text-white " onclick="batalTransaksi({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Batal</button>
        <button type="button" class="btn btn-default text-white" onclick="getPemesananFormPaket({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Bayar</button>
    @elseif($pemesanan->status_pembayaran == 2)
        <button type="button" class="btn btn-default text-white" onclick="getReviewForm({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Review</button>
    @else
        
    @endif
</div>
