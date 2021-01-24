<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = ['nama','email','telepon','pesan','slug','tanggal'];
}
