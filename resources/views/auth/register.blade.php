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
        <form method="POST" action="{{ route('register') }}">
        @csrf
        @method('post')
            <div class="form-icon">
                <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
            </div>
            <h3 class="text-center font-weight-bold my-4">ABSENSI PKKP 2021</h3>
            <div class="form-group">
                <input type="text" class="form-control item @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ old('name') }}" autofocus required>
                @error('name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control item @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control item @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password-confirm" placeholder="Password Confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="key-access" placeholder="Key Access" name="key-access" required>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn hadir">Register</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a class="" href="{{ url('/login') }}">Have account?</a>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
