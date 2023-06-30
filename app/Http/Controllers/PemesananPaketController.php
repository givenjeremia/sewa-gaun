<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Paket;
use App\Models\Jadwal;
use App\Models\Komplain;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use App\Models\PemesananGaun;
use App\Models\PemesananPaket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PemesananPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_status = [
            3=> 'Semua Transaksi',
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        return view( 'client.transaksi.paket.index', compact( 'list_status' ) );
    }
    public function indexStatus( $status ) {
        $pemesananPaket = [];
        if ( $status == 3 ) {
            $pemesananPaket = PemesananPaket::paginate( 5 );
            ;
        } else {
            $pemesananPaket = PemesananPaket::where( 'status_pembayaran', $status )->paginate( 5 );

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
        $view = view( 'client.transaksi.paket.data', compact( 'pemesananPaket', 'list_status' ) )->render();
        $pagination = $pemesananPaket->links( 'pagination::bootstrap-4' )->toHtml();

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
        $currentTime = Carbon::now()->timezone( 'Asia/Jakarta' );
        $formattedDate = date( 'd-m-Y', strtotime( $currentTime->toDateString() ) );
        $date_now = str_replace( '-', '', $formattedDate );
        $maxTanggalCount = PemesananPaket::selectRaw( 'MAX(SUBSTRING(nomor_pemesanan, -3)) + 1 AS MaxTanggal' )->where( 'nomor_pemesanan', 'LIKE', $date_now.'%' )->value( 'MaxTanggal' );
        $countPembelian = 0;
        if ( $maxTanggalCount == null ) {
            $countPembelian = 1;
        } else {
            $countPembelian = $maxTanggalCount;
        }
        $no_pemesanan_paket_generator = $date_now.'-'.'03'.'-'.'01'.'-'.str_pad( $countPembelian, 3, '0', STR_PAD_LEFT );
        try {
            // Get User ID
            $user = Auth::user();
            // Generate Nomor Pemesanan
            $new = new PemesananPaket();
            $new->nomor_pemesanan = $no_pemesanan_paket_generator;
            $new->tanggal_event = $request->get( 'tanggal_event' );
            $new->waktu_event= $request->get( 'jam_event' );
            $new->nama = $request->get('nama');
            $new->alamat = $request->get('alamat');
            $new->telp = $request->get('telepon');
            $new->total_pembayaran = $request->get('total');
            $new->status_pembayaran = 1;
            $new->paket_id = $request->get('paket_id');
            $new->save();
            $id_pemesana_baru = $new->id;
            $combine =  $request->get( 'tanggal_event' ).' '. $request->get( 'jam_event' );
            $tanggal_waktu = Carbon::parse($combine);
            $keterangan_jadwal = 'Pemesanan Paket '.$no_pemesanan_paket_generator.' Dengan Nama '.$request->get('nama').' Dengan Telepon '.$request->get('telepon');
            // Add Gaun
            foreach ($request->get('gaun') as $key => $value) {
                $new->gaun()->attach($value);
                $new_jadwal = new Jadwal();
                $new_jadwal->tanggal_waktu = $tanggal_waktu;
                $new_jadwal->status = 1;
                $new_jadwal->gaun_id = $value;
                $new_jadwal->keterangan = $keterangan_jadwal;
                $new_jadwal->save();
            }
            // Add Perias
            foreach ($request->get('perias') as $key => $value) {
                $new->perias()->attach( $value);
                $new_jadwal = new Jadwal();
                $new_jadwal->tanggal_waktu = $tanggal_waktu;
                $new_jadwal->status = 1;
                $new_jadwal->perias_id = $value;
                $new_jadwal->keterangan = $keterangan_jadwal;
                $new_jadwal->save();
            }
            return response()->json( array( 'status' => 'success', 'pemesanan'=>$id_pemesana_baru, 'msg_1'=>'Pemesanan Berhasil', 'msg_2'=>'Ingin Melanjutkan Pembayaran ?', 'nomor' => 'Nomor '.$no_pemesanan_paket_generator ), 200 );

        } catch ( \Throwable $th ) {
            //throw $th;
            return response()->json( array( 'status' => 'error', 'msg' => 'Pemesanan Gagal Di Buat '.$th ), 200 );

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PemesananPaket  $pemesananPaket
     * @return \Illuminate\Http\Response
     */
    public function show($pemesananPaket)
    {
        //
        $pemesanan = PemesananPaket::find( $pemesananPaket );
        $jenis = 'paket';
        $paket =  Paket::find($pemesanan->paket_id);
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.pembayaran.transaksi_modal', compact( 'pemesanan','jenis','paket' ) )->render()
        ), 200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemesananPaket  $pemesananPaket
     * @return \Illuminate\Http\Response
     */
    public function edit(PemesananPaket $pemesananPaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemesananPaket  $pemesananPaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemesananPaket $pemesananPaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemesananPaket  $pemesananPaket
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemesananPaket $pemesananPaket)
    {
        //
    }

    public function pembayaranPaket(Request $request)
    {
        try {
            //code...
            $pemesananPaket = PemesananPaket::find($request->get('pemesanan_paket_id'));
            $pemesananPaket->uang_muka = $request->get('deposit');
            $pemesananPaket->sisa_pembayaran = $request->get('sisa_pembayaran');
            $pemesananPaket->metode_pembayaran = $request->get('metode_pembayaran');
            $pemesananPaket->status_pembayaran = 2;
            $pemesananPaket->save();
            $bukti_pembayaran = $request->file('bukti_pembayaran');
            $path = public_path('transaksi/paket/' .$pemesananPaket->id);
            $fileName = $pemesananPaket->nomor_pemesanan.'-'.$bukti_pembayaran->getClientOriginalName();
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
                $bukti_pembayaran->move($path, $fileName);
            } else {
                $bukti_pembayaran->move($path, $fileName);
            }
            $keterangan = '';
            if($request->get('metode_pembayaran') == 0){
                $keterangan = "Pembayaran Dengan Metode Deposit";
            }
            else{
                $keterangan = "Pembayaran Dengan Metode Lunas";
            }

            DB::table('gambar_pembayaran')->insert([
                'nama_file' => $fileName,
                'pemesanan_paket_id' => $pemesananPaket->id,
                'keterangan' => $keterangan,
            ]);
            return response()->json(array('status' => 'success' ,'msg_1'=>'Pembayaran Berhasil','msg_2'=>'Harap Tunggu Konfirmasi Oleh Admin', 'nomor' => 'Nomor '.$pemesananPaket->nomor_pemesanan), 200);

        } catch (\Throwable $th) {
            return response()->json(array('status' => 'error' , 'msg' => 'Gagal melakukan Pembayaran '.$th), 200);
        }
    }

    public function detailTransaksi( $id ) {
        //
        $list_status = [
            3=> 'Semua Transaksi',
            2=> 'Sudah Melakukan Pembayaran',
            1=> 'Belum Melakukan Pembayaran',
            0=> 'Dibatalkan',
        ];
        
        $pemesanan = PemesananPaket::find($id);
        $paket =  Paket::find($pemesanan->paket_id);
        $jenis = 'paket';
        return response()->json( array(
            'status' => 'oke',
            'msg' => view( 'client.transaksi.paket.detail', compact( 'pemesanan','jenis','list_status','paket' ) )->render()
        ), 200 );
        

    }

    public function indexTransaksi(){
        return view('admin.transaksi.paket.index');  
    }

    public function indexTransaksiAjax(){
        $pemesanan = PemesananPaket::all();
        // dd($data);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.paket.table',compact('pemesanan'))->render()
        ), 200);
    }

    public function detailTransaksiAdmin($id){
        $pemesanan = PemesananPaket::find($id);
        $komplain = Komplain::where('nomor_pemesanan', $pemesanan->nomor_pemesanan)->get();
        $rating_review = RatingReview::where('nomor_pemesanan',$pemesanan->nomor_pemesanan)->get();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.paket.detail',compact('pemesanan','komplain','rating_review'))->render()
        ), 200); 
    }


    public function formVerifPembayaran($id){
        $pemesanan = PemesananPaket::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.paket.verif',compact('pemesanan'))->render()
        ), 200);
    }

    public function verifyPembayaran(Request $request){
        try {
            $pemesanan_id = $request->get('pemesanan_id');
            $pembayaranPaket = PemesananPaket::find($pemesanan_id);
            $pembayaranPaket->verif = now();
            $pembayaranPaket->save();
            return response()->json(array(
                'status' => 'success',
                'msg' => 'Verify Pembayaran Berhasil'
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array(
                'status' => 'error',
                'msg' => 'Verify Pembayaran Gagal'
            ), 200);
        }
    }


    public function cetakInvoice($id){
        
        // 
        $options = new Options();
        $options->setChroot('');
       
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);
        $dompdf->getCanvas();
        $data = PemesananPaket::find($id);
        $dompdf->loadHtml(View::make('client.transaksi.paket.invoice', compact('data') )->render());
        $dompdf->render();
        $title = 'Invoice '.$data->nomor_pemesanan;
        return $dompdf->stream($title, ['Attachment' => true]);
    }




}
