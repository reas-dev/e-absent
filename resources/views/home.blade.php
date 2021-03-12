@extends('layouts.app')
@section('title')
    PKKP 2021
@endsection
@section('content')
    <div class="container">
        <div class="row pt-5 min-vh-100 d-flex justify-content-center center align-items-center">
            <div class="col">
                <a href="{{ url('/participant/absent') }}">
                    <div class="grid d-flex justify-content-center center align-items-center">
                        <figure class="effect-chico center">
                            <img src="//:0" alt=""/>
                            <figcaption class="grid d-flex justify-content-center center align-items-center">
                                <h2>ABSENSI</h2>
                            </figcaption>
                        </figure>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ url('/participant/product') }}">
                    <div class="grid d-flex justify-content-center center align-items-center">
                        <figure class="effect-chico center">
                            <img src="//:0" alt=""/>
                            <figcaption class="grid d-flex justify-content-center center align-items-center">
                                <h2>UPLOAD PRODUK</h2>
                            </figcaption>
                        </figure>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ url('/participant/absent') }}">
                    <div class="grid d-flex justify-content-center center align-items-center">
                        <figure class="effect-chico center">
                            <img src="//:0" alt=""/>
                            <figcaption class="grid d-flex justify-content-center center align-items-center">
                                <h2>ABSENSI</h2>
                            </figcaption>
                        </figure>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
