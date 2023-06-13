@extends('layouts.client')
@section('content')
<div class="daftar_paket">
    <h3 class="p-2 text-body text-bold">Daftar Paket</h3>
    <div class="slider ">
        @for ($i = 0; $i < 10; $i++) <div class="m-2 rounded card">
            <img class="card-img-top" src="{{ asset('asset/login.png') }}" alt="Card image cap" width="150"
                height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">Nama Paket</h4>
                <h6 class="card-text text-bold">Rp. 6000000</h6>
            </div>


    </div>


    @endfor

</div>
<div class="rekomendasi_gaun">
    <h3 class="p-2 text-body text-bold">Rekomendasi Gaun</h3>
    <div class="slider ">

        @for ($i = 0; $i < 10; $i++) <div class="m-2 rounded card">
            <img class="card-img-top" src="{{ asset('asset/login.png') }}" alt="Card image cap" width="150"
                height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">Nama Dress</h4>
                <h6 class="card-text text-bold">Rp. 6000000</h6>
            </div>


    </div>


    @endfor

</div>

<div class="rekomendasi_perias">
    <h3 class="p-2 text-body text-bold">Rekomendasi Perias</h3>
    <div class="slider ">

        @for ($i = 0; $i < 10; $i++) <div class="m-2 rounded card">
            <img class="card-img-top" src="{{ asset('asset/login.png') }}" alt="Card image cap" width="150"
                height="200" style="object-fit: cover;">
            <div class="card-body">
                <h4 class="card-title text-bold">Nama Perias</h4>
                <h6 class="card-text text-bold">Rp. 6000000</h6>
            </div>


    </div>


    @endfor

</div>
@endsection

@section('js_client')
<script>
    $(document).ready(function() {
        $('.slider').slick({
            //   dots: true,
            //   autoplay: true,
            //   autoplaySpeed: 2500,

            slidesToShow: 4
            , slidesToScroll: 1
            , arrows: true
        });
    });

</script>

@endsection