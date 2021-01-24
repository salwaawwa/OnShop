@extends('template_frontend.home')
@section('title','IMEDIANET - Keranjang')
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session('fail')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            <div class="card mt-4" >

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

                <div class="card-body">
                    <b style="color: black">KERANJANG ANDA</b>
                    <hr>
                </div>

                <div class="container ">
                    @if(!empty($pesanan))
                        <div class="row">
                            <div class="col-md-6">
                                <table style="color:black">
                                    <tr>
                                        <th>Pemesan</th>
                                        <td>:</td>
                                        <td>{{$pesanan->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>: </td>
                                        <td>{{$pesanan->tanggal}}</td>
                                    </tr>
                                    <tr>
                                        <th>No Nota </th>
                                        <td>: </td>
                                        <td>{{$pesanan->invoice_number}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                            
                            </p>
                            </div>
                        </div>

                        <table class="table table-striped mt-3 table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Banyaknya</th>
                                    <th>Jumlah</th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pesanan_details as $pesanan_detail)
                                    <tr>
                                        <td align="center"> {{ $no++ }} </td>
                                        <td>{{$pesanan_detail->tipes->produks->produk}} {{$pesanan_detail->tipes->mereks->Merk}} {{ $pesanan_detail->tipes->tipe}} </td>
                                        <td align="left"> 
                                            @if($pesanan_detail->tipes->costum == 0)
                                                Rp. {{ number_format($pesanan_detail->tipes->harga)}}
                                            @endif 
                                            @if($pesanan_detail->tipes->costum == 1)
                                               Rp. {{ number_format ($pesanan_detail->jumlah_harga / $pesanan_detail->banyak) }}
                                            @endif
                                           
                                        </td>
                                        <td align="center"> {{ $pesanan_detail->banyak}} </td>
                                        <td align="left"> Rp. {{ number_format($pesanan_detail->jumlah_harga)}} </td>
                                        <td>
                                            <form action="{{route('check-out.delete',$pesanan_detail->id)}}" method="post">
                                                @csrf
                                                {{ method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Akan Menghapus Pesanan? ');"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga : </strong></td>
                                    <td align="left"> Rp. {{ number_format($pesanan->total_bayar)}} </td>
                                    <td>
                                        <a href="{{ route('konfirmasi.pesanan') }}" class="btn btn-success btn-sm" onclick="return confirm('Anda Yakin Akan CheckOut Pesanan? ');">
                                            <i class="fa fa-shopping-cart">CheckOut</i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                    @if(empty($pesanan))
                        <div class="row">
                            <div class="col-md-6">
                            <table style="color:black" class="table-sm">
                                    <tr>
                                        <th>Pemesan</th>
                                        <td>:</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <th>No Nota </th>
                                        <td>: </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                            
                            </p>
                            </div>
                        </div>

                        <table class="table table-striped mt-3 table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Banyaknya</th>
                                    <th>Jumlah</th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        
    <!-- END CONTENT -->
@endsection
