

<div class="row">
    @foreach($data as $key => $value)
    <div class="col-md-3 ">
        <a href="#detailPaket" data-toggle="modal" onclick="getDetailPaket({{ $value->id }})" class="text-dark">
            <div class="m-2 rounded card card-hover">
                <img class="card-img-top" src="{{ asset('gambar/paket/'.$value->id.'/'.$value->gambars[0]->file_name) }}" alt="Card image cap" width="150" height="200" style="object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-bold">{{ $value->nama }}</h4>
                    <h6 class="card-text text-bold">Rp. {{ number_format($value->harga) }}</h6>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
{{ $data->links('pagination::bootstrap-4') }}
