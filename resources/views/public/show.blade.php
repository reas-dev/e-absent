@extends('layouts.public')
@section('title')
Detail Produk
@endsection

@section('customStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/public_home.css') }}" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"> -->
@endsection

@section('content')
<div class="container card-detail rounded shadow">
    <div class="row justify-content-center">
        <div class="col-sm-10">
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
                <a href="/external_url/{{ $product->url }}" class="btn btn-primary mb-4">Link Produk</a>
                <div class="h5 mb-1 text-gray-800">Deskripsi</div>
                <p class="bg-pkkp text-white px-3 rounded">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>

@endsection