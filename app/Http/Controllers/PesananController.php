<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipe;
use App\Pesanan;
use App\PesananDetail;
use App\user;
use Auth;
use Carbon\Carbon;
use DataTables;

class PesananController extends Controller
{
    //function list pesanan index
    public function admin_index(){
        return view('admin.pesanan.pesanan-index');
    }

    //function show pesanan admin
    public function show($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('admin.pesanan.pesanan-show',compact('pesanan','pesanan_details','user'));
    }

    //function button "diterima" di show pesanan admin
    public function konfirmasi($id){
        $pesanan = Pesanan::where('id',$id)->where('status',1)->first();
        $pesanan_id = $pesanan->id;

        $pesanan->status = 2;
        $pesanan->update();

        return redirect()->route('pesanan-admin.index')->with('success','Pesanan Berhasil Diterima');
    }

    //function delete di list pesanan admin
    public function destroy($id){ 
        $pesanan = Pesanan::findorfail($id);
        $detail = PesananDetail::where('invoice_number', $pesanan->invoice_number)->get();

        try{
            //Kalo sukses
            $ids = [];
            foreach($detail as $item){
                array_push($ids,[
                    $item->id,
                ]);
            }

            PesananDetail::destroy($ids);
            $pesanan->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Pesanan berhasil di hapus'
            ]);

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
             return response()->json([
                'status' => false,
                'pesan'  => 'Pesanan gagal di hapus'
            ]);
        }

    }

    //function list pesanan dirakit index
    public function pesanan_dirakit_index(){
        return view('admin.pesanan.pesanan-dirakit-index');
    }

    //function show pesanan dirakit
    public function show_dirakit($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('admin.pesanan.pesanan-dirakit-show',compact('pesanan','pesanan_details','user'));
    }

    //function button "diterima" di show pesanan dirakit admin
    public function konfirmasi_dirakit($id){
        $pesanan = Pesanan::where('id',$id)->where('status',2)->first();
        $pesanan_id = $pesanan->id;

        $pesanan->status = 3;
        $pesanan->update();

        return redirect()->route('pesanan-dirakit.index')->with('success','Berhasil Konfirmasi Pesanan Selesai Dirakit ');
    }

    //function list pesanan selesai index
    public function pesanan_selesai_index(){
        return view('admin.pesanan.pesanan-selesai-index');
    }

    //function show pesanan selesai
    public function show_selesai($id){
        $user = user::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('id',$id)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanans_id', $pesanan->id)->get();
        }
        else{
            $pesanan_details = PesananDetail::where('pesanans_id',null)->get();
        }

        return view('admin.pesanan.pesanan-selesai-show',compact('pesanan','pesanan_details','user'));
    }

    //function button "diambil" di list selesai index
    public function konfirmasi_selesai($id){
        $pesanan = Pesanan::where('id',$id)->where('status',3)->first();
        $pesanan_id = $pesanan->id;

        $pesanan->status = 4;
        $pesanan->update();

        return redirect()->route('pesanan-selesai.index')->with('success','Pesanan Sudah Diterima Oleh Pembeli');

    }

    //function data pesanan
    public function data()
    {
        $data = Pesanan::where('status','!=',  4)->latest()->get();

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
                            $button = '<a href="'.route("pesanan.show" , $data->id).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    //function data pesanan dirakit
    public function data_dirakit(){
        $data = Pesanan::where('status',2)->latest()->get();

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
                            $button = '<a href="'.route("pesanan-dirakit.show" , $data->id).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            $print = '<a href="'.route("cetak-history.detail", $data->id).'" class="btn btn-success btn-sm"  >
                                            <i class="fa fa-print"></i> Print</i>
                                    </a>';
                            $button .= '&nbsp;&nbsp;';
                            return $button. $print;
                        })
                        ->escapeColumns([])
                        ->make(true);
        }
    }

    //function data pesanan selesai
    public function data_selesai(){
        $data = Pesanan::where('status',3 )->latest()->get();

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
                            $button = '<a href="'.route("pesanan-selesai.show" , $data->id).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            //$diambil = '<a href="'.route("pesanan-selesai.konfirmasi").'" class="btn btn-success btn-sm " ><i class="fas fa-box"></i> Diambil </a>' ;
                            //$button .= '&nbsp;&nbsp;';
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
        }

    }
}
