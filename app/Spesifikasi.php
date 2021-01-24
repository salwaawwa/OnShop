<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesifikasi extends Model
{
    protected $fillable = ['pesanans_id', 'pesanan_details_id', 'cathards_id', 'kapasitas_id', 'invoice_number', 'jumlah_harga'];

    public function pesanans(){
        return $this->belongsTo('App\Pesanan');
    }

    public function pesanan_detail(){
        return $this->belongsTo('App\PesananDetail');
    }

    public function cathards(){
        return $this->hasMany('App\Cathards','cathards_id','id');
    }

    public function kapasitas(){
        return $this->hasMany('App\Kapasitas','kapasitas_id','id');
    }
}
