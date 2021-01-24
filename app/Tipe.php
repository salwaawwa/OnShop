<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $fillable = ['tipe','slug','mereks_id','produks_id','harga','stok','note','costum','gambar'];

    public function mereks(){
        return $this->belongsTo('App\Merek');
    }

    public function produks(){
        return $this->belongsTo('App\Produk');
    }
}
