<?php

namespace App\Http\Controllers;

use App\Models\Perias;
use App\Models\HasilRias;
use Illuminate\Http\Request;
use App\Models\GambarHasilRias;
use App\Models\KatergoryPerias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori_perias = KatergoryPerias::all();
        return view('admin.list.perias.index', compact('kategori_perias'));
    }

    public function indexAjax()
    {
        $data = Perias::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.perias.table', compact('data'))->render()
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
        // dd($request->file('hasil_rias'));
        try {
            $perias = new Perias();
        $perias->nama = $request->get('nama');
        $perias->harga = $request->get('harga');
        $perias->deskripsi = $request->get('deskripsi');
        $perias->kategori_perias_id = $request->get('kategori_perias');
        $perias->save();
        $new_id_perias = $perias->id;
        $lenght_hasil_rias = count($request->file('hasil_rias'));
        for ($i = 0; $i < $lenght_hasil_rias; $i++) {
            # code...
            $nama_hasil_rias = $request->get('hasil_rias')[$i];
            $files =  $request->file('hasil_rias');
            // dd($l);
            // new Data Hasil Rias 
            $hasil_rias = new HasilRias();
            $hasil_rias->nama_rias = $nama_hasil_rias;
            $hasil_rias->perias_id = $new_id_perias;
            // dd($nama_hasil_rias);
            $hasil_rias->save();
            $id_hasil_rias_new = $hasil_rias->id;
            foreach ($files[$i] as $key => $value) {
                $path = public_path('gambar/perias/' . $new_id_perias . '/' . $id_hasil_rias_new);
                    $fileName = $value->getClientOriginalName();
                    // $fileName = $nama_hasil_rias.'-'.$fileName;
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                        $value->move($path, $fileName);
                        // dd($fileName);
                    } else {
                        $value->move($path, $fileName);
                    }
                    // Add To Database
                    $gambar_hasil_rias = new GambarHasilRias();
                    $gambar_hasil_rias->nama_file = $fileName;
                    $gambar_hasil_rias->hasil_rias_id = $id_hasil_rias_new;
                    $gambar_hasil_rias->save();
            }
            // dd( );
        }
        return response()->json(array('status' => 'success', 'msg' => 'Perias Berhasil Ditambahkan'), 200);
        } catch (\Throwable $th) {
        return response()->json(array('status' => 'error', 'msg' => 'Perias Gagal Di Tambahkan'), 200);
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perias  $perias
     * @return \Illuminate\Http\Response
     */
    public function show($perias)
    {
        //
        $perias = Perias::find($perias);
        $kategori_perias = KatergoryPerias::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.perias.update', compact('perias','kategori_perias'))->render()
        ), 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perias  $perias
     * @return \Illuminate\Http\Response
     */
    public function edit(Perias $perias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perias  $perias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$perias)
    {
        //
        // dd($perias);
        $perias = Perias::find($perias);
        $perias->nama = $request->get('nama');
        $perias->harga = $request->get('harga');
        $perias->deskripsi = $request->get('deskripsi');
        $perias->kategori_perias_id = $request->get('kategori_perias');
        $perias->save();
        return response()->json(array('status' => 'success', 'msg' => 'Perias Berhasil Di Ubah'), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perias  $perias
     * @return \Illuminate\Http\Response
     */
    public function destroy($perias)
    {
        //
        DB::beginTransaction();
        try {
            $hasil_rias = HasilRias::where('perias_id',$perias)->get();
            foreach ($hasil_rias as $key => $value) {
                $value->gambars()->delete();
            }
            $perias = Perias::find($perias);
            $perias->hasil_rias()->delete();
            $perias->delete();
            DB::commit();
            return response()->json(array('status' => 'success', 'msg' => 'Gaun Berhasil Di Hapus'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(array('status' => 'gagal', 'msg' => 'Gaun Gagal Di Delete '), 200);
        }
    }
}
