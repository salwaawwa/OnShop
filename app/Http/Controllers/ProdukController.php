<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Produk;
use DataTables;

class ProdukController extends Controller
{
    public function index() {
        return view('admin.produk.index');
    }

    public function create() {
        return view('admin.produk.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'produk' => 'required|max:190'
        ]);

        $produk = Produk::create([
            'produk' => $request->produk,
            'slug' => Str::slug($request->produk)
        ]);

        if($produk){
            return redirect()->route('produk.index')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect()->back()->with('fail','Data Gagal Disimpan');
        }
    }

    public function edit($slug)
    {
        $produk = Produk::where('slug', $slug)->first();
        if(!$produk){
            abort(404);
        }

        return view('admin.produk.edit',compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'produk' => 'required|max:190'
             
        ]);
        $produk_data = [
            'produk' => $request->produk,
            'slug' => Str::slug($request->produk)
        ];
        Produk::whereId($id)->update($produk_data);
    
        if($produk_data){
            return redirect()->route('produk.index')->with('success','Data Berhasil Diupdate');
        }else{
            return redirect()->back()->with('fail','Data Gagal Diupdate');
        }
    
    }

    public function destroy($slug)
    {
        $produk = Produk::find($slug);
        if ($produk) {
            $produk->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Produk berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Produk gagal di hapus'
            ]);
        }
    }


    public function data()
    {
        $data = Produk::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('produk.edit', $data->slug) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
