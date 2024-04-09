<?php

namespace App\Http\Controllers;

use App\Models\Gaun;
use App\Models\Paket;
use App\Models\Perias;
use App\Models\GambarPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Paket::all();
        return view('admin.list.paket.index', compact('data'));
    }

    public function indexAjax()
    {
        $data = Paket::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.paket.table', compact('data'))->render()
        ), 200);
    }

    public function indexLanding()
    {
        $data = Paket::paginate(6);
        return view('client.paket.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $paket = Paket::find($id);
        $gaun = Gaun::all();
        $perias = Perias::all();
        return response()->json(array(
            'status' => 'success',
            'msg' => view('client.paket.form',compact('paket','gaun','perias'))->render()
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
        $user = Auth::user();
        // dd($request->get('deskripsi'));
        $gambars = $request->file('gambar');

        $paket = new Paket();
        $paket->nama = $request->get('nama');
        $paket->desc = $request->get('deskripsi');
        $paket->harga = $request->get('harga');
        $paket->jumlah_gaun = $request->get('jumlah_gaun');
        $paket->jumlah_perias = $request->get('jumlah_perias');
        $paket->users_id = $user->id;
        $paket->save();
        $id_new_paket = $paket->id;
        // Proses Gambar
        foreach ($gambars as $value) {
            # code...
            $path = public_path('gambar/paket/' . $id_new_paket);
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
            $gambar_paket = new GambarPaket();
            $gambar_paket->file_name = $fileName;
            $gambar_paket->paket_id = $id_new_paket;
            $gambar_paket->save();
        }
        return response()->json(array('status' => 'success', 'msg' => 'Paket ' . $request->get('nama') . ' Berhasil Di Tambahkan'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.paket.detail',compact('paket'))->render()
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.list.paket.update',compact('paket'))->render()
        ), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        //
        try {
            $user = Auth::user();
            $paket->nama = $request->get('nama');
            $paket->desc = $request->get('deskripsi');
            $paket->harga = $request->get('harga');
            $paket->jumlah_gaun = $request->get('jumlah_gaun');
            $paket->jumlah_perias = $request->get('jumlah_perias');
            $paket->users_id = $user->id;
            $paket->save();
            return response()->json(array('status' => 'success', 'msg' => 'Paket ' . $request->get('nama') . ' Berhasil Di Tambahkan'), 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($paket)
    {
        //
        DB::BeginTransaction();
        try {
            // Hapus Gambar 
            $paket = Paket::find($paket);
            $paket->gambars()->delete();
            $paket->delete();
            DB::commit();
            return response()->json(array('status' => 'success', 'msg' => 'Paket Berhasil Di Hapus'), 200);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(array('status' => 'gagal', 'msg' => 'Paket Gagal Di Delete'), 200);
        }
    }
}
