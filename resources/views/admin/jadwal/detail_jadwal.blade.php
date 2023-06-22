<div class="modal-header">
    <h5 class="modal-title" id="exampleModalScrollableTitle">Detal Jadwal Tanggal {{ $tanggal }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ($jenis == 'gaun')
    <div class="table-responsive">
      
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($jadwal as $key => $item)
            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{  $item->gaun->nama  }}</td>
              <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
            </tr>
            </tfoot>
          </table>
        
 
    </div> 
    @else
    <div class="table-responsive">
        <h3>Ada Jadwal Perias</h3>
    </div> 
    @endif
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>