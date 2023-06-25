<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Gaun;
use App\Models\Paket;
use App\Models\Jadwal;
use App\Models\Perias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->roles;

        if ($role == 1) {
            return redirect('/admin/gaun');
        } else if ($role == 2) {
            return redirect('/admin/perias');
        }
        else if ($role == 0){
            return redirect('/admin/gaun');
        }
    
        $paket = Paket::all();
        $gaun = Gaun::with('pemesanan_gaun')->withCount('pemesanan_gaun')->orderBy('pemesanan_gaun_count', 'desc')->limit(5)->get();
        $perias = Perias::with('pemesanan_perias')->withCount('pemesanan_perias')->orderBy('pemesanan_perias_count', 'desc')->limit(5)->get();
        
        return view('client.landing-page.index',compact('paket','gaun','perias'));
    }
    public function indexJadwal()
    {
     
        return view('client.jadwal.index');
    }

    public function indexJadwalAjax()
    {
        $jadwal =  Jadwal::all();
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
            // $date_1_month[$key][1] = [];
            $date_1_month[$key]['perias']= [];
            $date_1_month[$key]['gaun']= [];
            foreach ($jadwal as  $value) {
                $jadwal_date =  Carbon::parse($value->tanggal_waktu);
                if($month == $jadwal_date->toDateString() ) {
                    if($value->gaun_id == null){
                        array_push($date_1_month[$key]['perias'],$value->id);
                        
                    }
                    else{
                        array_push($date_1_month[$key]['gaun'],$value->id);
                    }
                }
            }           
        }
        // dd($date_1_month);
        $keterangan = $month_now;
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.jadwal.table',compact('date_1_month','keterangan'))->render()
        ), 200);
    }

    public function sortByDate($start,$end)
    {
        $jadwal = Jadwal::whereBetween('tanggal_waktu', [$start,$end])->get();
       
        $date_1_month = [];
        foreach ($jadwal as $key  =>  $value) {
            $jadwal_date =  Carbon::parse($value->tanggal_waktu);
            // dd($jadwal_date);
            $date_1_month[$key] =[];
            array_push($date_1_month[$key],$jadwal_date->toDateString());
            $date_1_month[$key]['perias']= [];
            $date_1_month[$key]['gaun']= [];
            if($value->gaun_id == null){
                array_push($date_1_month[$key]['perias'],$value->id);
                
            }
            else{
                array_push($date_1_month[$key]['gaun'],$value->id);
            }
        } 
        $start = new DateTime($start);
        $start = $start->format('j F Y');
        $end = new DateTime($end);
        $end = $end->format('j F Y');
        $keterangan = $start.' Hingga '.$end;
        // dd($date_1_month);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.jadwal.table',compact('date_1_month','keterangan'))->render()
        ), 200);
    }

}
