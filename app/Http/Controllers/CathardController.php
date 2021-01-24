<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Cathard;
use DataTables;

class CathardController extends Controller
{
    public function index() {
        return view('admin.kategori_hardware.index');
    }

    public function create(){
        return view('admin.kategori_hardware.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'hardware' => 'required|max:190'
        ]);

        $hardware = Cathard::create([
            'hardware' => $request->hardware,
            'slug' => Str::slug($request->hardware)
        ]);

        if($hardware){
            return redirect()->route('hardware.index')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect()->back()->with('fail','Data Gagal Disimpan');
        }
    }

    public function edit($slug){
        $cathard = Cathard::where('slug', $slug)->first();
        if(!$cathard){
            abort(404);
        }
        return view('admin.kategori_hardware.edit',compact('cathard'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'hardware' => 'required|max:190'
             
        ]);
        $hardware_data = [
            'hardware' => $request->hardware,
            'slug' => Str::slug($request->hardware)
        ];
        Cathard::whereId($id)->update($hardware_data);
    
        if($hardware_data){
            return redirect()->route('hardware.index')->with('success','Data Berhasil Diupdate');
        }else{
            return redirect()->back()->with('fail','Data Gagal Diupdate');
        }
    
    }

    public function destroy($slug)
    {
        $cathard = Cathard::find($slug);
        if ($cathard) {
            $cathard->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Hardware berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Hardware gagal di hapus'
            ]);
        }
    }
    

    public function data()
    {
        $data = Cathard::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('hardware.edit', $data->slug) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
