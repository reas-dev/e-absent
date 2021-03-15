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
                        <img src="//:0" alt="" />
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
                        <img src="//:0" alt="" />
                        <figcaption class="grid d-flex justify-content-center center align-items-center">
                            <h2>UPLOAD PRODUK</h2>
                        </figcaption>
                    </figure>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/participant/report') }}">
                <div class="grid d-flex justify-content-center center align-items-center">
                    <figure class="effect-chico center">
                        <img src="//:0" alt="" />
                        <figcaption class="grid d-flex justify-content-center center align-items-center">
                            <h2>LAPORAN</h2>
                        </figcaption>
                    </figure>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    @if (Session::has('status') && Session::get('status') == 'has-submit')
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Ups!',
            text: 'Anda sudah upload produk.',
            showConfirmButton: false,
            timer: 1200
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'product-done')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            text: 'Produk berhasil ter-upload.',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'product-edit-done')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            text: 'Berhasil memperbarui produk.',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'report-done')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            text: 'Laporan bulanan berhasil ter-upload.',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @endif
@endsection
