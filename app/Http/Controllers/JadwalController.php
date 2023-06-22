<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaun;
use App\Models\Jadwal;
use App\Models\Perias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($jenis)
    {
        //
        $jadwal = [];
        if($jenis == 'gaun'){
            $jadwal =  Jadwal::where('gaun_id','!=',null)->get();
        }
        else{
            $jadwal =  Jadwal::where('perias_id','!=',null)->get();
        }
        $years_now = Carbon::now()->year;
        $month_now = Carbon::now()->month;
        $month = $years_now.'-'.$month_now;
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        $date_1_month = [];
        while ($start->lte($end)) {
            $date_1_month[] = $start->copy()->toDateString();
            $start->addDay();
        }
        foreach($date_1_month as $key => $month){
            $date_1_month[$key] =[];
            array_push($date_1_month[$key],$month);
            $date_1_month[$key][1] = [];
            foreach ($jadwal as  $value) {
                $jadwal_date =  Carbon::parse($value->tanggal_waktu);
                if($month == $jadwal_date->toDateString() ) {
                    array_push($date_1_month[$key][1],['id_jadwal'=>$value->id]);
                }

            }           
        }
        // dd($date_1_month);
        $gaun = Gaun::all();
        $perias = Perias::all();
        return view('admin.jadwal.index',['role' => $jenis,'date_1_month'=>$date_1_month,'gaun'=>$gaun,'perias'=>$perias]);
    }

    public function jadwalSortGaun($sort_by)
    {
        $before = Jadwal::whereDate('tanggal_waktu', 'like',$sort_by.'%')->get();
        $jadwal =  Jadwal::where('gaun_id','!=',null)->get();
        $start = Carbon::parse($sort_by)->startOfMonth();
        $end = Carbon::parse($sort_by)->endOfMonth();
        $date_1_month = [];
        while ($start->lte($end)) {
            $date_1_month[] = $start->copy()->toDateString();
            $start->addDay();
        }
        foreach($date_1_month as $key => $month){
            $date_1_month[$key] =[];
            array_push($date_1_month[$key],$month);
            $date_1_month[$key][1] = [];
            foreach ($jadwal as  $value) {
                $jadwal_date =  Carbon::parse($value->tanggal_waktu);
                if($month == $jadwal_date->toDateString() ) {
                    array_push($date_1_month[$key][1],['id_jadwal'=>$value->id]);
                }

            }           
        }
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.jadwal.gaun',compact('date_1_month'))->render()
        ), 200);
    }
    public function jadwalSortPerias($sort_by)
    {
        $before = Jadwal::whereDate('tanggal_waktu', 'like',$sort_by.'%')->get();
        $jadwal =  Jadwal::where('perias_id','!=',null)->get();
        $start = Carbon::parse($sort_by)->startOfMonth();
        $end = Carbon::parse($sort_by)->endOfMonth();
        $date_1_month = [];
        while ($start->lte($end)) {
            $date_1_month[] = $start->copy()->toDateString();
            $start->addDay();
        }
        foreach($date_1_month as $key => $month){
            $date_1_month[$key] =[];
            array_push($date_1_month[$key],$month);
            $date_1_month[$key][1] = [];
            foreach ($jadwal as  $value) {
                $jadwal_date =  Carbon::parse($value->tanggal_waktu);
                if($month == $jadwal_date->toDateString() ) {
                    array_push($date_1_month[$key][1],['id_jadwal'=>$value->id]);
                }

            }           
        }
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.jadwal.gaun',compact('date_1_month'))->render()
        ), 200);
    }

    public function getDetailPerias($tanggal){
        $jadwal = Jadwal::whereDate('tanggal_waktu', 'like',$tanggal.'%')->where('perias_id','!=',null)->first();
        $jenis = 'perias';
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.jadwal.detail_jadwal',compact('jadwal','jenis'))->render()
        ), 200);
    }

    public function getDetailGaun($tanggal){
        $jadwal = Jadwal::whereDate('tanggal_waktu', 'like',$tanggal.'%')->where('gaun_id','!=',null)->get();
        // dd($jadwal);
        $jenis = 'gaun';
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.jadwal.detail_jadwal',compact('jadwal','jenis','tanggal'))->render()
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
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }

    

}
