<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use Illuminate\Http\Request;
use App\Models\PemesananGaun;
use App\Models\PembayaranGaun;
use App\Models\PemesananPaket;
use App\Models\PemesananPerias;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jenis,$pemesanan_id)
    {
        //
        if($jenis == 'gaun'){
            $pemesanan = PemesananGaun::find($pemesanan_id);
        }
        elseif($jenis == 'perias'){
            $pemesanan = PemesananPerias::find($pemesanan_id);
        }
        else{
            $pemesanan = PemesananPaket::find($pemesanan_id);
        }
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.transaksi.komplain', compact('pemesanan','jenis'))->render()
        ), 200);
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
        try {
            if($request->get('jenis') == 'gaun'){
                $new = new Komplain();
                $new->jenis_komplain = $request->get('jenis_komplain');
                $new->keterangan = $request->get('keterangan');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->gaun_id = $request->get('gaun_id');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => "Komplain Berhasil Di Tambahkan"
                ), 200);
            }
            else if($request->get('jenis') == 'perias'){
                $new = new Komplain();
                $new->jenis_komplain = $request->get('jenis_komplain');
                $new->keterangan = $request->get('keterangan');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->perias_id = $request->get('perias_id');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => 'Komplain Berhasil Di Tambahkan'
                ), 200);
            }
            else{
                $new = new Komplain();
                $new->jenis_komplain = $request->get('jenis_komplain');
                $new->keterangan = $request->get('keterangan');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => 'Komplain Berhasil Di Tambahkan'
                ), 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array(
                'status' => 'errorr',
                'msg' => 'Komplain Gagal Di Tambahkan'
            ), 200);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function show(Komplain $komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function edit(Komplain $komplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komplain $komplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komplain $komplain)
    {
        //
    }
}
