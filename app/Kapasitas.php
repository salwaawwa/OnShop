<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kapasitas extends Model
{
    protected $fillable = ['kapasitas', 'harga', 'cathards_id', 'slug'];

    public function cathards() {
        return $this->belongsTo('App\Cathard','cathards_id','id');
    }

    public function spesifikasi(){
        return $this->hasMany(Spesifikasi::class,'kapasitas_id','id');
    }
}
