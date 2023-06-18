<h3 class="p-2 text-body text-bold">Rekomendasi Perias</h3>
<div class="slider ">
    @foreach($perias as $key => $value)
    <a href="#detailPerias" data-toggle="modal" onclick="getDetailPerias({{$value->id}})" class="text-dark">
        <div class="m-2 rounded card card-hover">
            <img class="card-img-top" src="{{ asset('gambar/perias/' . $value->id . '/' . $value->hasil_rias[0]->id.'/'. $value->hasil_rias[0]->gambars[0]->nama_file) }}" alt="Card image cap" width="150" height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">{{ $value->nama }}</h4>
                <h6 class="card-text text-bold">Rp. {{ number_format($value->harga) }}</h6>
            </div>
    
        </div>
    </a>
    @endforeach
</div>
