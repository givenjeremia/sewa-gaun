<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">Pengembalian Gaun</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nomor Transaksi</th>
          <th>Client</th>
          <th>Mulai Sewa</th>
          <th>Akhir Sewa</th>
          <th>Total Pembayaran</th>
          <th>Status Pengembalian</th>
        </tr>
        </thead>
        <tbody>
          @foreach($pemesanan as $key => $value)
          @if(count($value->pembayaran) > 0  &&  $value->gaun[0]->pivot->pengambilan == 1)
          <tr class=" bg-light">
            <td>{{ $key+1 }}</td>
            <td>
              {{ $value->nomor_pemesanan }}
            </td>
            <td>
              {{ $value->nama }}
            </td>
            <td>
                {{ $value->mulai_sewa }}
            </td>
            <td>
              {{ $value->akhir_sewa }}
            </td>
            <td>
              {{ number_format($value->pembayaran[0]->total_pembayaran) }}
            </td>
            <td>
              <select class="form-control" id="status_option" name="status_option" onchange="statusChange(this)" pembayaran="{{ $value->id }}" gaun="{{ $value->gaun[0]->id }}">
                @foreach ([ 0 => 'Belum Di Kembalikan', 1 => 'Sudah Di Kembalikan'] as $key => $Label)
                <option value="{{ $key }}" {{ $value->gaun[0]->pivot->pengembalian == $key ? 'selected' : '' }}>{{ $Label }}</option>
                @endforeach
              </select>
            </td>
            
          </tr>
            
          @endif
       
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>No</th>
            <th>Nomor Transaksi</th>
            <th>Client</th>
            <th>Mulai Sewa</th>
            <th>Akhir Sewa</th>
            <th>Total Pembayaran</th>
            <th>Status Pengembalian</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
</div>