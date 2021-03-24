@extends('layouts.participant')
@section('title')
    Upload Produk
@endsection

@section('customStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
@endsection

@section('content')
<div class="container pt-5 mt-5">
    <div class="card shadow mb-4">
        <div class="card-body mb-5 mt-3">
            <a href="{{ url('participant/product/upload') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Produk</a>
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 float-left mb-3">
                    <div class="card a h-100">
                        <div class="thumbnail-img">
                            <img src="{{ asset('data_file/product/'.$product->image) }}" class="card-img" alt="ea">
                        </div>
                        <div class="card-body">
                            <a href="{{ url('/participant/product/'.$product->id) }}" class="stretched-link text-decoration-none text-secondary">
                                <h5 class="card-title text-dark">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text">{{ $product->category }} <br>   {{ $product->sub_category }}</p>
                                </div>
                                <div class="float-right text-dark" style="position:absolute; bottom:0; right:0;"> Lihat Produk <i class=" fas fa-angle-double-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
