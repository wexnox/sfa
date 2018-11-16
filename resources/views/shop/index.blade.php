@extends('layouts.app')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @endif
    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        {{--<a href="{{ route('product.show', $product->id) }}">--}}
                            <img class="card-img-top" src="{{ $product->imagePath }}"  alt="Image of {{ $product->title }}">
                        {{--</a>--}}
                        <div class="card-body">
                            {{--<a href="{{ route('product.show', $product->id) }}">--}}
                                <h3 class="card-title">{{ $product->title }}</h3>
                            {{--</a>--}}
                            <p class="card-text">{{ $product->description }}.</p>
                            <p class="card-text"><small class="text-muted">Lagerstatus:</small></p>
                            <div class="clearfix">
                                <div class="pull-left price">{{ $product->price }},- </div>
                                <a class="btn btn-primary pull-right btn-success"
                                   {{--href="{{ route('product.addToCart',['id' => $product->id] ) }}" --}}
                                   role="button">Kjøp</a>
                            </div>
                        </div>

                    </div>
                    <br>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
