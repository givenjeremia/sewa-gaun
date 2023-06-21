<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaun;
use App\Models\KatergoryPerias;
use Illuminate\Http\Request;
use App\Models\PenyewaanGaun;

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
        return view('client.penyewaan_gaun.index',compact('gaun','date_now' ));
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

   

}
