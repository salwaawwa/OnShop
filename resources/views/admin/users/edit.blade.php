@extends('template_backend.home')
@section('title')
    Edit User - Admin
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Edit User</h1>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session('fail')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="section-body">
        <div class="row sortable-card">
            <div class="col-12 col-md-8 col-lg-6">
              <div class="card card-primary">

                    <div class="card-header">
                        <h4>Edit</h4>
                    </div>

                    <div class="card-body">

                        <div class="col-ld-4">

                            <form action="{{ route('users.update', $user->id) }}" autocomplete="off" method="POST">
                                @csrf
                                @method('put')
        
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control"  value="{{$user->name}}" id="" required name="name" autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" class="form-control"  value="{{$user->email}}"  id="" required name="email" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group form-label-group ">                       
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control">

		                  			<div class="form-text text-muted">
                                        <small>Kosongkan Password apabila tidak diubah</small>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="" class="form-control">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select class="form-control" name="admin" required id="">
                                            <option value="1"  
                                                @if( $user->admin == 1)
                                                    selected
                                                @endif>
                                                Admin
                                            </option>
                                            <option value="0"
                                                @if( $user->admin == 0)
                                                    selected
                                                @endif>
                                                User
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                <a href="{{route('users.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                   <button class="btn btn-primary float-right">Update User</button>
                                </div>
        
                            </form>    

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')

	$( document ).ready(function() {
	    $('input').attr('autocomplete','off');
	});

@endpush