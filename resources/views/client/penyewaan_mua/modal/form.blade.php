<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Pemesanan Perias {{ $perias->nama }}</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col">
      <div class="">
        <img src="{{ asset('gambar/perias/' . $value->id . '/' . $value->hasil_rias[0]->id.'/'. $value->hasil_rias[0]->gambars[0]->nama_file) }}" class="product-image w-75" alt="Product Image">
      </div>
      <div class="product-image-thumbs">
          @foreach ($perias->hasil_rias as $key => $item)
            @foreach($item->gambars as $key2 => $value)
            <div class="w-75 product-image-thumb {{ $key == 0 ? 'active' : '' }}">
              <img src="{{ asset('gambar/perias/' . $perias->id . '/' . $item->id.'/'. $value->nama_file) }}"   alt="Gambar {{ $item->nama_rias  }}" >
            </div>
            @endforeach
          @endforeach
      </div>
    </div>
    <div class="col">
      <h3>Pemesanan Perias</h3>
      <hr>
      <h4>{{ $perias->nama }}</h4>
      <p>Rp. {{ number_format($perias->harga) }}</p>
      <div class="mt-4">
        <form id="FormPemesananGaun">

            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" name="nama" value="{{ Auth::user()->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Alamat</label>
              <textarea name="alamat" class="form-control" >{{ Auth::user()->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Telepon</label>
                <input type="number" name="telepon" value="{{ Auth::user()->telepon }}" class="form-control" id="exampleInputPassword1" placeholder="Masukan Nomor Telepon">
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Tanggal Sewa</label>
                    <input id="mulai_sewa_pemesanan" type="date" name="tanggal_sewa" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Jam Sewa</label>
                    <input id="jam_sewa_pemesanan" type="date" name="jam_sewa" class="form-control" required>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <h2>Rp. <span id="total_pemesanan_gaun">0</span></h2>
              <input type="hidden" id="total_input" name="total">
            </div>

        </form>

      </div>

    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-default text-white" onclick="submitPemesanan({{$gaun->id}})" style="background-color:#89375F">Pesan</button>
</div>

<script>
   $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
    $('#mulai_sewa_pemesanan, #akhir_sewa_pemesanan').on('change', function() {
      var harga_sewa = '{{$gaun->harga_sewa}}'
    // alert("masuk");
    var awal =  new Date($('#mulai_sewa_pemesanan').val())
    console.log(awal);
    var akhir =  new Date($('#akhir_sewa_pemesanan').val())
    console.log(akhir);
    var difference = akhir.getTime() - awal.getTime();
    var TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

    total_harga = parseInt(harga_sewa) * parseInt(TotalDays)
    $('#total_pemesanan_gaun').html(total_harga.toLocaleString())
    $('#total_input').val(total_harga)

    console.log(total_harga);
});
  })
</script>