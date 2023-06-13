<?php

namespace App\Models;

use App\Models\Gaun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarGaun extends Model
{
    protected $table = 'gambar_gaun';
    use HasFactory;

    public function gauns(){
        return $this->belongsTo(Gaun::class,'gaun_id');
    }
}
