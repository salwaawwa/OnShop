@extends('template_frontend.home')
@section('title','IMEDIANET - Layanan')
@section('content')
   
    <!-- CONTENT -->

        <div class="container ">

            @if(Session::has('success'))
                <div class="mt3 alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{route('layanan.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>LAYANAN</h4>
                                <div class="form-text text-muted mb-3">
                                    <small>Kirim Pesan Pertanyaan Kepada Kami</small>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Email</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="email" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="telepon" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pesan</label>
                                    <textarea name="pesan" id="pesan" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm float-right mt-3">Kirim Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    <!-- END CONTENT -->

    <!-- CK EDITOR -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
         CKEDITOR.replace( 'pesan' );
    </script>

@endsection
@section('sidebar')
    <div class="card mt-4">
        <div class="card-header">
            <i class="fa fa-list-alt" aria-hidden="true"></i> <b> Kategori Produk</b>  
        </div>
        <div class="card-body">
        <blockquote class="blockquote mb-0">
            <!-- <form class="form-inline">
                <div class="row">
                    <div class="col-md-9">
                        <input class="form-control mr-sm-2" type="search" style="width:200px" placeholder="Cari Produk" aria-label="Search">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>                   
            </form> -->

            <ul class="list-group mt-3">
                @foreach($produks as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route('list-produk.category', $item->slug)}}">{{$item->produk}}</a>    
                    <span class="badge badge-primary badge-pill">{{$item->tipes->count()}}</span>
                    </li>
                @endforeach
            </ul>
        </blockquote>
        </div>
    </div>
@endsection