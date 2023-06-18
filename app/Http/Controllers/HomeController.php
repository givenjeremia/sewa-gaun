<?php

namespace App\Http\Controllers;

use App\Models\Gaun;
use App\Models\Paket;
use App\Models\Perias;
use Illuminate\Http\Request;

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
        $paket = Paket::all();
        $gaun = Gaun::with('pemesanan_gaun')->withCount('pemesanan_gaun')->orderBy('pemesanan_gaun_count', 'desc')->limit(5)->get();
        $perias = Perias::with('pemesanan_perias')->withCount('pemesanan_perias')->orderBy('pemesanan_perias_count', 'desc')->limit(5)->get();
        
        return view('client.landing-page.index',compact('paket','gaun','perias'));
    }
}
