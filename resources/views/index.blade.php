@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="card">

                        <a href="{{ route('product.show', $product->id) }}">
                            <img class="card-img-top" src="{{ $product->imagePath }}" alt="Image of {{ $product->title }}">
                        </a>

                        <div class="card-body">

                            <a href="{{ route('product.show', $product->id) }}">
                                <h3 class="card-title">{{ $product->title }}</h3>
                            </a>

                            <p class="card-text">{{ $product->description }}.</p>
                            <p class="card-text">
                                <small class="text-muted">Lagerstatus:</small>
                            </p>

                            <div class="clearfix">
                                <div class="pull-left price">{{ $product->price }},-</div>
                                <a class="btn btn-primary pull-right btn-success" href="{{ route('product.addToCart',['id' => $product->id] ) }}">Kjøp</a>
                            </div>
                            
                        </div>

                    </div>
                    <br>
                </div>
            @endforeach
        </div>

        <div class="col-md-12">
            {{ $products->links() }}
        </div>

    </div>

@endsection
