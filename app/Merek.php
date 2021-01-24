<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $fillable = ['Merk','slug','produks_id'];
    
    public function produks(){
        return $this->belongsTo('App\produk');
    }

    public function tipes(){
        return $this->hasMany(Tipe::class, 'mereks_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
