<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipe;
use App\Spesifikasi;
use App\Pesanan;
use App\PesananDetail;
use App\user;
use Auth;
use Carbon\Carbon;

class CetakController extends Controller
{
    //function cetak history pesanan detail admin
    public function cetak_detail($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
       
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
            $spesifikasi = Spesifikasi::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            return abort(404);
        }

        return view('admin.cetak.cetak-detail',compact('pesanan','pesanan_details','user','spesifikasi'));
    }

    //function cetak history pesanan detail user
    public function cetak_pesanan_user($id) {
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            return abort(404);
        }

        return view('admin.cetak.cetak-detail',compact('pesanan','pesanan_details','user'));
    }
}
