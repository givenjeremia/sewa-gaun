<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Millenimua</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Italianno:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ public_path('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('lte/dist/css/adminlte.min.css') }}">
  
</head>

<body class="hold-transition layout-top-nav">
    <div class="">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    Millenimua ( Perias )
                    <small class="float-right mx-2">Nomor Pemesanan : {{ $data->nomor_pemesanan }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>Client</strong><br>
                      {{ $data->nama }}<br>
                      {{ $data->alamat }}<br>
                      Phone: {{ $data->telepon }}<br>
                  </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col invoice-col mb-4">
                <strong>Detail</strong><br>
                  <b>Tanggal Event:</b> {{ date('j F Y', strtotime($data->tanggal_event)) }}<br>
                  <b>Jam Event:</b> {{ $data->jam_event }}<br>
                  <b>Total Pembayaran: Rp </b> {{ number_format($data->total_pembayaran) }}<br>
                </div>
                <!-- /.col -->
                <div class="col invoice-col mb-4">
                    <strong>Detail Pembayaran</strong><br>
                    <b>Uang Muka: Rp </b> {{ number_format($data->pembayaran[0]->dp) }}<br>
                    <b>Sisa Pembayaran: Rp </b> {{ number_format($data->pembayaran[0]->sisa_pembayaran) }}<br>
                    <b>Metode Pembayaran:</b> {{ $data->pembayaran[0]->metode_pembayaran == 0 ? 'Belum Lunas' : 'Lunas' }}<br>
                    <b>Status Pembayaran:</b> {{  $data->pembayaran[0]->status_pembayaran == 0 ? 'Belum Terverifikasi' : 'Terverifikasi' }}<br>
                  </div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row mr-2">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Perias</th>
                      <th>Harga Sewa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->perias as $value)
                    <tr>
                      <td>{{ $value->nama }}</td>
                      <td>{{ number_format($value->harga) }}</td>
                    </tr>
                    @endforeach
                  
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

</body>

</html>
