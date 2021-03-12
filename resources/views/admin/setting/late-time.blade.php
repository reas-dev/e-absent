@extends('layouts.admin')
@section('title')
    Atur Waktu
@endsection
@section('customStyle')
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css"> --}}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Atur Waktu Terlambat</h6>
                </div>
                <div class="card-body text-center mx-auto">
                    <h1>{{ $time_status->late }}</h1>
                    <form method="POST" action="{{ url('/admin/setting/late-time') }}">
                        @csrf
                        @method('post')
                        <div class="form-group row justify-content-center">
                            <label for="hour" class="col-md-1 col-form-label text-md-right">{{ __('H') }}</label>

                            <div class="col-md-2">
                                <input id="hour" type="text" class="form-control @error('hour') is-invalid @enderror" name="hour" value="{{ $hour }}" autofocus>

                                @error('hour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="hour" class="col-md-1 col-form-label text-md-right">{{ __('H') }}</label>

                            <div class="col-md-2">
                                <input id="minute" type="text" class="form-control @error('minute') is-invalid @enderror" name="minute" value="{{ $minute }}" autofocus>

                                @error('minute')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="second" class="col-md-1 col-form-label text-md-right">{{ __('H') }}</label>

                            <div class="col-md-2">
                                <input id="second" type="text" class="form-control @error('second') is-invalid @enderror" name="second" value="{{ $second }}" autofocus>

                                @error('second')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="action">
                            {{ __('Set Time') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
    $(function(){
        $('input.demo').timespinner();
    });
</script> --}}
@endsection
