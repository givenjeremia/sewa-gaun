<div class="modal fade" id="modal-lg" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Profile</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="detail mt-2">
                <ul class="nav nav-tabs" id="myTabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#tab1">Data</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#tab2">Password</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <form class="mt-2" id="changeProfileDataForm">
                            @csrf
                            <div class="form mb-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ auth::user()->nama }}" placeholder="Masukan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" name="username" value="{{ auth::user()->username }}" placeholder="Masukan Username">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <textarea class="form-control" name="alamat">{{ auth::user()->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telepon</label>
                                    <input type="number" class="form-control" name="telepon" value="{{ auth::user()->telepon }}" placeholder="Masukan Nama">
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
                            <button id="updateProfileData" type="button" class="btn btn-primary" >Simpan Data</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <form class="mt-2" id="changeProfilePasswordForm">
                            @csrf
                            <div class="form mb-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password Lama</label>
                                    <input type="password" class="form-control" name="password_lama" placeholder="Masukan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" placeholder="Masukan Nama">
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" id="btnclosetambah" data-dismiss="modal">Close</button>
                            <button id="updateProfilePassword" type="button" class="btn btn-primary" >Ubah Password</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>