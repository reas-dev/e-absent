@extends('layouts.participant')
@section('title')
    Absensi Harian
@endsection

@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection

@section('content')
<div class="row h-100 mx-auto">
    <div class="col my-auto h-100">
        <div class="registration-form my-auto">
        <form method="POST" action="{{ url('/participant/absent') }}">
        @csrf
        @method('post')
            <div class="form-icon">
                <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
            </div>
            <h3 class="text-center font-weight-bold my-4">ABSENSI PKKP 2021</h3>
            {{-- <div class="form-group">
                <input type="text" class="form-control item @error('nik') is-invalid @enderror" id="nik" placeholder="NIK" name="nik" value="{{ old('nik') }}" autofocus required>
                @error('nik')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div> --}}
            <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" hidden>
            <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" hidden>

            <div class="form-group">
                <div class="row">
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn hadir" name="action" value="absent">Hadir</button>
                    </div>
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn izin" name="action" value="izin">Izin</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a class="" href="{{ url('/participant/absent/detail') }}">lihat detail absensi bulan ini?</a>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    navigator.geolocation.getCurrentPosition(function (position) {
        console.log(position);
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        console.log(lat);
        console.log(lng);
        document.getElementById('longitude').setAttribute('value', lng);
        document.getElementById('latitude').setAttribute('value', lat);
    });
</script>
@endsection
