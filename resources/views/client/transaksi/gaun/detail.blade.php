<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Nomor Pemasanan : {{ $pemesanan->nomor_pemesanan }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="detail mt-2">
        <div class="table-responsive">
            <table id="gambar_gaun_tabel" class="table">
                <tr>
                    @foreach ($pemesanan->gaun as $item)
                    <td width="15%">
                        Nama Gaun
                    </td>
                    <td>:</td>
                    <td width="100%">
                        <span class=" text-start">{{ $item->nama }} ( Rp. {{ $item->harga_sewa }} )</span>
                    </td>
                    @endforeach
                </tr>
                <tr>
                    <td width="15%">
                        Mulai Sewa
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">{{ $pemesanan->mulai_sewa }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Akhir Sewa
                    </td>
                    <td>:</td>
                    <td>
                        <p class=" text-start">{{ $pemesanan->akhir_sewa }}</p>
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
                        <p class=" text-start">{{ $list_status[$pemesanan->status] }}</p>
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
    @if ($pemesanan->status == 1)
        <button type="button" class="btn btn-default text-white" onclick="getPembayaranForm({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Bayar</button>
    @elseif($pemesanan->status == 2)
        <button type="button" class="btn btn-default text-white" onclick="getKomplainForm({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Komplain</button>
        <button type="button" class="btn btn-default text-white" onclick="getReviewForm({{$pemesanan->id}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Review</button>
        <a href="{{ url('/gaun-invoice/'.$pemesanan->id) }}" type="button" class="btn btn-default text-white" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Cetak Invoice</a>

    @else
        
    @endif
</div>
