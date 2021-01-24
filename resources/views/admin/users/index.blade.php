@extends('template_backend.home')
@section('title')
    List User - Admin
@endsection

@section('content')
	<section class="section">

		<div class="section-header">
			<h1>List User</h1>
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

			<div class="card">
				<div class="card-body">
					<a href="{{ route('users.create')}}" class="btn btn-info float-left btn-sm mb-3">Tambah User</a>

					<table id="table-user" class="table table-striped table-hover table-sm table-bordered">
						<thead align="center">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>

				</div>
			</div>

		</div>
	</section>
@endsection

@push('scripts')
    
<script>

	var table = $('#table-user').DataTable({
		processing: true,
		serverSide: true,
		ajax: "{{ route('users.data') }}",
		columns: [
		{data: 'DT_RowIndex', name: 'DT_RowIndex'},
		{data: 'name', name: 'name'},
		{data: 'email', name: 'email'},
		{data: 'admin', name: 'admin'},
		{data: 'action', name: 'action'},
		]
	})

	function myConfirm(id) {
		var r = confirm("Yakin ingin menghapus ?")
		if (r) {
			$.ajax({
				url : "/users/"+id+"/destroy",
				type: 'GET',
				success: function(result) {
					console.log(result)
					if (result.status == true) {
						alert(result.pesan)
						table.draw()
					} else {
						alert(result.pesan)
					}
				}
			})
		}
	}

</script>

@endpush