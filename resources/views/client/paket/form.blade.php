<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Pemesanan Paket {{ $paket->nama }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="FormPemesananPaket">
    <div class="row">
            <div class="col me-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" value="{{ Auth::user()->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea name="alamat" class="form-control">{{ Auth::user()->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telepon</label>
                    <input type="number" name="telepon" value="{{ Auth::user()->telp }}" class="form-control" id="exampleInputPassword1" placeholder="Masukan Nomor Telepon">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input id="mulai_sewa_pemesanan" type="date" name="tanggal_event" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jam</label>
                            <input id="jam_sewa_pemesanan" type="time" name="jam_event" class="form-control" required>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col me-2">
                <h3>Pemesanan Paket</h3>
                <hr>
                <h4>{{ $paket->nama }}</h4>
                <p>Rp. {{ number_format($paket->harga) }}</p>
                <input type="hidden" id="total_input" value="{{ $paket->harga }}" name="total">
                <div class="mt-4">
                    <h4>Gaun</h4>
                    @for($i = 0; $i < $paket->jumlah_gaun ; $i++)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Gaun {{ $i+1 }}</label>
                            <select name="gaun[]" class="form-select" id="gaun">
                                @foreach ($gaun as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endfor
                        <hr>
                        <h4>Perias</h4>
                        @for($i = 0; $i < $paket->jumlah_perias ; $i++)
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perias {{ $i+1 }}</label>
                                <select name="perias[]" class="form-select" id="perias">
                                    @foreach ($perias as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                         @endfor
                </div>
            </div>
    </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-default text-white" onclick="submitPemesananPaket({{$paket->id}})" style="background-color:#89375F">Pesan</button>
</div>

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
      
    })

</script>
