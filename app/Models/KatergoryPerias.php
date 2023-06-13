<?php

namespace App\Models;

use App\Models\Perias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatergoryPerias extends Model
{
    protected $table = 'kategori_perias';
    use HasFactory;
    public function perias(){
        return $this->hasMany(Perias::class,'kategori_perias_id','id');    
    }

}
