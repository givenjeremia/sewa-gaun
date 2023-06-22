<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaun;
use App\Models\KategoriGaun;
use Illuminate\Http\Request;
use App\Models\PenyewaanGaun;
use App\Models\KatergoryPerias;

class PenyewaanGaunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        // Get Date Now
        $date_now = Carbon::now()->timezone('Asia/Jakarta')->toDateString();
        // Cek Jadwal Gaun 
        $gaun = Gaun::paginate(8);
        // 
        $kategori = KategoriGaun::all();
        return view('client.penyewaan_gaun.index',compact('gaun','date_now','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        // return view('client.penyewaan_gaun.form');
        $gaun = Gaun::find($id);
        $jenis = "gaun";
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.penyewaan_gaun.form_modal',compact('gaun','jenis'))->render()
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenyewaanGaun  $penyewaanGaun
     * @return \Illuminate\Http\Response
     */
    public function show($penyewaanGaun)
    {
        //
        $gaun = Gaun::find($penyewaanGaun);
        $jenis = "gaun";
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.penyewaan_gaun.detail',compact('gaun','jenis'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenyewaanGaun  $penyewaanGaun
     * @return \Illuminate\Http\Response
     */
    public function edit(PenyewaanGaun $penyewaanGaun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenyewaanGaun  $penyewaanGaun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenyewaanGaun $penyewaanGaun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenyewaanGaun  $penyewaanGaun
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenyewaanGaun $penyewaanGaun)
    {
        //
    }

    public function cariGaun(Request $request){
        $date_now = Carbon::now()->timezone('Asia/Jakarta')->toDateString();
        $query = '%'.$request->get('query').'%';
        $gaun = Gaun::where('nama', 'like', $query)->paginate(8);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.penyewaan_gaun.data',compact('gaun','date_now'))->render()
        ), 200);
    }

    public function filterKategori(Request $request){
        $kategori = $request->get('kategori');
        $date_now = Carbon::now()->timezone('Asia/Jakarta')->toDateString();
        
        if($kategori == 'all'){
            $gaun = Gaun::paginate(8);
            return response()->json(array(
                'status' => 'oke',
                'msg' => view('client.penyewaan_gaun.data',compact('gaun','date_now'))->render()
            ), 200);
        }
        else{
            $gaun = Gaun::where('kategori_gaun_id',$kategori)->paginate(8);
            return response()->json(array(
                'status' => 'oke',
                'msg' => view('client.penyewaan_gaun.data',compact('gaun','date_now'))->render()
            ), 200);
        }
       
    }

   

}
