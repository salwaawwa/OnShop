<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .logo{
                height: 80px;
                padding-left:30px;
            }

            .footer{
                background-color: #475d2c;
                height:170px;
            }
        </style>
    </head>
    <body>

        <!-- NAVBAR -->
            @include('template_frontend.navbar')
        <!-- END NAVBAR -->

        <!-- CONTENT ATAS -->
            @yield('content_atas')
        <!-- END CONTENT ATAS -->

        <!-- CONTENT -->
            <div class="container">
                <div class="row sortable-card mt-5">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <h4 style="color:black;">Spesifikasi Pesanan</h4>
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
        <!-- END CONTENT -->
    
        <!-- FOOTER -->

            @include('template_frontend.footer')

        <!-- END FOOTER -->
    
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
