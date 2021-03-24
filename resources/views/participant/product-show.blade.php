@extends('layouts.participant')
@section('title')
    Lihat Produk
@endsection

@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/public_home.css') }}" />
@endsection

@section('content')
<div class="container pt-5 mt-5">
    <div class="card-detail rounded shadow">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="col-md mb-4">
                    <img src="{{ asset('data_file/product/'.$product->image) }}" class="container-img col rounded" alt="ea">
                </div>
                <div class="col-md mx-auto">
                    <div class="h3 mb-4 text-dark">{{ $product->name }}</div>
                    <div class="row mb-3 text-gray-800">
                        <div class="col col-md-3">Kategori</div>
                        <div class="col">{{ $product->category }}</div>
                    </div>
                    <div class="row mb-3 text-gray-800">
                        <div class="col col-md-3">Sub Kategori</div>
                        <div class="col">{{ $product->sub_category }}</div>
                    </div>
                    <div class="row mb-3 text-gray-800">
                        <div class="col col-md-3">Lokasi</div>
                        <div class="col">{{ $location->place }}</div>
                    </div>
                    <a href="https://{{ $product->url }}" target="_blank" class="btn btn-primary mb-4">Link Produk</a>
                    <div class="h5 mb-1 text-gray-800">Deskripsi</div>
                    <p class="bg-pkkp text-white px-3 rounded">{{ $product->description }}</p>
                </div>
                <a href="{{ url('participant/product/'.$product->id.'/edit') }}" class="btn btn-warning mb-3">Edit Produk</a>
                <a href="{{ url('participant/product') }}" class="btn btn-secondary mb-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @if (Session::has('status') && Session::get('status') == 'product-edit-done')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            text: 'Berhasil memperbarui produk.',
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    @endif
@endsection
