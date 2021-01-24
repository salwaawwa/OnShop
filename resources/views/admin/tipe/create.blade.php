@extends('template_backend.home')
@section('title')
    Create Tipe - Admin
@endsection
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Create Tipe</h1>
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
                            <h4>Create</h4>
                        </div>

                        <div class="card-body">

                            <div class="col-ld-4">

                                <form action="{{ route('tipe.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group form-label-group">
                                        <label for="iGambar">Gambar Tipe ( Masukan 1 Gambar )</label>
                                        <input type="file" name="gambar" class="form-control" accept="image/*"
                                        id="iGambar" placeholder="Gambar" required>
                                    </div>
            
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" name="tipe" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text">
                                              $
                                            </div>
                                          </div>
                                          <input type="number" name="harga" class="form-control currency">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control" name="stok" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label>Merk</label>
                                        <select class="form-control select2" name="mereks_id">
                                            <option value="" holder>Pilih Merk</option>
                                            
                                            @foreach ($merk as $item)
                                                <option value="{{ $item->id }}">{{ $item->Merk }} ({{$item->produks->produk}})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select class="form-control select2" name="produks_id">
                                            <option value="" holder>Pilih Produk</option>
                                            @foreach ($produk as $item)
                                                <option value="{{ $item->id }}">{{ $item->produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Note ( Spesifikasi )</label>
                                        <textarea name="note" id="note" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">User Costum</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="costum" value="1" class="selectgroup-input">
                                                <span class="selectgroup-button">Ya</span>
                                            </label>
    
                                            <label class="selectgroup-item">
                                                <input type="radio" name="costum" value="0" class="selectgroup-input">
                                                <span class="selectgroup-button">Tidak</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{route('tipe.index')}}" class="btn btn-outline-primary float-left">Kembali</a>
                                       <button class="btn btn-primary float-right">Simpan Tipe</button>
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
	
	<script type="text/javascript">
		function filePreview(input){
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e){
					$('#iGambar + image').remove();
					$('#iGambar').after('<img src="'+e.target.result +'" width="100" class="mt-3" /> ')
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$(function(){
			$('#iGambar').change(function(){
				filePreview(this);
			})
		})
    </script>
    <!-- CK EDITOR -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
         CKEDITOR.replace( 'note' );
    </script>
@endpush