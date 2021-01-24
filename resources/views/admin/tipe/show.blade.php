@extends('template_backend.home')
@section('title')
    Show Tipe - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>{{$tipe->produks->produk}} {{$tipe->mereks->Merk}} {{$tipe->tipe}}</h1>
        </div>

        <div class="section-body">
            <div class="row sortable-card">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card card-primary">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{url('storage/gambar-tipe/' .$tipe->gambar)}}"><img src="{{asset('storage/gambar-tipe/' .$tipe->gambar)}}" style="width: 200px;" alt="{{$tipe->produks->produk}} {{$tipe->mereks->Merk}} {{$tipe->tipe}}"></a>        
                                    <div class="form-text text-muted">
                                        <small>Klik Pada Gambar Untuk Memperbesar</small>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <table style="color:black">
                                        <tr>
                                            <td >Kategori</td>
                                            <td> : </td>
                                            <td> {{$tipe->produks->produk}}</td>
                                        </tr>
                                        <tr>
                                             <td>Merk</td>
                                             <td> : </td>
                                             <td> {{$tipe->mereks->Merk}}</td>
                                         </tr>
                                         <tr>
                                             <td>Tipe</td>
                                             <td> : </td>
                                             <td> {{$tipe->tipe}}</td>
                                         </tr>
                                         <tr>
                                             <td>Harga</td>
                                             <td> : </td>
                                             <td> 
                                                @if($tipe->harga == 0)
                                                    Rp. 0
                                                @endif
                                                 {{Awa::Rupiah($tipe->harga)}}
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Stok</td>
                                             <td> : </td>
                                             <td> {{$tipe->stok}} </td>
                                         </tr>
                                        <tr>
                                            <td>Costum User</td>
                                            <td> : </td>
                                            <td> 
                                                @if($tipe->costum == 1)
                                                    Ya
                                                @endif
                                                @if($tipe->costum == 0)
                                                    No
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    <p style="color:black;">Note (Spesifikasi) :</p>
                                    <p> {!! $tipe->note !!}</p>
                                </div>
                            </div>
                            <a href="{{route('tipe.index')}}" class="btn btn-outline-primary mt-4 float-left">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection