@extends('layouts.app')

@section('title', 'Produkter')

@section('content')

    <div class="container">

        <div class="row">
            @foreach($products as $product)

                <div class="col-md-4">

                    <figure class="card card-product">

                        <div class="img-wrap"><img src="{{ $product->imagePath }}" alt="{{ $product->title }}"></div>

                        <figcaption class="info-wrap">
                            <a href="{{ route('products', $product->id) }}">
                                <h3 class="title text-uppercase">{{ $product->title }}</h3>
                            </a>
                            <p class="desc">{{ $product->description }}</p>
                            <div class="rating-wrap">
                                <div class="label-rating">154 På lager.</div>
                            </div>
                        </figcaption>

                        <div class="bottom-wrap">
                            <a href="{{ route('cart.add',['id' => $product->id] ) }}" class="btn btn-sm btn-primary float-right">KJØP</a>
                            <div class="price-wrap h5">
                                <span class="price-new font-weight-bold">Kr {{ $product->discount_price }},-</span> <del class="price-old">Kr {{ $product->original_price }},-</del>
                            </div>
                        </div>

                    </figure>

                </div>

            @endforeach
        </div>

    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>

@endsection
