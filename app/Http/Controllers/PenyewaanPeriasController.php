<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Perias;
use Illuminate\Http\Request;
use App\Models\KatergoryPerias;
use App\Models\PenyewaanPerias;

class PenyewaanPeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KatergoryPerias::all();
        $perias = Perias::paginate(8);
        return view('client.penyewaan_mua.index',compact('perias','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('client.penyewaan_mua.form');
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
     * @param  \App\Models\PenyewaanPerias  $penyewaanPerias
     * @return \Illuminate\Http\Response
     */
    public function show($penyewaanPerias)
    {
        //
        $perias = Perias::find($penyewaanPerias);
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.penyewaan_mua.modal.detail',compact('perias'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenyewaanPerias  $penyewaanPerias
     * @return \Illuminate\Http\Response
     */
    public function edit(PenyewaanPerias $penyewaanPerias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenyewaanPerias  $penyewaanPerias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenyewaanPerias $penyewaanPerias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenyewaanPerias  $penyewaanPerias
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenyewaanPerias $penyewaanPerias)
    {
        //
    }

    public function cariPerias(Request $request){
        $query = '%'.$request->get('query').'%';
        $date_now = Carbon::now()->timezone('Asia/Jakarta')->toDateString();
    
        // $gaun = Gaun::where('nama', 'like', $query)->paginate(8);
        // return response()->json(array(
        //     'status' => 'oke',
        //     'msg' => view('client.penyewaan_gaun.data',compact('gaun','date_now'))->render()
        // ), 200);
    }
    
    
}
