@extends('layouts.LTE')


@section('contents')

{{-- <!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> --}}

<nav class="main-header navbar navbar-expand-md navbar-light" style="background-color:#F3E8FF;">
  <div class="container">
    <a href="/" class="navbar-brand">
  
      <span class="brand-text font-weight-light">{{ "Milenium" }}</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        @if (Auth::user()->roles == 0 || Auth::user()->roles == 1) 
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Gaun</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
         
            <li><a href="{{url('admin/gaun')}}" class="dropdown-item">Data</a></li>
            <li><a href="{{url('admin/kategory-gaun')}}" class="dropdown-item">Kategori</a></li>
            <li><a href="{{url('admin/jadwals/gaun')}}" class="dropdown-item">Jadwal</a></li>
          </ul>
        </li>
        @endif
   
        @if (Auth::user()->roles == 0 || Auth::user()->roles == 2) 
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Perias</a>
          <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('admin/perias')}}" class="dropdown-item">Data</a></li>
            <li><a href="{{url('admin/kategory-perias')}}" class="dropdown-item">Kategori</a></li>
            <li><a href="{{url('admin/jadwals/perias')}}" class="dropdown-item">Jadwal</a></li>
          </ul>
        </li>
        @endif

        @if (Auth::user()->roles == 0) 
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Paket</a>
          <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('admin/paket')}}" class="dropdown-item">Data</a></li>
            <li><a href="{{url('admin/transaksi-paket')}}" class="dropdown-item">Transaksi</a></li>
          </ul>
        </li>
        @endif

        {{-- Role Gaun --}}
        @if (Auth::user()->roles == 0 || Auth::user()->roles == 1)      
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Transaksi Gaun</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('admin/transaksi-gaun')}}" class="dropdown-item">Penyewaan</a></li>
            <li><a href="{{url('admin/pengambilan-gaun')}}" class="dropdown-item">Pengambilan</a></li>
            <li><a href="{{url('admin/pengembalian-gaun')}}" class="dropdown-item">Pengembalian</a></li>
          </ul>
        </li>
        @endif

        {{-- Role Perias --}}
        @if (Auth::user()->roles == 0 || Auth::user()->roles == 2)       
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Transaksi Perias</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('admin/transaksi-perias')}}" class="dropdown-item">Pemesanan</a></li>
          </ul>
        </li>
        @endif
       
       
        
      </ul>

    </div>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle"></i> {{Auth::user()->nama}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">My Profile</span>
          <div class="dropdown-divider"></div>
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
    </ul>
  </div>
</nav>
<div class="content-wrapper">
  <div class="container-fluid pr-5 pl-5 pt-3">
    <div class="content">

      @yield('content')
    </div>
  </div>
</div>

@endsection

@section('js')
@yield('js_admin')
@endsection