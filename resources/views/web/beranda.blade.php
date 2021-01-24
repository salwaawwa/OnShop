@extends('template_frontend.home')
@section('title','IMEDIANET - Beranda')
@section('content_atas')
     <!-- CAROUSEL -->
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" style="height: 440px;" src="{{ asset('assets/img/gambar1.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="height: 440px;" src="{{ asset('assets/img/gambar2.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="height: 440px;" src="{{ asset('assets/img/gambar3.jpg')}}" alt="Third slide">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
     <!-- END CAROUSEL -->
@endsection
@section('content')
   
    <!-- CONTENT -->
        <div class="card mt-4">
            <div class="card-body">
                <b style="color: black">PRODUK TERBARU</b>
                <hr>
            </div>

            <div class="container ">

                <div class="row">
                    @foreach($data as $tipe)
                    <div class="col-md-4 mb-3">
                        <div class="card"style="color:black;">
                            <div class="card-body" style="width: 120px; height:150px ">
                                <img src="{{asset('storage/gambar-tipe/' .$tipe->gambar)}}" style="width: 120px;" alt="{{$tipe->produks->produk}} {{$tipe->mereks->Merk}} {{$tipe->tipe}}">
                                <hr>
                            </div>
                            <div class="card-body" style="height:190px ">
                            <p class="card-title"> <a href="{{route('produk-detail.detail',$tipe->slug)}}"> {{$tipe->produks->produk}} {{$tipe->mereks->Merk}} {{$tipe->tipe}}</a></p>
                            <p class="card-title text-center">
                                @if($tipe->harga == 0)
                                    Costum Sendiri 
                                @endif
                                {{Awa::Rupiah($tipe->harga)}}
                            </p>
                            
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            
        </div>
    <!-- END CONTENT -->
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
                        <input class="form-control mr-sm-2" type="search" name="search" id="search" style="width:200px" placeholder="Cari Produk" aria-label="Search">
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
