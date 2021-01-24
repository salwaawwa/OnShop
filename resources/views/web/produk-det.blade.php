@extends('template_frontend.home')
@section('title','IMEDIANET - Produk Detail')
@section('content')
   
    <!-- CONTENT -->
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

        <div class="card mt-4">
            <div class="card-body">
                <b style="color: black">{{$data->produks->produk}} {{$data->mereks->Merk}} {{$data->tipe}}</b>
                <hr>
            </div>

            <div class="container "  style="color:black">
                @if($data->costum == 0)
                    <div class="row">
                         <!-- div gambar -->
                        <div class="col-md-5">
                            <a href="{{url('storage/gambar-tipe/' .$data->gambar)}}"><img src="{{asset('storage/gambar-tipe/' .$data->gambar)}}" style="width: 200px;" alt="{{$data->produks->produk}} {{$data->mereks->Merk}} {{$data->tipe}}"></a>        
                        </div>
                        
                        <!-- div detail produk -->
                        <div class="col-md-7">
                                <table style="color:black">
                                    <tr>
                                        <td >Kategori</td>
                                        <td> : </td>
                                        <td> {{$data->produks->produk}}</td>
                                    </tr>
                                    <tr>
                                            <td>Merk</td>
                                            <td> : </td>
                                            <td> {{$data->mereks->Merk}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tipe</td>
                                            <td> : </td>
                                            <td> {{$data->tipe}}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td> : </td>
                                            <td>
                                                @if($data->harga == 0)
                                                    Rp. 0
                                                @endif
                                                {{Awa::Rupiah($data->harga)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td> : </td>
                                            <td>
                                                @if($data->stok <= 0)
                                                    Stok Habis
                                                @endif
                                                @if($data->stok > 0)
                                                    {{$data->stok}}
                                                @endif
                                            
                                            </td>
                                        </tr>
                                        <form action="{{ route('transaksi.pesanan', $data->id) }}" method="post">
                                            @csrf
                                                <tr>
                                                    <td>Jumlah Pesanan</td>
                                                    <td> : </td>
                                                    <td>       
                                                    <input type="text" style="width:180px;height:25px;margin-top:5px;" name="jumlah_pesanan" class="form-control" 
                                                        required="" class="float-left" placeholder="Jumlah Pesanan" autocomplete="off" autofocus>      
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>     
                                                        @if($data->stok > 0)
                                                            <!-- Button Masukkan Keranjang -->
                                                            <button type="submit" style="width:180px;"  class="btn btn-primary btn-sm mt-2"><i class="fa fa-shopping-cart">
                                                            </i> Masukkan Keranjang </button> 
                                                        @endif
                                                        @if($data->stok <= 0)
                                                            <button type="submit" style="width:180px;"  class="btn btn-primary btn-sm mt-2" disabled><i class="fa fa-shopping-cart">
                                                            </i> Stok Habis </button> 
                                                        @endif
                                                    </td>
                                                </tr>
                                    </table>
                                        </form>
                        </div>
                        
                    </div>
                        <!-- link memperbesar gambar -->
                        <div class="form-text text-muted mb-3">
                            <small>Klik Pada Gambar Untuk Memperbesar</small>
                        </div>
                        <p>Note (Spesifikasi) : {!! $data->note !!}</p>
                @endif

                @if($data->costum == 1)

                    <div class="row">
                        <!-- div gambar -->
                        <div class="col-md-5">
                            <a href="{{url('storage/gambar-tipe/' .$data->gambar)}}"><img src="{{asset('storage/gambar-tipe/' .$data->gambar)}}" style="width: 200px;" alt="{{$data->produks->produk}} {{$data->mereks->Merk}} {{$data->tipe}}"></a>        
                        </div>

                        <!-- div detail produk -->
                        <div class="col-md-7">
                            <table style="color:black">
                                <tr>
                                    <td >Kategori</td>
                                    <td> : </td>
                                    <td> {{$data->produks->produk}}</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td> : </td>
                                    <td> {{$data->mereks->Merk}}</td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td> : </td>
                                    <td> {{$data->tipe}}</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td> : </td>
                                    <td>  
                                        @if($data->harga == 0)
                                            Rp. 0
                                        @endif
                                            {{Awa::Rupiah($data->harga)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td> : </td>
                                    <td>
                                        @if($data->stok <= 0)
                                            Stok Habis
                                        @endif
                                        @if($data->stok > 0)
                                            {{$data->stok}}
                                        @endif
                                    
                                    </td>
                                </tr>
                                    <form action="{{ route('transaksi.pesanan', $data->id) }}" method="post">
                                        @csrf
                                            <tr>
                                                <td>Jumlah Pesanan</td>
                                                <td> : </td>
                                                <td>       
                                                <input type="text" style="width:180px;height:25px;margin-top:5px;" name="jumlah_pesanan" class="form-control" 
                                                    required="" class="float-left" placeholder="Jumlah Pesanan" autocomplete="off" autofocus>      
                                                </td>
                                            </tr>
                            </table>
                                    
                        </div>
                    </div>
                        <!-- link memperbesar gambar -->
                        <div class="form-text text-muted mb-3">
                            <small>Klik Pada Gambar Untuk Memperbesar</small>
                        </div>
                        <p>Note (Spesifikasi) : {!! $data->note !!}</p>

                    <div class="row">
                        <!-- div form spesifikasi -->
                        <div class="col-md-6 mt-3">
                            <h5 style="color:red;" class="text-center"> <b>Form Costum</b> </h5>
                                @foreach ($cathards as $item)
                                    <div class="form-group">
                                        <label>{{$item->hardware}}</label>
                                        <select class="form-control select2" id="{{$item->id}}" name="hardware[{{$item->id}}]" data-toggle="select-hardware" data-hardware="{{ $item->hardware }}" name="produks_id">
                                            <option value="" holder>Pilih Kapasitas</option>
                                            @foreach ($item->kapasitas as $row)
                                                <option value="{{$row->id}}">{{$row->kapasitas}} -  
                                                @if($row->harga == 0)
                                                    Rp. 0
                                                @endif
                                                @if($row->harga > 0 )
                                                    {{Awa::Rupiah($row->harga)}}
                                                @endif    
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                        </div>
                        <!-- div rincian order -->
                        <div class="col-md-6 mt-3 mb-4">
                            <div class="card" >
                                <div class="card-body">
                                  <h5 style="color:red;" class="text-center"> <b>Rician Order</b> </h5>
                                  @foreach ($cathards as $item)
                                        <font  style="color:red;font-weight: 700;" >{{$item->hardware}} : </font > <span data-content="show-hardware" data-hardware="{{ $item->hardware }}"></span>
                                    <br>
                                  @endforeach
                                </div>
                            </div>
                                @if($data->stok > 0)
                                    <!-- Button Masukkan Keranjang -->
                                    <button type="submit" style="width:180px;"  class="btn btn-primary btn-sm mt-4 float-right"><i class="fa fa-shopping-cart">
                                    </i> Masukkan Keranjang </button> 
                                @endif
                                @if($data->stok <= 0)
                                    <button type="submit" style="width:180px;"  class="btn btn-primary btn-sm mt-4 float-right" disabled><i class="fa fa-shopping-cart">
                                    </i> Stok Habis </button> 
                                @endif
                            </form>
                        </div>
                    </div>

                @endif
              
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
        <form class="form-inline">
            <div class="row">
                <div class="col-md-9">
                    <input class="form-control mr-sm-2" type="search" style="width:200px" placeholder="Cari Produk" aria-label="Search">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>                   
        </form>

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
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

        $(document).ready(function(){

            $("[data-toggle='select-hardware']").on("change", function(){
                let text = ''
                if($(this).val()) {
                    text = $(this).find('option:selected').text()
                }
                  $(`[data-content="show-hardware"][data-hardware="${$(this).data('hardware')}"]`)
                    .text(text)
            });
        });

    </script>

@endpush
