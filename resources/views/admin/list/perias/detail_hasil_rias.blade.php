<div class="modal-header">
    <h4 class="modal-title">Hasil Rias - {{ $nama_perias }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="table-responsive">
      <table id="gambar_gaun_tabel" class="table">
        @foreach ($hasil_rias as $item)
        <tr>
          <td>{{ $item->nama_rias }}</td>
        </tr>
        @foreach($item->gambars as $key => $value)   
        <tr id="list_gaun_gambar_{{ $item->id }}">
          <td width="50%">
              <img src="{{ asset('gambar/perias/' . $item->perias_id . '/' . $item->id.'/'.$value->nama_file) }}" alt="Image" class="img-fluid" >
          </td>
          <td align="left">
              <a href="#" onclick=" hapusGambar({{ $item->id }},'{{ csrf_token() }}')" data-toggle="modal" class="btn btn-success">Hapus</a>
          </td>
        </tr> 
        @endforeach
        @endforeach
      </table>
  </div>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
