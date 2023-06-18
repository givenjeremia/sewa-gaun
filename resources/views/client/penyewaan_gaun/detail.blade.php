<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">{{ $gaun->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <!-- Carousel items -->
        <div class="carousel-inner">
            @foreach ($gaun->gambars as $key => $item)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img class="d-block mx-auto" src="{{ asset('gambar/gaun/'.$gaun->id.'/'.$item->nama_file) }}" alt="Gambar {{ $key+1 }}" width="30%">
            </div>
            @endforeach

        </div>
        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="detail mt-2">
        <div class="table-responsive">
            <table id="gambar_gaun_tabel" class="table">
                <tr>
                    <td width="15%">
                        Harga Sewa
                    </td>
                    <td>:</td>
                    <td>
                        <span class=" text-gray">Rp {{ number_format($gaun->harga_sewa) }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Deskripsi
                    </td>
                    <td>:</td>
                    <td>
                        <p class="text-justify">{{ $gaun->deskripsi }}</p>
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
    <button type="button" class="btn btn-default text-white" onclick="getPemesananForm({{$gaun->id,'gaun'}})" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Sewa</button>
</div>
