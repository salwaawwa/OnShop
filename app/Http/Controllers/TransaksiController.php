<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipe;
use App\Pesanan;
use App\PesananDetail;
use App\user;
use App\Spesifikasi;
use App\Cathard;
use App\Kapasitas;
use Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    //function pembelian
    public function pesanan(Request $request,$id){
       

        if(Auth::check() == NULL){
            return redirect()->route('login')->with('fail','Anda Belum Login. Silahkan Login Dahulu');
        }else{
            $latest = Pesanan::latest()->first();

            if (! $latest || !$latest->invoice_number) {
               $invoice_number = 'IM0001';
            }
            else{
                $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_number);
                $invoice_number = 'IM' . sprintf('%04d', $string+1);
            }
    
            // Deskripsi ID
            $tipe = Tipe::where('id',$id)->first();
            $categhard = Cathard::where('id',$id)->first();
            $kapasitas = Kapasitas::where('id',$id)->first();
            $tanggal = Carbon::now();
    
            // Validasi Apakah Melebihi Stok
            if((int)$request->jumlah_pesanan > (int)$tipe->stok)
            {
                return redirect()->back()->with('fail','Jumlah Pesanan Melebihi Stok Tersedia');
            }
            
            // Cek Validasi
            $cek_pesanan = Pesanan::where('users_id',Auth::user()->id)->where('status',0)->first();
            // Simpan Ke DB Pesanan
            if(empty($cek_pesanan)){
                $pesanan = new Pesanan;
                $pesanan->users_id = Auth::user()->id;
                $pesanan->tanggal = $tanggal;
                $pesanan->status = 0;
                $pesanan->total_bayar = 0;
                $pesanan->invoice_number = $invoice_number;
                $pesanan->save();
            }

            

            // Simpan Ke DB Pesanan Detail
            $pesanan_baru = Pesanan::where('users_id',Auth::user()->id)->where('status',0)->first();
            // Cek Pesanan Detail
            $cek_pesanan_detail = PesananDetail::where('tipes_id',$tipe->id)->where('pesanans_id',
                                $pesanan_baru->id)->first();

            if(empty($cek_pesanan_detail)){
                $pesanan_detail = new PesananDetail;
                $pesanan_detail->tipes_id = $tipe->id;
                $pesanan_detail->pesanans_id = $pesanan_baru->id;
                $pesanan_detail->banyak = $request->jumlah_pesanan;
                $pesanan_detail->invoice_number = $cek_pesanan ? $cek_pesanan->invoice_number : $pesanan->invoice_number ;
                if($tipe->costum == 0){
                    $pesanan_detail->jumlah_harga = $tipe->harga*$request->jumlah_pesanan;
                }
                if($tipe->costum == 1){
                    $pesanan_detail->jumlah_harga =0;
                }
                $pesanan_detail->save();
                    if($tipe->costum == 1){ 
                        $totalHargaSpek = 0;
                        foreach($request->hardware as $key=>$value){
                            $kapasitas = Kapasitas::find($value);
                            $spek = new Spesifikasi;
                            $spek->pesanans_id = $pesanan_baru->id;
                            $spek->pesanan_details_id = $pesanan_detail->id;
                            $spek->cathards_id = $key;
                            $spek->kapasitas_id = $value;
                            $spek->invoice_number = $cek_pesanan ? $cek_pesanan->invoice_number : $pesanan->invoice_number ;
                            $spek->jumlah_harga = $kapasitas->harga;

                            $totalHargaSpek += $kapasitas->harga;
                            $spek->save();
                        }

                        $pesanan_detail->jumlah_harga = $totalHargaSpek*$request->jumlah_pesanan;
       
                    } 
                $pesanan_detail->update();
                

            }
            else{
                $pesanan_detail = PesananDetail::where('tipes_id',$tipe->id)->where('pesanans_id',$pesanan_baru->id)->first();

                $pesanan_detail->banyak = $pesanan_detail->banyak+$request->jumlah_pesanan;

                // Harga Sekarang
                if($tipe->costum == 0){
                    $harga_pesan_detail_baru = $tipe->harga*$request->jumlah_pesanan;
                    $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+ $harga_pesan_detail_baru;
                }if($tipe->costum == 1){ 
                    $spesifikasi = Spesifikasi::where('pesanans_id',$pesanan_baru->id)->first();
                    $totalHargaSpek = 0;
                        foreach($request->hardware as $key=>$value){
                            $kapasitas = Kapasitas::find($value);
                            $spesifikasi->cathards_id = $key;
                            $spesifikasi->kapasitas_id = $value;
                            $spesifikasi->jumlah_harga = $kapasitas->harga;

                            $totalHargaSpek += $kapasitas->harga;
                            $spesifikasi->save();
                        }

                    $harga_pesan_detail_baru = $totalHargaSpek*$request->jumlah_pesanan;
                    $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesan_detail_baru;
                    //$harga_pesan_detail_baru = $pesanan_detail->jumlah_harga*$request->jumlah_pesanan;
                }
                $pesanan_detail->update();
            }

            //jumlah Total
            $pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status',0)->first();
            $totalPrice = PesananDetail::where('pesanans_id',$pesanan->id)->sum('jumlah_harga');
            $pesanan->total_bayar = $totalPrice;
            $pesanan->update();

            return redirect('check-out')->with('success','Barang Berhasil Dimasukan Keranjang');
            
        }
    }

    //function keranjang user
    public function keranjang(){
        $pesanan = Pesanan::where('users_id',  Auth::user()->id)->where('status',0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('transaksi.keranjang',compact('pesanan','pesanan_details'));
    }

    //function delete barang di keranjang user
    public function delete($id){

        $pesanan_detail = PesananDetail::findorfail($id);
        $spesifikasi = Spesifikasi::where('pesanan_details_id', $pesanan_detail->id)->get();

        $pesanan = Pesanan::where('id' ,$pesanan_detail->pesanans_id)->first();
        $pesanan->total_bayar = $pesanan->total_bayar - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        try{
            //Kalo sukses
            $ids = [];
            foreach($spesifikasi as $item){
                array_push($ids,[
                    $item->id,
                ]);
            }

            Spesifikasi::destroy($ids);
            $pesanan_detail->delete();

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
        }

        return redirect('check-out');
    }

    //function buton "checkout" di keranjang user
    public function checkout(){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('users_id',Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanans_id',$pesanan_id)->get();
        foreach($pesanan_details as $pesanan_detail)
        {
            $tipe = Tipe::where('id',$pesanan_detail->tipes_id)->first();
            $tipe->stok = $tipe->stok - $pesanan_detail->banyak;
            $tipe->update();
        }

        return redirect('history/'.$pesanan_id)->with('success','Pesanan Berhasil Di Check-out');
    }
    
}
