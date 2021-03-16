@extends('layouts.public')
@section('title')
Produk PKKP
@endsection

@section('customStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/public_home.css') }}" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"> -->
@endsection

@section('content')
<div class="container pt-3">
    <div class="card shadow mb-4">
        <div class="card-body mb-5 mt-3">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 float-left mb-3">
                    <div class="card a h-100">
                        <div class="thumbnail-img">
                            <img src="{{ asset('data_file/product/'.$product->image) }}" class="card-img" alt="ea">
                        </div>
                        <div class="card-body">
                            <a href="/view_product/{{ $product->participant_id }}" class="stretched-link text-decoration-none text-secondary">
                                <h5 class="card-title text-dark">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text">{{ $product->category }}</p>
                                    <p class="card-text">{{ $product->sub_category }}</p>
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