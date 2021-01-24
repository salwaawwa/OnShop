@extends('template_backend.home')
@section('title')
    Show Pesan Masuk - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Show Pesan Masuk</h1>
        </div>

        <div class="section-body">
            <div class="row sortable-card">
                <div class="col-12 col-md-6 col-lg-7">
                  <div class="card card-primary">

                        <div class="card-body">
                            <h5 style="color:black;">{{$layanan->nama}}</h5>

                            <table style="color:black">
                                <tr>
                                    <td> <b>Tanggal</b>  </td>
                                    <td> : </td>
                                    <td> {{$layanan->tanggal}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Email</b>  </td>
                                    <td> : </td>
                                    <td> {{$layanan->email}}</td>
                                </tr>
                                <tr>
                                    <td> <p> <b>No Telepon</b> </p></td>
                                    <td> <p> : </p></td>
                                    <td> <p>{{$layanan->telepon}}</p> </td>
                                </tr>
                            </table>
                            <p style="color:black;"><b>Pesan :</b></p>
                            <p> {!! $layanan->pesan !!}</p>

                            <a href="{{route('pesan-masuk.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                            <a href="{{route('pesan-masuk.konfirmasi',$layanan->id)}}" class="btn btn-success float-right btn-sm" >
                                <i class="fa fa-check" aria-hidden="true"> Terjawab</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection