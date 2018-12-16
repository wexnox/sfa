@extends('layouts.app')

@section('title', $product->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $product->title }}</h1>
                <hr>
            </div>
            <div class="col-md-2">
                <img id="showProduct" src="{{ $product['imagePath'] }}" class="img-responsive">
            </div>
            <div class="col-md-8">
                {{ $product['description'] }}
            </div>
            <div class="col-md-2">
                    <h3>
                        <strong>Pris</strong>
                    </h3>
                    <h4>Kr {{ $product->discount_price }},-</h4>
                        <small>Kr {{ $product->original_price }},-</small><br>
                    <a class="btn btn-primary pull-right btn-success" href="{{ route('product.addToCart',['id' => $product->id] ) }}">Kjøp</a>            
            </div>
        </div>
    </div>
@endsection
