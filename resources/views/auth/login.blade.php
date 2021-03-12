@extends('layouts.participant')
@section('title')
    Login
@endsection

@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection

@section('content')
<div class="row h-100 mx-auto">
    <div class="col my-auto h-100">
        <div class="registration-form my-auto">
        <form method="POST" action="{{ route('login') }}">
        @csrf
        @method('post')
            <div class="form-icon">
                <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
            </div>
            <h3 class="text-center font-weight-bold my-4">ABSENSI PKKP 2021</h3>
            <div class="form-group">
                <input type="email" class="form-control item @error('email') is-invalid @enderror" id="email" placeholder="email" name="email" value="{{ old('email') }}" autofocus required>
                @error('email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control item @error('password') is-invalid @enderror" id="password" placeholder="password" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn hadir">Login</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a class="" href="{{ url('/register') }}">Don't have account?</a>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
