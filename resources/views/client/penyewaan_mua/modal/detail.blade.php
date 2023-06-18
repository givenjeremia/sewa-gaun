<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">{{ $perias->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <!-- Carousel items -->
        <div class="carousel-inner">
            @foreach ($perias->hasil_rias as $key => $item)
            @foreach($item->gambars as $key2 => $value)
                
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img class="d-block mx-auto" src="{{ asset('gambar/perias/' . $perias->id . '/' . $item->id.'/'. $value->nama_file) }}"   alt="Gambar {{ $item->nama_rias  }}" width="30%">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $item->nama_rias }}</h5>
                </div>
            </div>
            @endforeach
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
                        <span class=" text-gray">Rp {{ number_format($perias->harga) }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="15%">
                        Deskripsi
                    </td>
                    <td>:</td>
                    <td>
                        <p class="text-justify">{{ $perias->deskripsi }}</p>
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
    <button type="button" class="btn btn-default text-white" onclick="getPemesananForm({{$perias->id}},'perias')" style="background-color:#89375F" {{ Auth::user() ? '' : 'disabled' }} >Sewa</button>
</div>
