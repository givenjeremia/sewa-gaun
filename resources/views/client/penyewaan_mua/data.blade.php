<div class="row mr-2">
    @foreach($perias as $key => $value)
    <div class="col-md-3">
        <a href="#detailPerias" class="text-dark" data-toggle="modal" onclick="getDetailPerias({{$value->id}})">
        <div class="card rounded card-hover">
            <img class="card-img-top" src="{{ asset('gambar/perias/' . $value->id . '/' . $value->hasil_rias[0]->id.'/'. $value->hasil_rias[0]->gambars[0]->nama_file) }}"   alt="Card image cap" width="150" height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">{{ $value->nama }}</h4>
                <h5 class="card-text text-bold">Rp. {{ number_format($value->harga) }}</h5>
                <span class="badge badge-secondary">{{ $value->kategori_perias->nama }}</span>
                {{-- <h6 class="card-text"> </h6> --}}
            </div>
        </div>
        </a>
    </div>
        
    @endforeach
</div>
{{ $perias->links('pagination::bootstrap-4') }}