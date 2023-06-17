<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaun;
use App\Models\GambarGaun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gaun::all();
        return view('admin.list.gaun.index',compact('data'));
    }

    public function indexAjax()
    {
        $data = Gaun::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.gaun.table',compact('data'))->render()
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
        $gambars = $request->file('gambar');
        // dd($gambars);
        $gaun = new Gaun();
        $gaun->nama = $request->get('nama');
        $gaun->harga_sewa = $request->get('harga');
        $gaun->deskripsi = $request->get('deskripsi');
        $gaun->save();
        $id_new_gaun = $gaun->id;
        // Proses Gambar
        foreach ($gambars as $value) {
            # code...
            $path = public_path('gambar/gaun/' . $id_new_gaun);
            //Get filename
            // dd($value);
            $fileName = $value->getClientOriginalName();
    
            //Checking file directory path if path is doesnt exist move to the path.
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
                $value->move($path, $fileName);
            } else {
                $value->move($path, $fileName);
                
            }
            // Add To Database
            $gambar_gaun = new GambarGaun();
            $gambar_gaun->nama_file = $fileName;
            $gambar_gaun->gaun_id = $id_new_gaun;
            $gambar_gaun->save();
        }
        return response()->json(array('status' => 'success', 'msg' => 'Gaun '.$request->get('nama').' Berhasil Di Tambahkan'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gaun  $gaun
     * @return \Illuminate\Http\Response
     */
    public function show(Gaun $gaun)
    {
        //
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.gaun.update',compact('gaun'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gaun  $gaun
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaun $gaun)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gaun  $gaun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaun $gaun)
    {
        //
        try {
            $gaun->nama = $request->get('nama');
            $gaun->harga_sewa = $request->get('harga');
            $gaun->deskripsi = $request->get('deskripsi');
            $gaun->save();
            return response()->json(array('status' => 'success', 'msg' => 'Gaun '.$request->get('nama').' Berhasil Di Update'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'gagal', 'msg' => 'Gaun Gagal Di Update'), 200);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gaun  $gaun
     * @return \Illuminate\Http\Response
     */
    public function destroy($gaun)
    {
        //
        try {
            // Hapus Gambar 
            $gaun = Gaun::find($gaun);
            $gaun->gambars()->delete();
            $gaun->delete();
            return response()->json(array('status' => 'success', 'msg' => 'Gaun Berhasil Di Hapus'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'gagal', 'msg' => 'Gaun Gagal Di Delete'), 200);
        }
    }
}
