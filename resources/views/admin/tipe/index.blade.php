@extends('template_backend.home')
@section('title')
    List Tipe - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>List Tipe</h1>
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
                    <a href="{{ route('tipe.create')}}" class="btn btn-info float-left btn-sm mb-3">Tambah Tipe</a>

                    <table id="table-tipe" class="table table-striped table-hover table-sm table-bordered">
                        <thead align="center">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Tipe</th>
                                <th>Merk</th>
                                <th>Produk</th>
                                <th>Aksi</th>
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

            var table = $('#table-tipe').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tipe.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'gambar', name: 'gambar'},
                {data: 'tipe', name: 'tipe'},
                {data: 'Merk', name: 'Merk'},
                {data: 'produks_id', name: 'produks_id'},
                {data: 'action', name: 'action'},
                ]
            })

        function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                if (r) {
                    $.ajax({
                        url : "/tipe/"+id+"/destroy",
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