@extends('template_backend.home')
@section('title')
    Edit Produk - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Edit Produk</h1>
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
                            <h4>Edit</h4>
                        </div>

                        <div class="card-body">

                            <div class="col-ld-4">

                                <form action="{{ route('produk.update', $produk->id) }}" autocomplete="off" method="POST">
                                    @csrf
                                    @method('put')
            
                                    <div class="form-group">
                                        <label>Produk</label>
                                        <input type="text" class="form-control" name="produk" value="{{ $produk->produk }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                    <a href="{{route('produk.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                       <button class="btn btn-primary float-right">Update produk</button>
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