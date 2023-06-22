<?php

namespace App\Http\Controllers;

use App\Models\KategoriGaun;
use Illuminate\Http\Request;

class KategoriGaunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.list.kategori_gaun.index');
    }

    public function indexAjax()
    {
        $data = KategoriGaun::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.kategori_gaun.table',compact('data'))->render()
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
        try {
            $katergoriGaun = new KategoriGaun();
            $katergoriGaun->nama = $request->get('nama');
            $katergoriGaun->desc =  $request->get('desc');
            $katergoriGaun->save();
            return response()->json(array('status' => 'success', 'msg' => 'Kategori Gaun '.$request->get('nama').' Berhasil Di Tambahkan'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'error', 'msg' => 'Kategori Gaun Gagal Di Tambahkan Harap Periksa Inputan'), 200);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriGaun  $kategoriGaun
     * @return \Illuminate\Http\Response
     */
    public function show($kategoriGaun)
    {
        //
        $kategoriGaun = KategoriGaun::find($kategoriGaun);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.kategori_gaun.update',compact('kategoriGaun'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriGaun  $kategoriGaun
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriGaun $kategoriGaun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriGaun  $kategoriGaun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kategoriGaun)
    {
        //
        try {
            $kategoriGaun = KategoriGaun::find($kategoriGaun);
            $kategoriGaun->nama = $request->get('nama');
            $kategoriGaun->desc =  $request->get('desc');
            $kategoriGaun->save();
            return response()->json(array('status' => 'success', 'msg' => 'Kategori Gaun '.$request->get('nama').' Berhasil Di Update'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'error', 'msg' => 'Kategori Gaun Gagal Di Update Harap Periksa Inputan'), 200);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriGaun  $kategoriGaun
     * @return \Illuminate\Http\Response
     */
    public function destroy($kategoriGaun)
    {
        //
        try {
            $kategoriGaun = KategoriGaun::find($kategoriGaun);
            $kategoriGaun->delete();
            return response()->json(array('status' => 'success', 'msg' => 'Kategori Gaun Sukses Di Hapus'), 200);
        } catch (\Throwable $th) {
            return response()->json(array('status' => 'gagal', 'msg' => 'Kategori Gaun Gagal Di Hapus '), 200);

        }
    }
}
