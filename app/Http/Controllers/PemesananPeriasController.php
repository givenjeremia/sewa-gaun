<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\PemesananPerias;
use Illuminate\Support\Facades\Auth;

class PemesananPeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_status = [
            3=> 'Semua Transaksi',
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        return view( 'client.transaksi.perias.index', compact( 'list_status' ) );
    }

    public function indexStatus( $status ) {
        $user = Auth::user();
        // dd($status);
        $pemesananPerias = [];
        if ( $status == 3 ) {
            $pemesananPerias = PemesananPerias::where('users_id',$user->id)->paginate(5);
        

        } else {
            $pemesananPerias = PemesananPerias::where( 'status', $status )->where('users_id',$user->id)->paginate(5);
        }
        $list_status = [
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        $view = view( 'client.transaksi.perias.data', compact( 'pemesananPerias', 'list_status' ) )->render();
        $pagination = $pemesananPerias->links( 'pagination::bootstrap-4' )->toHtml();
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
    public function create()
    {
        //
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $currentTime = Carbon::now()->timezone( 'Asia/Jakarta' );
        $formattedDate = date( 'd-m-Y', strtotime( $currentTime->toDateString() ) );
        $date_now = str_replace( '-', '', $formattedDate );
        $maxTanggalCount = PemesananPerias::selectRaw( 'MAX(SUBSTRING(nomor_pemesanan, -3)) + 1 AS MaxTanggal' )->where( 'nomor_pemesanan', 'LIKE', $date_now.'%' )->value( 'MaxTanggal' );
        $countPembelian = 0;
        if ( $maxTanggalCount == null ) {
            $countPembelian = 1;
        } else {
            $countPembelian = $maxTanggalCount;
        }
        $no_pemesanan_perias_generator = $date_now.'-'.'02'.'-'.'01'.'-'.str_pad( $countPembelian, 3, '0', STR_PAD_LEFT );
        try {
            // Get User ID
            $user = Auth::user();
            // Generate Nomor Pemesanan
            $new = new PemesananPerias();
            $new->nomor_pemesanan = $no_pemesanan_perias_generator;
            $new->tanggal_event = $request->get( 'tanggal_sewa' );
            $new->jam_event= $request->get( 'jam_sewa' );
            $new->nama = $request->get('nama');
            $new->alamat = $request->get('alamat');
            $new->telepon = $request->get('telepon');
            $new->total_pembayaran = $request->get('total');
            $new->status = 1;
            $new->users_id = $user->id;
            $new->save();
            $id_pemesana_baru = $new->id;
            $new->perias()->attach( $request->get( 'perias_id' ) );
            // Add To Jadwal
            $combine =  $request->get( 'mulai_sewa_pemesanan' ).' '. $request->get( 'jam_sewa' );
            $tanggal_waktu = Carbon::parse($combine);
            $keterangan_jadwal = 'Customer '.$request->get('nama').' Dengan Telepon '.$request->get('telepon');
            $new_jadwal = new Jadwal();
            $new_jadwal->tanggal_waktu = $tanggal_waktu;
            $new_jadwal->status = 1;
            $new_jadwal->perias_id = $request->get( 'perias_id' );
            $new_jadwal->keterangan = $keterangan_jadwal;
            $new_jadwal->save();

            return response()->json( array( 'status' => 'success', 'pemesanan'=>$id_pemesana_baru, 'msg_1'=>'Pemesanan Berhasil', 'msg_2'=>'Ingin Melanjutkan Pembayaran ?', 'nomor' => 'Nomor '.$no_pemesanan_perias_generator ), 200 );

        } catch ( \Throwable $th ) {
            //throw $th;
            return response()->json( array( 'status' => 'error', 'msg' => 'Pemesanan Gagal Di Buat '.$th ), 200 );

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PemesananPerias  $pemesananPerias
     * @return \Illuminate\Http\Response
     */
    public function show($pemesananPerias)
    {
        //
        $jenis = 'perias';
        $pemesanan = PemesananPerias::find( $pemesananPerias );
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.pembayaran.transaksi_modal', compact( 'pemesanan','jenis' ) )->render()
        ), 200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemesananPerias  $pemesananPerias
     * @return \Illuminate\Http\Response
     */
    public function edit(PemesananPerias $pemesananPerias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemesananPerias  $pemesananPerias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemesananPerias $pemesananPerias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemesananPerias  $pemesananPerias
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemesananPerias $pemesananPerias)
    {
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
        $pemesanan = PemesananPerias::find($id);
        $jenis = 'perias';
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.transaksi.perias.detail', compact( 'pemesanan','jenis','list_status' ) )->render()
        ), 200 );
        

    }
}
