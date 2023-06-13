<?php

namespace App\Http\Controllers;

use App\Models\Gaun;
use App\Models\GambarGaun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GambarGaunController extends Controller
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
     * @param  \App\Models\GambarGaun  $gambarGaun
     * @return \Illuminate\Http\Response
     */
    public function show($id_gaun)
    {
        //
        $gambar_gaun = GambarGaun::where('gaun_id',$id_gaun)->get();
        $gaun = Gaun::find($id_gaun);
        $nama_gaun = $gaun->nama;
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.gaun.detail_gambar',compact('gambar_gaun','nama_gaun'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarGaun  $gambarGaun
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarGaun $gambarGaun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarGaun  $gambarGaun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarGaun $gambarGaun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarGaun  $gambarGaun
     * @return \Illuminate\Http\Response
     */
    public function destroy($gambarGaun)
    {
        //
        try {
            $gambar_gaun = GambarGaun::find($gambarGaun);
            $id_gaun = $gambar_gaun->gaun_id;
            $file_name = $gambar_gaun->nama_file;
            // Delete File
            $path = public_path('gambar/gaun/'.$id_gaun.'/'.$file_name);
            File::delete(public_path($path));
            // Delete From DB
            $gambar_gaun->delete();
            return response()->json(array('status' => 'success', 'msg' => 'Gambar Gaun Di Hapus'), 200);

        } catch (\Throwable $th) {
            return response()->json(array('status' => 'gagal', 'msg' => 'Gambar Gaun Gagal Di Hapus'), 200);
        }
    }
}
