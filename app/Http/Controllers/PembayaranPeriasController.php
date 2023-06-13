<?php

namespace App\Http\Controllers;

use App\Models\PembayaranPerias;
use Illuminate\Http\Request;

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
        return view('admin.transaksi.index',['title'=>'Perias']);
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
     * @param  \App\Models\PembayaranPerias  $pembayaranPerias
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranPerias $pembayaranPerias)
    {
        //
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
}
