@extends('layouts.participant')
@section('title')
Upload Laporan
@endsection

@section('customStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection

@section('content')
<div class="row h-100 mx-auto">
    <div class="col my-auto h-100">
        <div class="registration-form my-auto">
            <form method="POST" action="{{ url('/participant/report') }}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-icon">
                    <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
                </div>
                <h3 class="text-center font-weight-bold my-4">UPLOAD LAPORAN PKKP 2021</h3>

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file" required />
                        <label class="custom-file-label item" for="file">pilih file laporan</label>
                    </div>
                    @error('file')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col text-center mt-3">
                            <button type="submit" class="btn hadir">Upload</button>
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
    // FUNGSI TAMPILKAN NAMA FILE SETELAH PILIH FILE
    $('#file').on('change', function() {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection