<?php

namespace App\Models;

use App\Models\GambarPaket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    public function gambars(){
        return $this->hasMany(GambarPaket::class,'paket_id','id');
    }

}
