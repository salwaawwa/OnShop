<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Merek;
use App\Produk;
use App\Tipe;
use App\PesananDetail;
use DataTables;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.merk.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        return view('admin.merk.create',compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Merk' => 'required|max:190',
            'produks_id' => 'required'
        ]);

        $merk = Merek::create([
            'Merk' => $request->Merk,
            'produks_id' => $request->produks_id,
            'slug' => Str::slug($request->Merk)
        ]);

        if($merk){
            return redirect()->route('merk.index')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect()->back()->with('fail','Data Gagal Disimpan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $produk = Produk::all();
        $merk = Merek::where('slug', $slug)->first();
        if(!$merk){
            abort(404);
        }

        return view('admin.merk.edit',compact('merk','produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Merk' => 'required|max:190'
             
        ]);
        $merk_data = [
            'Merk' => $request->Merk,
            'produks_id' => $request->produks_id,
            'slug' => Str::slug($request->Merk)
        ];
        Merek::whereId($id)->update($merk_data);
    
        if($merk_data){
            return redirect()->route('merk.index')->with('success','Data Berhasil Diupdate');
        }else{
            return redirect()->back()->with('fail','Data Gagal Diupdate');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $merk = Merek::find($slug);
        $tipe = Tipe::where('mereks_id', $merk->id)->get();
        
        try{
            //Kalo sukses
            $ids = [];

            foreach($tipe as $item){
                array_push($ids,[
                    $item->id,
                ]);

                $detail = PesananDetail::where('tipes_id', $item->id)->get();
                foreach($detail as $item){
                    $item->tipes_id = 0;
                    $item->update();
                }

                unlink('storage/gambar-tipe/' .$item->gambar);
            }

           

            Tipe::destroy($ids);
            $merk->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Merk berhasil di hapus'
            ]);

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
             return response()->json([
                'status' => false,
                'pesan'  => 'Merk gagal di hapus'
            ]);
        }
    }

    public function data()
    {
        $data = Merek::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('produks_id', function($data){
                            $produk = Produk::find($data->produks_id);
                            return $produk->produk;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('merk.edit', $data->slug) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
