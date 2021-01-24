@extends('template_frontend.home')
@section('title','IMEDIANET - History Pesanan')
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

            <div class="card mt-5" >

                <div class="card-body">
                    <b style="color: black">HISTORY PEMESANAN</b>
                    <hr>

                    <div class="container ">
                        @if(!empty($pesanan))
                            <table class="table table-striped mt-3 table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nota</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($pesanan as $item)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->tanggal}}</td>
                                            <td>{{$item->invoice_number}}</td>
                                            <td>
                                                @if($item->status == 1)
                                                    <span class="badge badge-pill badge-warning">Pesanan Diproses</span>
                                                @endif
                                                @if($item->status == 2)
                                                    <span class="badge badge-pill badge-info">Pesanan Sedang Dirakit</span>
                                                @endif
                                                @if($item->status == 3)
                                                    <span class='badge badge-dark'>Pesanan Siap Diambil</span>
                                                @endif
                                                @if($item->status == 4)
                                                    <span class='badge badge-success'>Pesanan Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('history.detail',$item->id)}}" class="btn btn-success btn-sm" >
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Detail Pesanan</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        
    <!-- END CONTENT -->
@endsection
@section('sidebar')
    <table class="table table-striped mt-5">
        <tr>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>                                                 
                <span class="badge badge-pill badge-warning">Pesanan Diproses</span>
            </td>
            <td> <span> Menunggu Admin Menerima Pesanan </span></td>
        </tr>
        <tr>
            <td>                                                 
                <span class="badge badge-pill badge-info">Pesanan Sedang Dirakit</span>
            </td>
            <td> <span> Pesanan Sedang Dirakit Oleh Teknisi </span></td>
        </tr>
        <tr>
            <td>                                                 
                <span class='badge badge-dark'>Pesanan Siap Diambil</span>
            </td>
            <td> <span> Pesanan Telah Selesai Dirakit dan Siap Diambil ( cetak nota sebagai tanda bukti ) </span></td>
        </tr>
        <tr>
            <td>                                                 
                <span class='badge badge-success'>Pesanan Selesai</span>
            </td>
            <td> <span> Pesanan Sudah Diterima Pembeli</span></td>
        </tr>
        
    </table>
@endsection