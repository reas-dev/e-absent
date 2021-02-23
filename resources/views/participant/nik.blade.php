@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Absent') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/absent') }}">
                        @csrf
                        @method('post')
                        <div class="form-group row">
                            <label for="nik" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>

                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" autofocus>

                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" hidden>
                        <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" hidden>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="action" value="absent">
                                    {{ __('Absent') }}
                                </button>
                                <button type="submit" class="btn btn-primary" name="action" value="izin">
                                    {{ __('Izin') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
