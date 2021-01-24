<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Tipe;
use App\Merek;
use App\Cathard;
use App\Kapasitas;

class BerandaController extends Controller
{
    public function beranda(Tipe $tipes){
        $produks = Produk::all();

        $data = $tipes->latest()->take(9)->get();
        return view('web.beranda',compact('data','produks'));
    }

    public function produk(){
        $produks = Produk::all();
        
        $data = Tipe::paginate(12);
        return view('web.produk',compact('produks','data'));
    }

    public function list_produk(Produk $produk){
        $produks = Produk::all();
    
        $data = $produk->tipes()->paginate(15);
        $data2 = $produk->mereks()->paginate(15);
        return view('web.produk-categori',compact('produks','data','data2'));
    }

    public function list_produk_merk(Merek $merek){
        $produks = Produk::all();
    
        $data3 = $merek->tipes()->paginate(15);
        return view('web.produk-merek',compact('produks','data3'));
    }

    public function produk_detail($slug){
        $produks = Produk::all();

        $cathards = Cathard::with('kapasitas')->get();
        $data = Tipe::where('slug',$slug)->first();
        return view('web.produk-det',compact('produks','data','cathards'));
    }
}
