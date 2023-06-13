@extends('layouts.client')

@section('content')
<h2 class="text-center display-4 custom-text-primary-poppins text-bold">Mackup Artis</h2>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="simple-results.html">
            <div class="input-group">
                <input type="search" class="form-control form-control-lg" placeholder="Cari Mackup Artis">
            </div>
        </form>
    </div>
</div>

<div class="m-4">
    <div class="row">
        @for ($i = 0; $i < 10; $i++)
            
        <div class="col-md-3">
            <div class="card rounded">

                <img class="card-img-top" src="{{ asset('asset/login.png') }}" alt="Card image cap" width="150"
                        height="200" style="object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title text-bold">Nama Gaun</h4>
                        <h5 class="card-text text-bold">Rp. 6000000</h5>
                        <h6 class="card-text text-bold">( Wedding ) Status</h6>
                    </div>
            </div>
        </div>
        @endfor
    </div>
    
</div>



@endsection

