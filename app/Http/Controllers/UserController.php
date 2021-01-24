<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use DataTables;

class UserController extends Controller
{
    public function form_user(){
        $data = User::where('id', Auth::id())->first();
        return view('user-setting.form',compact('data'));
    }
    
    public function update_form_user(Request $request){
        $id = Auth::id();

    	\Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users,email,' .$id,
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'same:password',
        ])->validate();

    	if(!empty($request->password)){
    		$field = [
    			'name' => $request->name,
    			'email' => $request->email,
    			'password' => bcrypt($request->password),
    		];
    	}else{
    		$field = [
    			'name' => $request->name,
    			'email' => $request->email,
    		];
    	}

    	$result = User::where('id', $id)->update($field);

    	if($result){
    		return back()->with('result','success');
    	}else{
    		return back()->with('result','fail');
    	}
    }

    public function form(){
    	$data = User::where('id', Auth::id())->first();
    	return view('admin.users.setting',compact('data'));
    }

    public function update_form(Request $request){

    	$id = Auth::id();

    	\Validator::make($request->all(), [
            'name'  => 'required|max:50|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|max:30',
            'admin' =>'required',
        ])->validate();

    	if(!empty($request->password)){
    		$field = [
    			'name' => $request->name,
    			'email' => $request->email,
                'password' => bcrypt($request->password),
                'admin' => $request->admin
    		];
    	}else{
    		$field = [
    			'name' => $request->name,
                'email' => $request->email,
                'admin' => $request->admin
    		];
    	}

    	$result = User::where('id', $id)->update($field);

    	if($result){
    		return back()->with('result','success');
    	}else{
    		return back()->with('result','fail');
    	}

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name'  => 'required|max:50|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|max:30',
            'admin' =>'required',
        ])->validate();

        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $user = User::create($request->except('password_confirmation'));

        if ($user) {
            return redirect()->route('users.index')->with('success', 'User Berhasil di Buat');
        }else{
            return redirect()->route('users.create')->with('fail', 'User Gagal di Buat');
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
    public function edit($id)
    { 
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
        if($request->input('password')){
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'admin' => $request->admin,
                'password' => Hash::make($request->password)
            ];
        }else{
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'admin' => $request->admin,
            ];
        }

        $user = User::findOrFail($id)->update($user_data);

        return redirect()->route('users.index')->with('success', 'User Berhasil di Update');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = User::find($slug);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'User berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'User gagal di hapus'
            ]);
        }
    }

    public function data()
    {
        $data = User::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('admin', function($data){
                            if($data->admin == 1){
                                return '<span class="badge badge-pill badge-warning">Admin</span>';
                            }else{
                                return '<span class="badge badge-pill badge-success">User</span>';
                            }
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="'. route('users.edit', $data->id) .'" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Edit</a>' ;
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<a href="javascript:void(0)" onclick="myConfirm('.$data->id.')" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                            return $button;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
