<html>
    <head>
        <title> Cetak Nota </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">
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

                    <table class="table table-striped mt-3 table-sm mb-3">
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
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Harga : </strong></td>
                                <td align="left"> Rp. {{ number_format($pesanan->total_bayar)}} </td>
                            </tr>
                        </tbody>
                    </table>

                
                        <h5>Spesifikasi Pesanan</h5>
                        <hr class="mb-3">
                        @foreach($pesanan_details as $items)
                            <div class="card mt-3" style="width:  60rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img class="card-img-top" src="{{asset('storage/gambar-tipe/' .$items->tipes->gambar)}}" style="width: 160px;" alt="{{$items->tipes->produks->produk}} {{$items->tipes->mereks->Merk}} {{$items->tipes->tipe}}">
                                        </div>
                                        <div class="col-md-8">
                                        <h5 style="color:black;">{{$items->tipes->produks->produk}} {{$items->tipes->mereks->Merk}} {{$items->tipes->tipe}}</h5> 
                                    
                                        <p style="color:black;"> 
                                            Spesifikasi :<br>

                                            @if($items->tipes->costum == 0)
                                                {!! $items->tipes->note !!}
                                            @endif
                                            @if($items->tipes->costum == 1)
                                                @foreach($items->spesifikasi as $spek)
                                                   
                                                        <table>
                                                            <tr>
                                                                <td>-</td>
                                                                <td> <b>{{$spek->cathards->hardware}}</b> </td>
                                                                <td> : </td>
                                                                <td> {{$spek->kapasitas->kapasitas}} </td>
                                                            </tr>
                                                        </table>
                                                        
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                
                @endif
                
                </div>
            </div>
        </div>

        <script type="text/javascript">
            window.print();
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>