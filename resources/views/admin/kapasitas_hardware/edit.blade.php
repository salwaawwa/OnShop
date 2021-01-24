@extends('template_backend.home')
@section('title')
    Edit Kapasitas Hardware - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Edit Kapasitas Hardware</h1>
        </div>

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
                <div class="col-12 col-md-8 col-lg-6">
                  <div class="card card-primary">

                        <div class="card-header">
                            <h4>Edit</h4>
                        </div>

                        <div class="card-body">

                            <div class="col-ld-4">

                                <form action="{{ route('kapasitas.update', $kapasitas->id ) }}" autocomplete="off" method="POST">
                                    @csrf
                                    @method('put')
            
                                    <div class="form-group">
                                        <label>Kapasitas</label>
                                        <input type="text" class="form-control" name="kapasitas" value="{{ $kapasitas->kapasitas }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text">
                                              $
                                            </div>
                                          </div>
                                          <input type="number" name="harga" value="{{ $kapasitas->harga }}" class="form-control currency">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Hardware</label>
                                        <select class="form-control select2" name="cathards_id">
                                            <option value="" holder>Pilih Hardware</option>
                                            @foreach ($hardware as $item)
                                                <option value="{{ $item->id }}"
                                                    @if( $kapasitas->cathards_id == $item->id)
                                                        selected
                                                    @endif
                                                >{{ $item->hardware }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    <a href="{{route('kapasitas.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                       <button class="btn btn-primary float-right">Update Kapasitas</button>
                                    </div>
            
                                </form>    

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection