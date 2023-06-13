<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaun;
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
        // dd($currentTime->toDateString());
        // $data = Gaun::all();
        // foreach ($data as $key => $value) {
        //     // # code...
        //     dd($value->jadwal()->where('tanggal_waktu', 'like', $currentTime->toDateString().'%')->get());
        // }
        // Cek Jadwal Gaun 
        $gaun = Gaun::paginate(8);
        return view('client.penyewaan_gaun.index',compact('gaun','date_now'));
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
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.penyewaan_gaun.form_modal',compact('gaun'))->render()
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
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.penyewaan_gaun.detail',compact('gaun'))->render()
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
        $query = '%'.$request->get('query').'%';
        $gaun = Gaun::where('nama', 'like', $query)->paginate(8);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.penyewaan_gaun.data',compact('gaun'))->render()
        ), 200);
    }

}
