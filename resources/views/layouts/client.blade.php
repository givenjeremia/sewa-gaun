@extends('layouts.LTE')


@section('contents')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <div class="spinner-border" role="status">
        <span class="visually-hidden"></span>
    </div>
</div>


{{-- Nav --}}
<nav class="navbar navbar-expand navbar-light">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/')}}">
                <div class=" p-2" style="border-radius:60px;background-color:#F3E8FF;">

                    <h5 class=" pr-3 pl-3 card-text text-bold" style="font-family: 'Italianno';color:#89375F;font-size: 25px;">Millenimua</h5>
                </div>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('penyewaan-gaun') }}" class="nav-link text-bold  {{ Request::is('penyewaan-gaun') ? 'active' : '' }} ">Persewaan Gaun</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('penyewaan-mua') }}" class="nav-link text-bold {{ Request::is('penyewaan-mua') ? 'active' : '' }} ">Makeup Artis</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('list-jadwal') }}" class="nav-link text-bold {{ Request::is('list-jadwal') ? 'active' : '' }} ">Jadwal</a>
        </li>
        
        @if (Auth::user())
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-bold dropdown-toggle">Transaksi</a>
            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                <li><a href="{{url('transaksi-gaun')}}" class="dropdown-item">Gaun</a></li>
                <li><a href="{{url('transaksi-perias')}}" class="dropdown-item">Perias</a></li>
                <li><a href="{{url('transaksi-paket')}}" class="dropdown-item">Paket</a></li>

            </ul>
        </li>
        @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        @if (Auth::user())
        <li class="nav-item dropdown ">
            <a class="nav-link " data-toggle="dropdown" href="#">
                <i class="far fa-user-circle"></i> {{Auth::user()->nama}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">My Profile</span>
                <div class="dropdown-divider"></div>
                <a href="#" data-toggle="modal" data-target="#modal-lg" class="dropdown-item">
                    Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="dropdown-item">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                {{-- <div class="dropdown-divider"></div>
              @if(auth()->user()->can('setting-web'))
              <a href="{{url('backend/web-setting')}}" class="dropdown-item">
                Web Setting
                </a>
                @endif --}}
            </div>
        </li>

        @else

        <li class="nav-item d-none d-sm-inline-block mx-2">
            <a href="{{ route('login') }}">
                <div class=" p-2" style="border-radius:60px;background-color:#89375F;">

                    <h5 class=" pr-3 pl-3 card-text text-bold" style="color:#F3E8FF;">Login</h5>
                </div>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('register') }}">
                <div class=" p-2" style="border-radius:60px;background-color:#F3E8FF;">

                    <h5 class=" pr-3 pl-3 card-text text-bold" style="color:#89375F;">Register</h5>
                </div>
            </a>
        </li>
        @endif

    </ul>

</nav>





<div class="container-fluid m-2">
    @yield('content')
</div>

{{-- Tambah Gaun --}}
@include('client/profile/update')

@endsection

@section('js')
<script>
    $('#updateProfileData').on('click', function(){
        var form = document.querySelector('#changeProfileDataForm');
        // var form = $('')
        var form_data = new FormData(form);
        var url = '/update-profile-data'
        $.ajax({
            type: 'POST',
            url: url,
            data: form_data, 
            dataType: "json", 
            contentType: false,
            processData: false, 
            success: function (data) {
                if (data.status === "success") {
                    Swal.fire({
                        title: "Success",
                        text: data.msg,
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        window.location.href = "/";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: data.msg,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            }
        });
    })
    $('#updateProfilePassword').on('click', function(){
        var form = document.querySelector('#changeProfilePasswordForm');
        var form_data = new FormData(form);
        var url = '/update-profile-password'
        $.ajax({
            type: 'POST',
            url: url,
            data: form_data, 
            dataType: "json", 
            contentType: false,
            processData: false, 
            success: function (data) {
                if(data.status == 'success'){
                    Swal.fire({
                        title: "Success",
                        text: data.msg,
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        window.location.href = "/";
                    });
                }
                else{
                    Swal.fire({
                        title: "Error",
                        text: data.msg,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            }
        });
    })
</script>
@yield('js_client')
@endsection
