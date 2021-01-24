<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $fillable = ['tipes_id','pesanans_id','banyak','jumlah_harga','nota'];

    public function tipes(){
        return $this->belongsTo('App\Tipe','tipes_id','id');
    }
    
    public function pesanan(){
        return $this->belongsTo('App\Pesanan','pesanans_id','id');
    }

    public function spesifikasi(){
        return $this->hasMany('App\Spesifikasi','pesanan_details_id','id');
    }
}
