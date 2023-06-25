<?php

namespace App\Models;

use App\Models\PemesananGaun;
use App\Models\GambarPembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranGaun extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_gaun';

    public function gambar_pembayaran(){
        return $this->hasMany(GambarPembayaran::class,'pembayaran_gaun_id','id');    
    }

    public function pemesanan(){
        return $this->belongsTo(PemesananGaun::class,'pemesanan_gaun_id');  
    }

 

}
