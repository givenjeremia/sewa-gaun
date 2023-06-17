<?php

namespace App\Http\Controllers;

use App\Models\HasilRias;
use App\Models\Perias;
use Illuminate\Http\Request;

class HasilRiasController extends Controller
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilRias  $hasilRias
     * @return \Illuminate\Http\Response
     */
    public function show( $hasilRias)
    {
        //
        $perias = Perias::find($hasilRias);
        $hasil_rias = HasilRias::where('perias_id', '=', $hasilRias)->get();
        $nama_perias = $perias->nama;
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.perias.detail_hasil_rias',compact('hasil_rias','nama_perias'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilRias  $hasilRias
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilRias $hasilRias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilRias  $hasilRias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilRias $hasilRias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilRias  $hasilRias
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilRias $hasilRias)
    {
        //
    }
}
