<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Produk;
use App\Layanan;
use DataTables;
use Carbon\Carbon;

class LayananController extends Controller
{
    
    public function index(){
        $produks = Produk::all();

        return view('web.layanan',compact('produks'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:190',
            'email' => 'required|email',
            'telepon' => 'required|numeric',
            'pesan' => 'required'
        ]);

        $tanggal = Carbon::now();
        $layanan = Layanan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->pesan,
            'tanggal' => $tanggal,
            'slug' => Str::slug($request->nama)
        ]);

        return redirect()->route('layanan.index')->with('success','Pesan Berhasil Dikirim, Kami Akan Mengirim Jawaban Ke Email/Telepon Anda');
    
    }

    public function show($slug){
        $layanan = Layanan::where('slug', $slug)->where('status',0)->first();
                        
        return view('admin.pesan.show',compact('layanan'));
    }

    public function pesan_masuk(){
        
        return view('admin.pesan.index');
    }

    
    public function destroy($slug)
    {
        $layanan = Layanan::find($slug);
        if ($layanan) {
            $layanan->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Pesan berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Pesan gagal di hapus'
            ]);
        }
    }

    public function konfirmasi($id){
        $layanan = Layanan::where('id',$id)->where('status',0)->first();
        $layanan_id = $layanan->id;

        $layanan->status = 1;
        $layanan->update();

        return redirect()->route('pesan-masuk.index')->with('success','Pesan Berhasil Terjawab');
    }

    public function pesan_terjawab(){
        
        return view('admin.pesan.pesan-terjawab');
    }

    public function show_pesan_terjawab($slug){
        $layanan = Layanan::where('slug', $slug)->where('status',1)->first();
                        
        return view('admin.pesan.show-terjawab',compact('layanan'));
    }

    //function data pesan masuk ( belum terjawab)
    public function data()
    {
        $data = Layanan::where('status',0)->latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($data){
                            if($data->status == 0){
                                return "<span class='badge badge-pill badge-warning'>Belum Terjawab</span>";
                            }else{
                                return "<span class='badge badge-pill badge-info'>Terjawab</span>";
                            }
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'.route("layanan.show" , $data->slug).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    //function data pesan terjawab
    public function data_terjawab()
    {
        $data = Layanan::where('status',1)->get();

        if( $data === null ) 
        { 
            return 'No data available'; 
        }else{

            return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($data){
                            if($data->status == 0){
                                return "<span class='badge badge-pill badge-warning'>Belum Terjawab</span>";
                            }else{
                                return "<span class='badge badge-pill badge-info'>Terjawab</span>";
                            }
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'.route("pesan-terjawab.show" , $data->slug).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
        }
    }
}
