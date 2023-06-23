<div class="card mt-2">
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Gaun</th>
              <th>Perias</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 1; $i <= count($date_1_month); $i++)
            <tr>
              <td>{{ $i }}</td>
              <td>{{  $date_1_month[$i-1][0] }}</td>
              {{-- @if (count($date_1_month[$i-1]['gaun']) > 0) --}}
              <td>
                @if (count($date_1_month[$i-1]['gaun']) > 0  )
                    
                <button onclick="getDetailJadwal('gaun','{{ $date_1_month[$i-1][0] }}')"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailJadwal">
                    {{ count($date_1_month[$i-1]['gaun']).' Jumlah Gaun' }}
                </button>
                @else
                    Tidak Ada Jadwal Perias
                @endif
              </td>
              <td>
                @if (count($date_1_month[$i-1]['perias']) > 0)
                    
                <button onclick="getDetailJadwal('perias','{{ $date_1_month[$i-1][0] }}')"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailJadwal">
                    {{ count($date_1_month[$i-1]['perias']).' Jumlah Perias' }}
                </button>
                @else
                    Tidak Ada Jadwal Perias
                @endif
              </td>
              
              {{-- @else --}}
              {{-- <td>Tidak Ada Jadwal Gaun</td>
              <td>Tidak Ada Jadwal Perias</td> --}}
              {{-- @endif --}}
             
            </tr>
            @endfor
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>