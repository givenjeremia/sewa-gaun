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
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}} "> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
    <!-- fullCalendar -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/fullcalendar/main.css')}}"> --}}
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/jqvmap/jqvmap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}
    <!-- Daterange picker -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ public_path('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- summernote -->
    {{-- <link rel="stylesheet" href="{{ public_path('lte/plugins/summernote/summernote-bs4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" /> --}}
    <style>
        .custom-text-primary-italianno {
            font-family: 'Italianno';
            color: #89375F;
        }

        .custom-text-primary-poppins {
            font-family: 'Poppins';
            color: #89375F;
        }

        .card-hover:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 1);
            transition: box-shadow 0.3s;
        }
        .pagination .page-link {
            color: #89375F;
        }
        .pagination .page-item.active .page-link {
            border-color:#89375F;
            background-color:#89375F;
            color: #F3E8FF;/* Change to your desired active text color */
    }
    .rating input[type="radio"] {
    display: none;
}

.rating label {
    color: #ddd;
    font-size: 2rem;
}

.rating input[type="radio"]:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #f8ce0b;
}


    </style>
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
                    Millenimua
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
                  <b>Mulai Sewa:</b> {{ date('j F Y', strtotime($data->mulai_sewa)) }}<br>
                  <b>Akhir Sewa:</b> {{ date('j F Y', strtotime($data->akhir_sewa))  }}<br>
                  <b>Request:</b> {{ $data->request }}<br>
                  <b>Total Pembayaran: Rp </b> {{ number_format($data->total_pembayaran) }}<br>
                </div>
                <!-- /.col -->
                <div class="col invoice-col mb-4">
                    <strong>Detail Pembayaran</strong><br>
                    <b>Uang Muka: Rp </b> {{ number_format($data->pembayaran[0]->uang_muka) }}<br>
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
                      <th>Nama Gaun</th>
                      <th>Harga Sewa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->gaun as $value)
                    <tr>
                      <td>{{ $value->nama }}</td>
                      <td>{{ number_format($value->harga_sewa) }}</td>
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
