@extends('template_backend.home')
@section('title')
    Create User - Admin
@endsection

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Create User</h1>
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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                        <h4>Create</h4>
                    </div>

                    <div class="card-body">

                        <div class="col-ld-4">

                            <form action="{{ route('users.store') }}" autocomplete="off" method="POST">
                                @csrf
        
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="" name="name" required autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" class="form-control" id="" name="email" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" required class="form-control">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="" required class="form-control">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select class="form-control" required name="admin" id="">
                                            <option value="" holder>Pilih Role</option>
                                            <option value="1">Admin</option>
                                            <option value="0">User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                <a href="{{route('users.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                   <button class="btn btn-primary float-right">Simpan User</button>
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