<?php

namespace App\Helpers;

Class Awa
{

    public static function Rupiah($value)
    {

        if($value > 0){
            return "Rp. " . number_format($value, 0, ',', '.');
        }
    }

}