@extends('template_backend.home')
@section('title')
    Show Spesifikasi Pesanan - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Show Spesifikasi Pesanan</h1>
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

            <div class="section-body">
                <div class="row sortable-card">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{url('storage/gambar-tipe/' .$pesananDet->tipes->gambar)}}"><img src="{{asset('storage/gambar-tipe/' .$pesananDet->tipes->gambar)}}" style="width: 200px;" alt="{{$pesananDet->tipes->produks->produk}} {{$pesananDet->tipes->mereks->Merk}} {{$pesananDet->tipes->tipe}}"></a>        
                                        <div class="form-text text-muted">
                                            <small>Klik Pada Gambar Untuk Memperbesar</small>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h4 style="color:black;">{{$pesananDet->tipes->produks->produk}} {{$pesananDet->tipes->mereks->Merk}} {{$pesananDet->tipes->tipe}}</h4> 
                                        <table style="color:black">
                                            <tr>
                                                <th>Nota</th>
                                                <th> : </th>
                                                <td>{{$pesananDet->invoice_number}}</td>
                                            </tr>
                                            <tr>
                                                <th>Banyak</th>
                                                <th> : </th>
                                                <td>{{$pesananDet->banyak}}</td>
                                            </tr>
                                            
                                        </table>
                                        <p style="color:black;"> 
                                            <b> Spesifikasi :</b><br>
                                            @if($pesananDet->tipes->costum == 0)
                                                {!! $pesananDet->tipes->note !!}
                                            @endif
                                            @if($pesananDet->tipes->costum == 1)
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hardware</th>
                                                            <th></th>
                                                            <th>Kapasitas</th>
                                                            <th></th>
                                                            <th>Harga Satuan</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach($spesifikasi as $item)
                                                    <tr>
                                                        <td>-</td>
                                                        <td>{{$item->cathards->hardware}}</td>
                                                        <td> : </td>
                                                        <td>{{$item->kapasitas->kapasitas}} </td>
                                                        <td> => </td>
                                                        <td>
                                                            @if($item->kapasitas->harga == 0)
                                                                Rp. 0
                                                            @endif 
                                                            {{Awa::Rupiah($item->kapasitas->harga)}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3"> </td>
                                                        <td style="color:black;"> <h6>Total Harga</h6> </td>
                                                        <td> : </td>
                                                        <td>{{Awa::Rupiah($pesananDet->jumlah_harga)}}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                          
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


@endsection