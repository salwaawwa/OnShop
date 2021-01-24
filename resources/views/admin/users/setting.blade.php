@extends('template_backend.home')
@section('title')
    Setting User - Admin
@endsection

@section('content')

	<section class="section">

		<section class="section-header">
			<h1>User Setting</h1>
		</section>

		<section class="section-body">

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
					
			<div class="row sortable-card">
              	<div class="col-12 col-md-8 col-lg-6">
	                <div class="card card-primary">

	                  <div class="card-header">
	                    <h4>Setting</h4>
	                  </div>

	                  <div class="card-body">
	                    <div class="col-ld-4">

	                    	<form action="{{route('users.setting')}}" method="post" enctype="multipart/form-data">
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

		                  		<button type="submit" class="btn btn-primary">Update</button>

	                  		</form>
	                    </div>
	                  </div>

	                </div>
            	</div>
            </div>

		</section>
	</section>
	
@endsection