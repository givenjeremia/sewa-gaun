<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\PemesananGaun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PemesananGaunController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
        $list_status = [
            3=> 'Semua Transaksi',
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        return view( 'client.transaksi.gaun.index', compact( 'list_status' ) );
    }

    public function indexStatus( $status ) {
        $pemesananGaun = [];
        if ( $status == 3 ) {
            $pemesananGaun = PemesananGaun::paginate( 5 );
            ;
        } else {
            $pemesananGaun = PemesananGaun::where( 'status', $status )->paginate( 5 );

        }
        $list_status = [
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        // return response()->json( array(
        //     'status' => 'oke',
        //     'msg' => view( 'client.transaksi.gaun.data', compact( 'pemesananGaun', 'list_status' ) )->render()
        // ), 200 );
        $view = view( 'client.transaksi.gaun.data', compact( 'pemesananGaun', 'list_status' ) )->render();
        $pagination = $pemesananGaun->links( 'pagination::bootstrap-4' )->toHtml();

        return response()->json( [
            'status' => 'oke',
            'msg' => $view,
            'pagination' => $pagination ,
            'status_pemesanan' =>$status,
        ], 200 );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //
        $currentTime = Carbon::now()->timezone( 'Asia/Jakarta' );
        $formattedDate = date( 'd-m-Y', strtotime( $currentTime->toDateString() ) );
        $date_now = str_replace( '-', '', $formattedDate );
        $maxTanggalCount = PemesananGaun::selectRaw( 'MAX(SUBSTRING(nomor_pemesanan, -3)) + 1 AS MaxTanggal' )->where( 'nomor_pemesanan', 'LIKE', $date_now.'%' )->value( 'MaxTanggal' );
        $countPembelian = 0;
        if ( $maxTanggalCount == null ) {
            $countPembelian = 1;
        } else {
            $countPembelian = $maxTanggalCount;
        }
        $no_pemesanan_gaun_generator = $date_now.'-'.'01'.'-'.'01'.'-'.str_pad( $countPembelian, 3, '0', STR_PAD_LEFT );
        try {
            // Get User ID
            $user = Auth::user();
            // Generate Nomor Pemesanan
            $new = new PemesananGaun();
            $new->nomor_pemesanan = $no_pemesanan_gaun_generator;
            $new->mulai_sewa = $request->get( 'mulai_sewa' );
            $new->akhir_sewa = $request->get( 'akhir_sewa' );
            $new->nama = $request->get( 'nama' );
            $new->alamat = $request->get( 'alamat' );
            $new->telepon = $request->get( 'telepon' );
            $new->total_pembayaran = $request->get( 'total' );
            $new->request = $request->get( 'request_remake' ) ? $request->get( 'request_remake' ) : 'Tidak Ada Request Remake';

            $new->status = 1;
            $new->users_id = $user->id;
            $new->save();
            $id_pemesana_baru = $new->id;
            $new->gaun()->attach( $request->get( 'gaun_id' ) );
            // Add To Jadwal
            $startDate = Carbon::parse( $request->get( 'mulai_sewa' ) );
            $endDate = Carbon::parse( $request->get( 'akhir_sewa' ) );
            $diffInDays = $endDate->diffInDays( $startDate );
            $keterangan_jadwal = 'Customer '.$user->nama.' Dengan Request '.$new->request;
            for ( $i = 0; $i <= $diffInDays ; $i++ ) {

                # code...
                $date = Carbon::parse( $request->get( 'mulai_sewa' ) );
                $date->addDays( $i );
                $new_jadwal = new Jadwal();
                $new_jadwal->tanggal_waktu = $date->toDateTimeString();
                $new_jadwal->status = 1;
                $new_jadwal->gaun_id = $request->get( 'gaun_id' );
                $new_jadwal->keterangan = $keterangan_jadwal;
                $new_jadwal->save();
            }
            return response()->json( array( 'status' => 'success', 'pemesanan'=>$id_pemesana_baru, 'msg_1'=>'Pemesanan Berhasil', 'msg_2'=>'Ingin Melanjutkan Pembayaran ?', 'nomor' => 'Nomor '.$no_pemesanan_gaun_generator ), 200 );

        } catch ( \Throwable $th ) {
            //throw $th;
            return response()->json( array( 'status' => 'error', 'msg' => 'Pemesanan Gagal Di Buat '.$th ), 200 );

        }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\PemesananGaun  $pemesananGaun
    * @return \Illuminate\Http\Response
    */

    public function show( $pemesananGaun ) {
        // In Transaksi
        $pemesanan = PemesananGaun::find( $pemesananGaun );
        $jenis = 'gaun';
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.pembayaran.transaksi_modal', compact( 'pemesanan','jenis' ) )->render()
        ), 200 );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\PemesananGaun  $pemesananGaun
    * @return \Illuminate\Http\Response
    */

    public function edit( PemesananGaun $pemesananGaun ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\PemesananGaun  $pemesananGaun
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, PemesananGaun $pemesananGaun ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\PemesananGaun  $pemesananGaun
    * @return \Illuminate\Http\Response
    */

    public function destroy( PemesananGaun $pemesananGaun ) {
        //
    }


    public function detailTransaksi( $id ) {
        //
        $list_status = [
            3=> 'Semua Transaksi',
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        $pemesanan = PemesananGaun::find($id);
        $jenis = 'gaun';
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.transaksi.gaun.detail', compact( 'pemesanan','jenis','list_status' ) )->render()
        ), 200 );
        

    }
}
