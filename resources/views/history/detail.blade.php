@extends('template_frontend.home')
@section('title','IMEDIANET - History Pesanan detail')
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

                <div class="card-body">
                    <b style="color: black">NOTA PEMESANAN</b>
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
                                </p>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pesanan_details as $pesanan_detail)
                                    <tr>
                                        <td align="center"> {{ $no++ }} </td>
                                        <td>
                                            @if($pesanan_detail->tipes_id == 0)
                                               <p style="color:red"><b>Barang Sudah dihapus Oleh Admin</b> </p> 
                                            @else
                                                {{$pesanan_detail->tipes->produks->produk}} {{$pesanan_detail->tipes->mereks->Merk}} {{ $pesanan_detail->tipes->tipe}} <br>
                                                <a href="{{ route('spesifikasi.show',$pesanan_detail->id) }}">Show Spesifikasi</a>
                                            @endif
                                           
                                        </td>
                                        <td align="left"> 
                                            @if($pesanan_detail->tipes_id == 0)
                                                Rp. {{ number_format ($pesanan_detail->jumlah_harga / $pesanan_detail->banyak) }}
                                            @else
                                                @if($pesanan_detail->tipes->costum == 0)
                                                    Rp. {{ number_format($pesanan_detail->tipes->harga)}}
                                                @endif 
                                                @if($pesanan_detail->tipes->costum == 1)
                                                Rp. {{ number_format ($pesanan_detail->jumlah_harga / $pesanan_detail->banyak) }}
                                                @endif
                                            @endif
                                        </td>
                                        <td align="center"> {{ $pesanan_detail->banyak}} </td>
                                        <td align="left"> Rp. {{ number_format($pesanan_detail->jumlah_harga)}} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga : </strong></td>
                                    <td align="left"> Rp. {{ number_format($pesanan->total_bayar)}} </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{route('history.index')}}" class="btn btn-outline-primary float-left btn-sm mb-3">Kembali</a>
                        <a href="{{route('cetak-history-pesanan.detail', $pesanan->id)}}" class="btn btn-success float-right btn-sm" onclick="return confirm('Cetak Struk? ');" >
                            <i class="fa fa-print"></i> Print</i>
                        </a>
                    @endif
                </div>
            </div>
        
    <!-- END CONTENT -->
@endsection
