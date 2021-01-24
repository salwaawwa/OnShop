@extends('template_backend.home')
@section('title')
    Show Pesanan Selesai - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Show Pesanan Diraakit</h1>
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
                                        <td>{{$pesanan_detail->tipes->produks->produk}} {{$pesanan_detail->tipes->mereks->Merk}} {{ $pesanan_detail->tipes->tipe}} </td>
                                        <td align="left"> Rp. {{ number_format($pesanan_detail->tipes->harga)}} </td>
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

                            <a href="{{route('pesanan-selesai.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                            <a href="{{route('pesanan-selesai.konfirmasi',$pesanan->id)}}" onclick="return confirm('pesanan sudah diambil pembeli? ');" class="btn btn-success float-right btn-sm" >
                                <i class="fas fa-box"></i> Diambil </a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
