<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\GambarGaun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaun extends Model
{
    protected $table = 'gaun';
    use HasFactory;

    public function gambars(){
        return $this->hasMany(GambarGaun::class,'gaun_id','id');
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class,'gaun_id','id');
    }

    public function pemesanan_gaun(){
        return $this->belongsToMany(PemesananGaun::class,'detail_pemesanan_gaun','gaun_id','pemesanan_gaun_id');
    }

}
