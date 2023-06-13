@extends('layouts.app')

@section('content')
<div class="login-page bg-transparent">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body rounded" style="background-color:#F3E8FF">
            <h4 class="login-box-msg text-dark">Masuk Ke Millenimua</h4>
      
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="input-group mb-3">
                <input id="email" type="email" name="email" class="form-control" placeholder="Masukan Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope fa-"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input id="password" type="password" name="password" class="form-control" placeholder="Masukan Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
    
              <div>
                <button type="submit" class="btn btn-primary border-0 btn-block" style="background-color:#89375F">Sign In</button>
              </div>
            </form>
      
            <div class="mb-0 pt-2 d-flex  justify-content-center">
                <p>Belum Punya Akun ? </p>
              <a href="{{ route('register') }}" class="" style="color:#89375F"> Daftar Disini </a>
            </div>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div> 
</div>

@endsection
