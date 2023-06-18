<?php

namespace App\Models;

use App\Models\Perias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananPerias extends Model
{
    use HasFactory;
    public function perias(){
        return $this->belongsToMany(Perias::class,'detail_pemesanan_perias','pemesanan_perias_id','perias_id');
    }
}
