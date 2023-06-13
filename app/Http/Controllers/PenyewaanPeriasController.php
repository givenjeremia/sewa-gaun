<?php

namespace App\Http\Controllers;

use App\Models\Perias;
use Illuminate\Http\Request;
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
        //
        return view('client.penyewaan_mua.index');
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
            'msg' => view('client.perias.detail',compact('perias'))->render()
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
}
