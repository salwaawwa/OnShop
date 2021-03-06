<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Kapasitas;
use App\Cathard;
use App\Spesifikasi;
use DataTables;

class KapasitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kapasitas_hardware.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cathard = Cathard::all();
        return view('admin.kapasitas_hardware.create',compact('cathard'));
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
            'kapasitas' => 'required|max:190',
            'harga' => 'required|numeric',
            'cathards_id' => 'required'
        ]);

        $kapasitas = Kapasitas::create([
            'kapasitas' => $request->kapasitas,
            'harga' => $request->harga,
            'cathards_id' => $request->cathards_id,
            'slug' => Str::slug($request->kapasitas)
        ]);

        if($kapasitas){
            return redirect()->route('kapasitas.index')->with('success','Kapasitas Berhasil Disimpan');
        }else{
            return redirect()->back()->with('fail','Kapasitas Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $hardware = Cathard::all();
        $kapasitas = Kapasitas::where('slug', $slug)->first();
        if(!$kapasitas){
            abort(404);
        }

        return view('admin.kapasitas_hardware.edit',compact('hardware','kapasitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id){
        // $this->validate($request,[
        //     'kapasitas' => 'required|max:190',
        //     'harga' => 'required|numeric',
        //     'cathards_id' => 'required'
        // ]);

        $kapasitas_data = [
            'kapasitas' => $request->kapasitas,
            'harga' => $request->harga,
            'cathards_id' => $request->cathards_id,
            'slug' => Str::slug($request->kapasitas)
        ];

        Kapasitas::whereId($id)->update($kapasitas_data);
    
        if($kapasitas_data){
            return redirect()->route('kapasitas.index')->with('success','Kapasitas Berhasil Diupdate');
        }else{
            return redirect()->back()->with('fail','Kapasitas Gagal Diupdate');
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

        $kapasitas = Kapasitas::find($slug);
        $spek = Spesifikasi::where('kapasitas_id', $kapasitas->id)->get();
        
        try{
            //Kalo sukses
            $ids = [];

                foreach($spek as $item){
                    $item->kapasitas_id = 0;
                    $item->update();
                }

            $kapasitas->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Kapasitas berhasil di hapus'
            ]);

        }catch(\throwable $th) {
            //Kalo error
            throw $th;
             return response()->json([
                'status' => false,
                'pesan'  => 'Kapasitas gagal di hapus'
            ]);
        }
    }

    public function data()
    {
        $data = Kapasitas::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('hardware', function($data){
                            $hardware = Cathard::find($data->cathards_id);
                            return $hardware->hardware;
                        })
                        ->editColumn('harga', function($data){
                            if($data->harga > 0){
                                return \Awa::Rupiah($data->harga);
                            }else{
                                return "Rp. 0";
                            }                
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('kapasitas.edit', $data->slug) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
