@extends('template_frontend.home')
@section('title','IMEDIANET - Beranda')
@section('content')
   
    <!-- CONTENT -->
        <div class="row">
            <div class="col-md-2">
            
            </div>

            <div class="col-md-8">

                @if(session('result') == 'success')
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Update ! </strong>Berhasil
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(session('result') == 'fail')
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Update ! </strong>Gagal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card mt-4" >
                    <div class="card-body">
                        <b style="color: black">SETTING PROFILE</b>
                        <hr>
                    </div>

                    <div class="container ">

                        <form action="{{route('setting-user.setting')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-label-group">
                                <label for="ipassword">Name</label>
                                <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ' '}}" 
                                value="{{ $data->name }}"
                                id="iName" placeholder="Name" required>

                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group form-label-group">
                                <label for="iEmail">Email Address</label>
                                <input type="text" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ' '}}" 
                                value="{{ $data->email }}"
                                id="iEmail" placeholder="Email Address" required>

                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group form-label-group">
                                <label for="iPassword">Password</label>
                                <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ' '}}" 
                                id="iPassword" placeholder="Password">

                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif

                                <div class="form-text text-muted">
                                    <small>Kosongkan Password apabila tidak diubah</small>
                                </div>

                            </div>

                            <div class="form-group form-label-group">
                                <label for="iRePassword">Re Password </label>
                                <input type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ' '}}" 
                                id="iRePassword" placeholder="Re-Password">

                                @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('password_confirmation')}}
                                    </div>
                                @endif

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mb-3 float-right">Update</button>

                        </form>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-2">
            
            </div>
        </div>
        
    <!-- END CONTENT -->
@endsection
