<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Komplain;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use App\Models\PemesananGaun;
use App\Models\PembayaranGaun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PembayaranGaunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.transaksi.gaun.penyewaan.index');    
    }
    
    public function indexAjax()
    {
        $pemesanan = PemesananGaun::with('pembayaran')->get();;
        // dd($data);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.gaun.penyewaan.table',compact('pemesanan'))->render()
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
        $maxTanggalCount = PembayaranGaun::selectRaw('MAX(SUBSTRING(nomor_pembayaran, -3)) + 1 AS MaxTanggal')->where('nomor_pembayaran', 'LIKE', $date_now.'%')->value('MaxTanggal');
       
        $countPembayaran= 0;
        if($maxTanggalCount== null){
            $countPembayaran=1;
        }
        else{
            $countPembayaran = $maxTanggalCount;
        }
        $no_pembayaran_gaun_generator = $date_now.'-'.'01'.'-'.'02'.'-'.str_pad($countPembayaran, 3, "0", STR_PAD_LEFT);
        try {
            $new = new PembayaranGaun();
            $new->nomor_pembayaran = $no_pembayaran_gaun_generator;
            $new->total_pembayaran = $request->get('total_pembayaran');
            $new->uang_muka = $request->get('deposit');
            $new->sisa_pembayaran = $request->get('sisa_pembayaran');
            $new->metode_pembayaran = $request->get('metode_pembayaran');
            $new->pemesanan_gaun_id  = $request->get('pemesanan_gaun_id');
            $new->status_pembayaran = 0;
            $new->save();
            // Update Status In Pemesanan 
            $pemesanan = PemesananGaun::find($request->get('pemesanan_gaun_id'));
            $pemesanan->status = 2;
            $pemesanan->save();
            $id_pembayaran_baru = $new->id;
            // Add Gambar
            $bukti_pembayaran = $request->file('bukti_pembayaran');
            $path = public_path('transaksi/gaun/' .$id_pembayaran_baru);
            $fileName = $no_pembayaran_gaun_generator.'-'.$bukti_pembayaran->getClientOriginalName();
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
                'pembayaran_gaun_id' => $id_pembayaran_baru,
                'keterangan' => $keterangan,
            ]);
            return response()->json(array('status' => 'success' ,'msg_1'=>'Pembayaran Berhasil','msg_2'=>'Harap Tunggu Konfirmasi Oleh Admin', 'nomor' => 'Nomor '.$no_pembayaran_gaun_generator), 200);
            

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'error' , 'msg' => 'Gagal melakukan Pembayaran '.$th), 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembayaranGaun  $pembayaranGaun
     * @return \Illuminate\Http\Response
     */
    public function show($pembayaranGaun)
    {
        // Show By Penggu
        $pembayaran = PembayaranGaun::find($pembayaranGaun);
        $komplain = Komplain::where('nomor_pemesanan', $pembayaran->pemesanan->nomor_pemesanan)->get();
        $rating_review = RatingReview::where('nomor_pemesanan',$pembayaran->pemesanan->nomor_pemesanan)->get();
        // dd($komplain);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.gaun.penyewaan.detail',compact('pembayaran','komplain','rating_review'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembayaranGaun  $pembayaranGaun
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranGaun $pembayaranGaun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembayaranGaun  $pembayaranGaun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranGaun $pembayaranGaun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembayaranGaun  $pembayaranGaun
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranGaun $pembayaranGaun)
    {
        //
    }

    public function pengambilanGaun(){
        
        return view('admin.transaksi.gaun.pengambilan.index');
    }
    public function pengambilanGaunAjax(){
        $pemesanan = PemesananGaun::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.gaun.pengambilan.table',compact('pemesanan'))->render()
        ), 200);
    }

    public function pengembalianGaun(){
        return view('admin.transaksi.gaun.pengembalian.index');
    }

    public function pengembalianGaunAjax(){
        $pemesanan = PemesananGaun::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.gaun.pengembalian.table',compact('pemesanan'))->render()
        ), 200);
    }

    public function formVerifPembayaran($id){
        $pembayaran = PembayaranGaun::find($id);

        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.gaun.penyewaan.verif',compact('pembayaran'))->render()
        ), 200);
    }

    public function verifyPembayaran(Request $request){
        try {
            $pembayaran_id = $request->get('pembayaran_id');
            $pembayaran_value = $request->get('value');
            $pembayaranGaun = PembayaranGaun::find($pembayaran_id);
            $pembayaranGaun->status_pembayaran = $pembayaran_value;
            $pembayaranGaun->save();
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

  
    
    public function updatePengembalian(Request $request){
        try {
            $gaun_id = $request->get('gaun_id');
            $pemesanan_id = $request->get('pemesanan_id');
            $value  = $request->get('value');
            $pemesananGaun = PemesananGaun::find($pemesanan_id);
            $pemesananGaun->gaun()->updateExistingPivot($gaun_id, ['pengembalian' => 1]);
            return response()->json(array(
                'status' => 'success',
                'msg' => 'Update Pengembalian Berhasil'
            ), 200);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array(
                'status' => 'error',
                'msg' => 'Update Pengembalian Gagal'
            ), 200);
        }
    }

    public function updatePengambilan(Request $request){
        try {
            $gaun_id = $request->get('gaun_id');
            $pemesanan_id = $request->get('pemesanan_id');
            $value  = $request->get('value');
            $pemesananGaun = PemesananGaun::find($pemesanan_id);
            $pemesananGaun->gaun()->updateExistingPivot($gaun_id, ['pengambilan' => $value]);
            return response()->json(array(
                'status' => 'success',
                'msg' => 'Update Pengambilan Berhasil'
            ), 200);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array(
                'status' => 'error',
                'msg' => 'Update pengambilan Gagal'
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
        $data = PemesananGaun::find($id);
        $dompdf->loadHtml(View::make('client.transaksi.gaun.invoice', compact('data') )->render());
        $dompdf->render();
        $title = 'skr';
        return $dompdf->stream($title, ['Attachment' => false]);
    }

}
