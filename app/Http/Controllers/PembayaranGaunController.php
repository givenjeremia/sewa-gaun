<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PembayaranGaun;
use App\Models\PemesananGaun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $pemesanan = PemesananGaun::all();
        return view('admin.transaksi.index',['title'=>'Gaun', 'pemesanan'=>$pemesanan]);    
    }
    
    public function indexAjax()
    {
        $data = PemesananGaun::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.transaksi.table_gaun',compact('data'))->render()
        ), 200);
        // return Datatables::of($data)->make(true);
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
    public function show(PembayaranGaun $pembayaranGaun)
    {
        // Show By Penggu
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
        return view('admin.transaksi.pengambilan_gaun');
    }

    public function pengembalianGaun(){
        return view('admin.transaksi.pengembalian_gaun');
    }

}
