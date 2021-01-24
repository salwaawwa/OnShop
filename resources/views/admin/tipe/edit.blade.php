@extends('template_backend.home')
@section('title')
    Edit Tipe - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Edit Tipe</h1>
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
                <div class="col-12 col-md-8 col-lg-8">
                  <div class="card card-primary">

                        <div class="card-header">
                            <h4>Edit</h4>
                        </div>

                        <div class="card-body">

                            <div class="col-ld-4">

                                <form action="{{ route('tipe.update', $tipe->id ) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-group form-label-group">
                                        <label for="iGambar">Gambar Tipe ( Masukan 1 Gambar )</label>
                                        <input type="file" name="gambar" class="form-control"
		                                accept = "image/*" id="iGambar" >
                                        
                                        <div class="form-text text-muted">
                                            <small>Kosongkan Gambar apabila tidak diubah</small>
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" name="tipe" value="{{ $tipe->tipe }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text">
                                              $
                                            </div>
                                          </div>
                                          <input type="number" name="harga" class="form-control currency" value="{{ $tipe->harga }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control" name="stok" value="{{ $tipe->stok }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Merk</label>
                                        <select class="form-control select2" name="mereks_id">
                                            <option value="" holder>Pilih Merk</option>
                                            @foreach ($merk as $item)
                                                <option value="{{ $item->id }}"
                                                    @if( $tipe->mereks_id == $item->id)
                                                        selected
                                                    @endif
                                                >{{ $item->Merk }} ({{$item->produks->produk}})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select class="form-control select2" name="produks_id">
                                            <option value="" holder>Pilih Produk</option>
                                            @foreach ($produk as $item)
                                                <option value="{{ $item->id }}"
                                                    @if( $tipe->produks_id == $item->id)
                                                        selected
                                                    @endif
                                                >{{ $item->produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Note ( Spesifikasi )</label>
                                        <textarea name="note" id="note" cols="30" rows="10">{{ $tipe->note }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">User Costum</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="costum" value="1" class="selectgroup-input"
                                                    @if( $tipe->costum == 1)
                                                        checked
                                                    @endif
                                                >
                                                <span class="selectgroup-button">Ya</span>
                                            </label>
    
                                            <label class="selectgroup-item">
                                                <input type="radio" name="costum" value="0" class="selectgroup-input" 
                                                    @if( $tipe->costum == 0)
                                                        checked
                                                    @endif
                                                >
                                                <span class="selectgroup-button">Tidak</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <a href="{{route('tipe.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                       <button class="btn btn-primary float-right">Update Tipe</button>
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
@push('scripts')
     <!-- CK EDITOR -->
     <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
     <script>
          CKEDITOR.replace( 'note' );
     </script>
@endpush