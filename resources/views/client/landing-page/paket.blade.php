<h3 class="p-2 text-body text-bold">Daftar Paket</h3>
<div class="slider ">
    @foreach($paket as $key => $value)
    <a href="#detailPaket" data-toggle="modal" onclick="getDetailPaket({{ $value->id }})" class="text-dark">
        <div class="m-2 rounded card card-hover">
            <img class="card-img-top" src="{{ asset('gambar/paket/'.$value->id.'/'.$value->gambars[0]->file_name) }}" alt="Card image cap" width="150" height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">{{ $value->nama }}</h4>
                <h6 class="card-text text-bold">Rp. {{ number_format($value->harga) }}</h6>
            </div>
        </div>
    </a>
    @endforeach
</div>




