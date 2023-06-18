@foreach ($pemesananPaket as $item)
<a href="#detailTransaksi" data-toggle="modal" onclick="detailTransaksiPemesananPaket({{ $item->id }})">
<div class="card text-dark">
    <div class="card-header text-bold">
      Nomor Transaksi Pemesanan {{ $item->nomor_pemesanan }}
    </div>
    <div class="card-body">
        <h5 class="text-bold">Nama Paket : {{ $item->paket->nama }}</h5>
        {{-- <br> --}}
        <div class="row">
    
        <div class="col">
            <p class="card-text">
                Tanggal Event : {{ $item->tanggal_event }}
            </p>
            <p class="card-text">
                Jam Event : {{ $item->waktu_event }}
            </p>
        </div>
        <div class="col">
            <p class="card-text">
                Status : {{ $list_status[$item->status_pembayaran] }}
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
