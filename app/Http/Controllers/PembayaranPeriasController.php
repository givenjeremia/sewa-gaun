<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Komplain;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use App\Models\PemesananPerias;
use App\Models\PembayaranPerias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PembayaranPeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pemesanan = PemesananPerias::all();
        return view('admin.transaksi.perias.index',['pemesanan'=>$pemesanan]);
    }

    public function indexAjax()
    {
        $pemesanan = PemesananPerias::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.perias.table',compact('pemesanan'))->render()
        ), 200);
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
        $currentTime = Carbon::now()->timezone('Asia/Jakarta');
        $formattedDate = date("d-m-Y", strtotime($currentTime->toDateString()));
        $date_now = str_replace('-', '',$formattedDate);
        $maxTanggalCount = PembayaranPerias::selectRaw('MAX(SUBSTRING(nomor_pembayaran, -3)) + 1 AS MaxTanggal')->where('nomor_pembayaran', 'LIKE', $date_now.'%')->value('MaxTanggal');
       
        $countPembayaran= 0;
        if($maxTanggalCount== null){
            $countPembayaran=1;
        }
        else{
            $countPembayaran = $maxTanggalCount;
        }
        $no_pembayaran_perias_generator = $date_now.'-'.'02'.'-'.'02'.'-'.str_pad($countPembayaran, 3, "0", STR_PAD_LEFT);
        try {
            $new = new PembayaranPerias();
            $new->nomor_pembayaran = $no_pembayaran_perias_generator;
            $new->total_pembayaran = $request->get('total_pembayaran');
            $new->dp = $request->get('deposit');
            $new->sisa_pembayaran = $request->get('sisa_pembayaran');
            $new->metode_pembayaran = $request->get('metode_pembayaran');
            $new->pemesanan_perias_id  = $request->get('pemesanan_perias_id');
            $new->status_pembayaran = 0;
            $new->save();
            $id_pembayaran_baru = $new->id;
             // Update Status In Pemesanan 
            $pemesanan = PemesananPerias::find($request->get('pemesanan_perias_id'));
            $pemesanan->status = 2;
            $pemesanan->save();
            // Add Gambar
            $bukti_pembayaran = $request->file('bukti_pembayaran');
            $path = public_path('transaksi/perias/' .$id_pembayaran_baru);
            $fileName = $no_pembayaran_perias_generator.'-'.$bukti_pembayaran->getClientOriginalName();
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
                'pembayaran_perias_id' => $id_pembayaran_baru,
                'keterangan' => $keterangan,
            ]);
            return response()->json(array('status' => 'success' ,'msg_1'=>'Pembayaran Berhasil','msg_2'=>'Harap Tunggu Konfirmasi Oleh Admin', 'nomor' => 'Nomor '.$no_pembayaran_perias_generator), 200);
            

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'error' , 'msg' => 'Gagal melakukan Pembayaran '.$th), 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembayaranPerias  $pembayaranPerias
     * @return \Illuminate\Http\Response
     */
    public function show( $pembayaranPerias)
    {
        //
        $pembayaran = PembayaranPerias::find($pembayaranPerias);
        $komplain = Komplain::where('nomor_pemesanan', $pembayaran->pemesanan->nomor_pemesanan)->get();
        $rating_review = RatingReview::where('nomor_pemesanan',$pembayaran->pemesanan->nomor_pemesanan)->get();

        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.perias.detail',compact('pembayaran','komplain','rating_review'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembayaranPerias  $pembayaranPerias
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranPerias $pembayaranPerias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembayaranPerias  $pembayaranPerias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranPerias $pembayaranPerias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembayaranPerias  $pembayaranPerias
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranPerias $pembayaranPerias)
    {
        //
    }

    public function formVerifPembayaran($id){
        $pembayaran = PembayaranPerias::find($id);

        // dd($pembayaran);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.perias.verif',compact('pembayaran'))->render()
        ), 200);
    }

    public function verifyPembayaran(Request $request){
        try {
            $pembayaran_id = $request->get('pembayaran_id');
            $pembayaran_value = $request->get('value');
            $pembayaranPerias = PembayaranPerias::find($pembayaran_id);
            $pembayaranPerias->status_pembayaran = $pembayaran_value;
            $pembayaranPerias->save();
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

}
