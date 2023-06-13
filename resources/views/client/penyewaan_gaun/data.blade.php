<div class="row">
    @foreach($gaun as $item)
    <div class="col-md-3 ">
        <a href="#detailGaun" data-toggle="modal" onclick="getDetailGaun({{$item->id}})">
            <div class="card rounded card-hover">
                {{-- rand(0,$item->gambars->count()-1) --}}
                <img class="card-img-top" src="{{ asset('gambar/gaun/'.$item->id.'/'.$item->gambars[rand(0,$item->gambars->count()-1)]->nama_file) }}" alt="Card image cap" width="150" height="200" style="object-fit: cover;">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-truncate">
                            <h4 class="card-title text-dark text-bold">{{ $item->nama }} </h4>
                            <h6 class="card-text text-gray text-bold">Rp. {{ number_format($item->harga_sewa) }}</h6>
                        </div>
                        <div class="col text-truncate ">
                                    @php
                                        $data = $item->jadwal()->where('tanggal_waktu', 'like', $date_now.'%')->get();
                                    @endphp
                            <div class="text-center" style="border-radius:60px;background-color:#F3E8FF;">
                                <small class="pr-1 pl-1 text-bold " style="color:#89375F;">
                                    @if ($data->count() > 0)
                                        Not Available Now
                                    @else
                                        Available
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
{{ $gaun->links('pagination::bootstrap-4') }}
