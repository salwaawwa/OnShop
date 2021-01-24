<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\PesananDetail;
use Auth;
use App\User;
use DataTables;

class HistoryController extends Controller
{
    //function history user
    public function index(){
        $pesanan = Pesanan::where('users_id',Auth::user()->id)->latest()->get();
        return  view('history.index', compact('pesanan'));
    }

    //function history detail user
    public function detail($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('history.detail',compact('pesanan','pesanan_details','user'));
    }

    //function history admin index
    public function history_pesanan_admin(){
        return view ('admin.history.index');
    }

    //function history admin detail
    public function history_det($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('admin.history.history-detail',compact('pesanan','pesanan_details','user'));
    }

    //function data history admin
    public function data(){
        $data = Pesanan::where('status',4)->get();

        if( $data === null ) 
        { 
            return 'No data available'; 
        }else{
            return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($data){
                            if($data->status == 1){
                                return "<span class='badge badge-pill badge-warning'>Menunggu Diterima</span>";
                            }else if($data->status == 2){
                                return "<span class='badge badge-pill badge-info'>Pesanan Sedang Dirakit</span>";
                            }else if($data->status == 3){
                                return "<span class='badge badge-dark'>Menunggu diambil Pembeli</span>";
                            }else if($data->status == 4){
                                return "<span class='badge badge-success'>Pesanan Selesai</span>";
                            }
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'.route("history-pesanan.detail" , $data->id).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
        }
    }
}
