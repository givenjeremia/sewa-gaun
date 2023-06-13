<?php

namespace App\Models;

use App\Models\GambarHasilRias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilRias extends Model
{
    protected $table = 'hasil_rias';

    use HasFactory;

    // public function gambars(){
    //     return $this->belongsTo(GambarHasilRias::class,'hasil_rias_id');
    // }

    public function gambars(){
        return $this->hasMany(GambarHasilRias::class,'hasil_rias_id','id');    
    }
    

}
