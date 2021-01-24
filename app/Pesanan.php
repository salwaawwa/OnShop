<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['users_id','tanggal','nota','total_bayar','status'];
   
    public function user(){
        return $this->belongsTo('App\User','users_id','id');
    }

    public function pesanan_detail(){
        return $this->hasMany('App\PesananDetail','pesanans_id','id');
    }

    public function spesifikasi(){
        return $this->hasMany('App\Spesifikasi','pesanans_id','id');
    }
}
