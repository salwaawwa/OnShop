@extends('template_backend.home')
@section('title')
    Create Merk - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Create Merk</h1>
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

                                <form action="{{ route('merk.store') }}" autocomplete="off" method="POST">
                                    @csrf
            
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input type="text" class="form-control" name="Merk" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select class="form-control select2" name="produks_id">
                                            <option value="" holder>Pilih Produk</option>
                                            @foreach ($produk as $item)
                                                <option value="{{ $item->id }}">{{ $item->produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    <a href="{{route('merk.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                       <button class="btn btn-primary float-right">Simpan Merk</button>
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