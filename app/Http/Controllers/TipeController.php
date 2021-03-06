<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Tipe;
use App\Merek;
use App\Produk;
use App\PesananDetail;
use DataTables;

class TipeController extends Controller
{
    public function index(){
        return view('admin.tipe.index');
    }

    public function create(){

        $produk = Produk::all();
        $merk = Merek::all();
        return view('admin.tipe.create',compact('merk','produk'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'tipe' => 'required|max:190',
            'mereks_id' => 'required',
            'produks_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'note' => 'required',
            'costum' => 'required',
            'gambar' => 'required|image'
        ]);
        
        // Ganti Nama File
        $filename = rand(1,999).'_'.str_replace(' ', '', $request->gambar->getClientOriginalName());

        // Simpan File Ke Storage->app->public
        $request->file('gambar')->storeAs('public/gambar-tipe',$filename);

        $tipe = Tipe::create([
            'gambar' => $filename,
            'tipe' => $request->tipe,
            'mereks_id' => $request->mereks_id,
            'produks_id' => $request->produks_id,
            'slug' => Str::slug($request->tipe),
            'harga' => $request->harga,
            'stok' => $request->stok,
            'note' => $request->note,
            'costum' => $request->costum
        ]);

        if($tipe){
            return redirect()->route('tipe.index')->with('success','Tipe Berhasil Disimpan');
        }else{
            return redirect()->back()->with('fail','Tipe Gagal Disimpan');
        }
        
    }
    
    public function edit($slug)
    {
        $produk = Produk::all();
        $merk = Merek::all();
        $tipe = Tipe::where('slug', $slug)->first();
        if(!$tipe){
            abort(404);
        }

        return view('admin.tipe.edit',compact('tipe','merk','produk'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'tipe' => 'required|max:190',
            'mereks_id' => 'required',
            'produks_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'note' => 'required',
            'costum' => 'required',
            'gambar' => 'image'
        ]);

        if($request->file('gambar'))
        {
            
          // Ganti Nama File
          $filename = rand(1,999).'_'.str_replace(' ', '', $request->gambar->getClientOriginalName());

          // Simpan File Ke Storage->app->public
          $request->file('gambar')->storeAs('public/gambar-tipe',$filename);


            $tipe_data = [
                'gambar' => $filename,
                'tipe' => $request->tipe,
                'mereks_id' => $request->mereks_id,
                'produks_id' => $request->produks_id,
                'slug' => Str::slug($request->tipe),
                'harga' => $request->harga,
                'stok' => $request->stok,
                'note' => $request->note,
                'costum' => $request->costum
            ];
        } 
        else{
            $tipe_data = [
                'tipe' => $request->tipe,
                'mereks_id' => $request->mereks_id,
                'produks_id' => $request->produks_id,
                'slug' => Str::slug($request->tipe),
                'harga' => $request->harga,
                'stok' => $request->stok,
                'note' => $request->note,
                'costum' => $request->costum
            ];
        }

        Tipe::findorfail($id)->update($tipe_data);
    
        if($tipe_data){
            return redirect()->route('tipe.index')->with('success','Tipe Berhasil Diupdate');
        }else{
            return redirect()->back()->with('fail','Tipe Gagal Diupdate');
        }
    }

    public function show($slug)
    {
        $tipe = Tipe::where('slug', $slug)->first();
                        
        return view('admin.tipe.show',compact('tipe'));
    }

    public function destroy($slug)
    {
        // $tipe = Tipe::find($slug);
        // if ($tipe) {
        //     unlink('storage/gambar-tipe/' .$tipe->gambar);
        //     $tipe->delete();
        //     return response()->json([
        //         'status' => true,
        //         'pesan'  => 'Tipe berhasil di hapus'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'pesan'  => 'Tipe gagal di hapus'
        //     ]);
        // }

        $tipe = Tipe::find($slug);
        $detail = PesananDetail::where('tipes_id', $tipe->id)->get();

        try{
            //Kalo sukses
            foreach($detail as $item){
                $item->tipes_id = 0;
                $item->update();
            }
            unlink('storage/gambar-tipe/' .$tipe->gambar);
            $tipe->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Tipe berhasil di hapus'
            ]);

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
             return response()->json([
                'status' => false,
                'pesan'  => 'Tipe gagal di hapus'
            ]);
        }
    }

    public function data()
    {
        $data = Tipe::latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('Merk', function($data){
                            $merk = Merek::find($data->mereks_id);
                            return $merk->Merk;
                        })
                        ->addColumn('produks_id', function($data){
                            $produk = Produk::find($data->produks_id);
                            return $produk->produk;
                        })
                        ->addColumn('gambar', function($data){
                        	$gambar = '<a href='.url('storage/gambar-tipe/'.$data->gambar).'><img src='.url('storage/gambar-tipe/'.$data->gambar).' width="100%"></a>';
                            return $gambar;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('tipe.edit', $data->slug) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            $button .= '&nbsp;&nbsp;';
                            $show = '<a href="'.route("tipe.show" , $data->slug).'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i> Show</a>' ;
                            return $button. $show;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
