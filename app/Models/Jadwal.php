<?php

namespace App\Models;

use App\Models\Gaun;
use App\Models\Perias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';

    public function gaun(){
        return $this->belongsTo(Gaun::class,'gaun_id');
    }

    public function perias(){
        return $this->belongsTo(Perias::class,'perias_id');
    }

}
