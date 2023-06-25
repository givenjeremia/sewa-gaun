<?php

namespace App\Models;

use App\Models\Paket;
use App\Models\Perias;
use App\Models\GambarPembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananPaket extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_paket';

    public function perias(){
        return $this->belongsToMany(Perias::class,'perias_has_pemesanan_paket','pemesanan_paket_id','perias_id');
    }

    public function gaun(){
        return $this->belongsToMany(Gaun::class,'pemesanan_paket_has_gaun','pemesanan_paket_id','gaun_id')->withPivot('pengembalian','pengambilan');
    }

    public function paket(){
        return $this->belongsTo(Paket::class,'paket_id');    
    }

    public function gambar_pemesanan(){
        return $this->hasMany(GambarPembayaran::class,'pemesanan_paket_id','id');    
    }
    // public function gambar_pemesanan(){
    //     return $this->belongsTo(GambarPembayaran::class,'pemesanan_paket_id');  
    // }

}
