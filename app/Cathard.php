<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cathard extends Model
{
    protected $fillable = ['hardware','slug'];

    public function kapasitas(){
        return $this->hasMany(Kapasitas::class, 'cathards_id', 'id');
    }

    public function spesifikasi(){
        return $this->hasMany('App\Spesifikasi','cathards_id','id');
    }
}
