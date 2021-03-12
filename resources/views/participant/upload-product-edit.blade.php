@extends('layouts.participant')
@section('title')
    Upload Produk
@endsection
@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6" style="color: black; background-color: #5791ff;">
                            <div class="sample-form mx-3 my-5">
                                <h3 class="text-center font-weight-bold my-4">PRODUK SAYA</h3>
                                <div class="px-5">
                                    <img src="{{ asset('data_file/product/'.$product->image) }}" class="img-thumbnail px-5" style="background-color: #5791ff; border: #5791ff;">
                                    <div class="h3 mt-4 mx-5">{{ $product->name }}</div>
                                    <div class="mt-3 mb-5 mx-5">
                                        <div class="row mb-3">
                                            <div class="col col-md-3">kategori</div>
                                            <div class="col">{{ $product->category }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-3">kategori khusus</div>
                                            <div class="col">{{ $product->sub_category }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-3">link promosi</div>
                                            <div class="col">{{ $product->url }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-md-3">deskripsi</div>
                                            <div class="col">{{ $product->description }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="sample-form mx-3 my-5">
                                <form method="POST" action="{{ url('/participant/product') }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                    <div class="form-icon">
                                        <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
                                    </div>
                                    <h3 class="text-center font-weight-bold my-4">UPLOAD PRODUK PKKP 2021</h3>

                                    <div class="form-group">
                                        <input type="text" class="form-control item @error('name') is-invalid @enderror" id="name" placeholder="nama produk" name="name" value="{{ $product->name }}" autofocus required>
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <select class="form-control item @error('category') is-invalid @enderror" id="category" name="category" required>
                                            <option disabled class="bg-secondary text-white">kategori produk</option>
                                            @if ($product->category == 'makanan')
                                                <option value="makanan" selected>makanan</option>
                                                <option value="minuman">minuman</option>
                                                <option value="perabotan">perabotan</option>
                                                <option value="hiasan">hiasan</option>
                                            @elseif ($product->category == 'minuman')
                                            <option value="makanan">makanan</option>
                                            <option value="minuman" selected>minuman</option>
                                            <option value="perabotan">perabotan</option>
                                            <option value="hiasan">hiasan</option>
                                            @elseif ($product->category == 'perabotan')
                                            <option value="makanan">makanan</option>
                                            <option value="minuman">minuman</option>
                                            <option value="perabotan" selected>perabotan</option>
                                            <option value="hiasan">hiasan</option>
                                            @elseif ($product->category == 'hiasan')
                                            <option value="makanan">makanan</option>
                                            <option value="minuman">minuman</option>
                                            <option value="perabotan">perabotan</option>
                                            <option value="hiasan" selected>hiasan</option>
                                            @endif
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control item @error('sub_category') is-invalid @enderror" id="sub_category" placeholder="kategori khusus" name="sub_category" value="{{ $product->sub_category }}" required>
                                        @error('sub_category')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control item @error('promotion') is-invalid @enderror" id="promotion" placeholder="link promosi" name="promotion" value="{{ $product->url }}" required>
                                        @error('promotion')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image" required/>
                                            <label class="custom-file-label item" for="image">pilih gambar produk (kosongkan jika tidak diganti)</label>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="description" class="form-label">deskripsi singkat</label>
                                        <textarea class="form-control item @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ $product->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col text-center mt-3">
                                                <button type="submit" class="btn izin">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="text-center mt-3">
                                        <a class="" href="{{ url('/register') }}">Don't have account?</a>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
<script>
    $('#image').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection
