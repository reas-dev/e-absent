@extends('layouts.participant')
@section('title')
    Upload Produk
@endsection

@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection

@section('content')
<div class="row h-100 mx-auto">
    <div class="col my-auto h-100">
        <div class="registration-form my-auto">
        <form method="POST" action="{{ url('/participant/product') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
            <div class="form-icon">
                <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
            </div>
            <h3 class="text-center font-weight-bold my-4">UPLOAD PRODUK PKKP 2021</h3>

            <div class="form-group">
                <input type="text" class="form-control item @error('name') is-invalid @enderror" id="name" placeholder="nama produk" name="name" value="{{ old('name') }}" autofocus required>
                @error('name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <select class="form-control item @error('category') is-invalid @enderror" id="category" name="category" required>
                  <option selected disabled class="bg-secondary text-white">kategori produk</option>
                  <option value="makanan">makanan</option>
                  <option value="minuman">minuman</option>
                  <option value="perabotan">perabotan</option>
                  <option value="hiasan">hiasan</option>
                </select>
                @error('category')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" class="form-control item @error('sub_category') is-invalid @enderror" id="sub_category" placeholder="kategori khusus" name="sub_category" value="{{ old('sub_category') }}" required>
                @error('sub_category')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" class="form-control item @error('promotion') is-invalid @enderror" id="promotion" placeholder="link promosi" name="promotion" value="{{ old('promotion') }}" required>
                @error('promotion')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image" required/>
                    <label class="custom-file-label item" for="image">pilih gambar produk</label>
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">deskripsi singkat</label>
                <textarea class="form-control item @error('description') is-invalid @enderror" name="description" id="description" rows="5" value=""></textarea>
                @error('description')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="row mt-3">
                    <div class="col text-center">
                        <button type="submit" class="btn hadir">Upload</button>
                        <a href="{{ url('/home') }}" class="btn hadir bg-secondary">Kembali</a>
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
