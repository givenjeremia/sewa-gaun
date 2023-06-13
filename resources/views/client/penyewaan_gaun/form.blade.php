@extends('layouts.client')
@section('content')
<div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
          <div class="col-12">
            <img src="../../dist/img/prod-1.jpg" class="product-image" alt="Product Image">
          </div>
          <div class="col-12 product-image-thumbs">
            <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
            <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
            <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
            <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
            <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="my-3">Pemesanan Gaun</h3>
          <hr>
          <h4>Nama Gaun</h4>
          <p>Rp. 000000</p>
          <div class="mt-4">
            <form>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat</label>
                  <textarea name="alamat" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telepon</label>
                    <input type="number" name="telepon" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Request Remake</label>
                    <textarea name="request_remake" class="form-control" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Mulai Sewa</label>
                        <input type="date" name="akhir_sewa" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Akhir Sewa</label>
                        <input type="date" name="akhir_sewa" class="form-control" required>
                      </div>
                    </div>
                </div>
  
        
              <button class="btn btn-primary btn-lg btn-flat rounded">
                Pesan
              </button>
            </form>

          </div>

        </div>
      </div>
     
    </div>
    <!-- /.card-body -->
  </div>
@endsection