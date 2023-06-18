<?php

namespace App\Models;

use App\Models\HasilRias;
use App\Models\KatergoryPerias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perias extends Model
{
    protected $table = 'perias';
    use HasFactory;
    public function kategori_perias(){
        return $this->belongsTo(KatergoryPerias::class,'kategori_perias_id');
    }

    public function hasil_rias(){
        return $this->hasMany(HasilRias::class,'perias_id','id');    
    }

    public function pemesanan_perias(){
        return $this->belongsToMany(PemesananPerias::class,'detail_pemesanan_perias','perias_id','pemesanan_perias_id');
    }
}
