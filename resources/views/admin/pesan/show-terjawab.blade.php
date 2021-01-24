@extends('template_backend.home')
@section('title')
    Show Pesan Terjawab - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Show Pesan Terjawab</h1>
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

                            <a href="{{route('pesan-terjawab.index')}}" class="btn btn-outline-primary float-left">Kembali</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection