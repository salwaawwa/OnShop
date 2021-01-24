<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['produk' , 'slug'];

    public function tipes(){
        return $this->hasMany(Tipe::class, 'produks_id', 'id');
    }

    public function mereks(){
        return $this->hasMany(Merek::class, 'produks_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
