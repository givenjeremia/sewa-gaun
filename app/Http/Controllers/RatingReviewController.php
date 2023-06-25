<?php

namespace App\Http\Controllers;

use App\Models\RatingReview;
use Illuminate\Http\Request;
use App\Models\PemesananGaun;
use App\Models\PemesananPaket;
use App\Models\PemesananPerias;

class RatingReviewController extends Controller
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
    public function create($jenis,$pemesanan_id)
    {
        //
        if($jenis == 'gaun'){
            $pemesanan = PemesananGaun::find($pemesanan_id);
        }
        elseif($jenis == 'perias'){
            $pemesanan = PemesananPerias::find($pemesanan_id);
        }
        else{
            $pemesanan = PemesananPaket::find($pemesanan_id);
        }
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('client.transaksi.review', compact('pemesanan','jenis'))->render()
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
        try {
            if($request->get('jenis') == 'gaun'){
                $new = new RatingReview();
                $new->bintang = $request->get('rating');
                $new->review = $request->get('review');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->gaun_id = $request->get('gaun_id');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => "Rating Review Berhasil Di Tambahkan"
                ), 200);
            }
            else if($request->get('jenis') == 'perias'){
                $new = new RatingReview();
                $new->bintang = $request->get('rating');
                $new->review = $request->get('review');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->perias_id = $request->get('perias_id');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => 'Rating Review Berhasil Di Tambahkan'
                ), 200);
            }
            else{
                $new = new RatingReview();
                $new->bintang = $request->get('rating');
                $new->review = $request->get('review');
                $new->nomor_pemesanan = $request->get('nomor_pemesanan');
                $new->save();
                return response()->json(array(
                    'status' => 'success',
                    'msg' => 'Rating Review Berhasil Di Tambahkan'
                ), 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array(
                'status' => 'errorr',
                'msg' => 'Rating Review Gagal Di Tambahkan '.$th->getMessage()
            ), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RatingReview  $ratingReview
     * @return \Illuminate\Http\Response
     */
    public function show(RatingReview $ratingReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RatingReview  $ratingReview
     * @return \Illuminate\Http\Response
     */
    public function edit(RatingReview $ratingReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RatingReview  $ratingReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RatingReview $ratingReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RatingReview  $ratingReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(RatingReview $ratingReview)
    {
        //
    }
}
