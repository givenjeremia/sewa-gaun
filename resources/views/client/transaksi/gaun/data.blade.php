@foreach ($pemesananGaun as $item)
<a href="#detailTransaksi" data-toggle="modal" onclick="detailTransaksiPemesananGaun({{ $item->id }})">
<div class="card text-dark">
    <div class="card-header text-bold">
      Nomor Transaksi Pemesanan {{ $item->nomor_pemesanan }}
    </div>
    <div class="card-body">
        @if (count($item->gaun) == 1)
        <h5 class="text-bold">Nama Gaun : {{ $item->gaun[0]->nama }}</h5>
        @else
        <table>
            <tr>
                <td>Nama Gaun :</td>
                <td>
                    <ul>
                        @foreach ($item->gaun as $gaun)
                        <li>{{ $gaun->nama }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>
        {{-- <h5 class="text-bold">Nama Gaun : {{ $item->gaun }}</h5> --}}
        @endif
        {{-- <br> --}}
        <div class="row">
    
        <div class="col">
            <p class="card-text">
                Mulai Sewa : {{ $item->mulai_sewa }}
            </p>
            <p class="card-text">
                Akhir Sewa : {{ $item->akhir_sewa }}
            </p>
        </div>
        <div class="col">
            <p class="card-text">
                Status : {{ $list_status[$item->status] }}
            </p>
            <p class="card-text">
                Total Pembayaran : Rp. {{ number_format($item->total_pembayaran) }}
            </p>
        </div>
        <br>
        {{-- Jika Sudah Melakukan Pembayaran Tambil --}}
      </div>
    </div>

</div>
</a>
@endforeach
<div id="pagination">

</div>
{{-- {{ $pagination }} --}}
{{-- {{ $pemesananGaun->render('pagination::bootstrap-4') }} --}}

{{-- {{ $pemesananGaun->links('pagination::bootstrap-4') }} --}}
