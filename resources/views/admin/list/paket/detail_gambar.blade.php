<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">{{ $nama_paket }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table id="gambar_gaun_tabel" class="table">
          @foreach ($gambar_gaun as $item)
          <tr id="list_gaun_gambar_{{ $item->id }}">
            <td width="50%">
                <img src="{{ asset("gambar/gaun/".$item->gaun_id."/".$item->nama_file) }}" alt="Image" class="img-fluid" >
            </td>
            <td align="left">
                <a href="#" onclick=" hapusGambar({{ $item->id }},'{{ csrf_token() }}')" data-toggle="modal" class="btn btn-success">Hapus</a>
            </td>
          </tr> 
          @endforeach
        </table>
    </div>

      
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>