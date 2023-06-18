<h3 class="p-2 text-body text-bold">Rekomendasi Gaun</h3>
<div class="slider ">
    @foreach($gaun as $key => $value)
    <a href="#detailGaun" data-toggle="modal" onclick="getDetailGaun({{ $value->id }})" class="text-dark">
        <div class="m-2 rounded card card-hover">
            <img class="card-img-top" src="{{ asset('gambar/gaun/'.$value->id.'/'.$value->gambars[rand(0,$value->gambars->count()-1)]->nama_file) }}" alt="Card image cap" width="150" height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">{{ $value->nama }}</h4>
                <h6 class="card-text text-bold">Rp. {{ number_format($value->harga_sewa) }}</h6>
            </div>
        </div>
    </a>
    @endforeach
</div>
