<?php

namespace App\Models;

use App\Models\Gaun;
use App\Models\PembayaranGaun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananGaun extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_gaun';

    public function gaun(){
        return $this->belongsToMany(Gaun::class,'detail_pemesanan_gaun','pemesanan_gaun_id','gaun_id');
    }

    public function pembayaran(){
        return $this->hasOne(PembayaranGaun::class,'pemesanan_gaun_id','id');    
    }

}
