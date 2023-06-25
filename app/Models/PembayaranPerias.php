<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPerias extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_perias';

    public function gambar_pembayaran(){
        return $this->hasMany(GambarPembayaran::class,'pembayaran_perias_id','id');    
    }

    public function pemesanan(){
        return $this->belongsTo(PemesananPerias::class,'pemesanan_perias_id');  
    }
   

}
