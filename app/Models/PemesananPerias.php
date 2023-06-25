<?php

namespace App\Models;

use App\Models\Perias;
use App\Models\PembayaranPerias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananPerias extends Model
{
    use HasFactory;
    public function perias(){
        return $this->belongsToMany(Perias::class,'detail_pemesanan_perias','pemesanan_perias_id','perias_id');
    }
    public function pembayaran(){
        return $this->hasMany(PembayaranPerias::class,'pemesanan_perias_id','id');    
    }
}
