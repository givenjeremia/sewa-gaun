<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">Pemesanan Paket</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr >
            <th>No</th>
            <th>Nomor Transaksi</th>
            <th>Client</th>
            <th>Tanggal Event</th>
            <th>Waktu Event</th>
            <th>Uang Muka</th>
            <th>Sisa Pembayaran</th>
            <th>Total Pembayaran</th>
            <th>Metode Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @foreach($pemesanan as $key => $value)
            @if($value->status_pembayaran != 0)
            <tr class=" bg-light text-nowrap">
              <td>{{ $key+1 }}</td>
              <td>
                {{ $value->nomor_pemesanan }}
              </td>
              <td>
                {{ $value->nama }}
              </td>
              <td>
                  {{ $value->tanggal_event }}
              </td>
              <td>
                {{ $value->waktu_event }}
              </td>
              <td>
                {{ number_format($value->uang_muka) }}
              </td>
              <td>
                {{ number_format($value->sisa_pembayaran) }}
              </td>
              <td>
                {{ number_format($value->otal_pembayaran) }}
              </td>
              <td>
                {{ $value->metode_pembayaran == 0 ? 'Belum Lunas' : 'Lunas' }}
              </td>
         
              <td >
                {{  $value->verif == '0000-00-00' ? 'Belum Verifikasi' : 'Verifikasi' }}
              </td>
              <td>
       
                @if ( $value->verif == '0000-00-00')
                <a href="#modalVerifStatus" data-toggle="modal" onclick="getVerifModal({{$value->id}})"  class="btn btn-primary" ><i class="fa fa-check"></i></a>
                @endif
                <a href="#modalDetailPemesananPaket" data-toggle="modal" onclick="getDetailPemesanan({{ $value->id }})"  class="btn btn-success" ><i class="fa fa-wrench"></i></a>
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
            <th>Uang Muka</th>
            <th>Sisa Pembayaran</th>
            <th>Total Pembayaran</th>
            <th>Metode Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>