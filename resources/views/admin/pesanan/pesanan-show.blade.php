@extends('template_backend.home')
@section('title')
    Show Pesanan - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Show Pesanan</h1>
        </div>

        <div class="section-body">
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

            <div class="row sortable-card">
                <div class="col-12 col-md-8 col-lg-10">
                  <div class="card card-primary">

                        <div class="card-body">

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
                                                <a href="{{ route('pesanan-spesifikasi.show',$pesanan_detail->id) }}">Show Spesifikasi</a>
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

                            <a href="{{route('pesanan-admin.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                            @if($pesanan->status == 1)
                                <a href="{{route('pesanan.konfirmasi',$pesanan->id)}}" class="btn btn-success float-right btn-sm" >
                                    <i class="fa fa-check" aria-hidden="true"> Terima Pesanan</i>
                                </a>
                            @endif
                            @if($pesanan->status != 1 )
                                <a href="{{route('cetak-history.detail', $pesanan->id)}}" class="btn btn-success float-right btn-sm" onclick="return confirm('Cetak Struk? ');" >
                                    <i class="fa fa-print"></i> Print</i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection