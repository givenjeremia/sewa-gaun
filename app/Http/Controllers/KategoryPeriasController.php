<?php

namespace App\Http\Controllers;

use App\Models\KatergoryPerias;
use Illuminate\Http\Request;

class KategoryPeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.list.kategori_perias.index');
    }

    public function indexAjax()
    {
        $data = KatergoryPerias::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.kategori_perias.table',compact('data'))->render()
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
        $katergoryPerias = new KatergoryPerias();
        $katergoryPerias->nama = $request->get('nama');
        $katergoryPerias->desc =  $request->get('desc');
        $katergoryPerias->save();
        return response()->json(array('status' => 'success', 'msg' => 'Kategori Perias '.$request->get('nama').' Berhasil Di Tambahkan'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KatergoryPerias  $katergoryPerias
     * @return \Illuminate\Http\Response
     */
    public function show($katergoryPerias)
    {
        //
        $katergoryPerias = KatergoryPerias::find($katergoryPerias);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.kategori_perias.update',compact('katergoryPerias'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KatergoryPerias  $katergoryPerias
     * @return \Illuminate\Http\Response
     */
    public function edit(KatergoryPerias $katergoryPerias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KatergoryPerias  $katergoryPerias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $katergoryPerias)
    {
        //
        $katergoryPerias = KatergoryPerias::find($katergoryPerias);
        $katergoryPerias->nama = $request->get('nama');
        $katergoryPerias->desc =  $request->get('desc');
        $katergoryPerias->save();
        return response()->json(array('status' => 'success', 'msg' => 'Kategori Perias '.$request->get('nama').' Berhasil Di Update'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KatergoryPerias  $katergoryPerias
     * @return \Illuminate\Http\Response
     */
    public function destroy($katergoryPerias)
    {
        //
        try {
            $katergoryPerias = KatergoryPerias::find($katergoryPerias);
            $katergoryPerias->delete();
            return response()->json(array('status' => 'success', 'msg' => 'Kategori Perias Sukses Di Hapus'), 200);
        } catch (\Throwable $th) {
            return response()->json(array('status' => 'gagal', 'msg' => 'Kategori Perias Gagal Di Hapus '), 200);

        }
    }
}
