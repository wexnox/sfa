@extends('layouts.app')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
    @if (\Session::has('message'))
        <div class="alert alert-info">{{ \Session::get('message') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @if(count($items))
                <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Storage</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><img id="showProduct" class="img-responsive" src="{{ $item->imagePath }}"
                                     alt="{{ $item->title }}"></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            @if(is_bool($item->in_stock) <= 1)
                                <td>In stock{{ $item->status }}</td>
                            @else
                                <td>Out of stock</td>
                            @endif
                            <td>Kr {{ $item->discount_price }},- <span
                                    class="text-small">Kr {{ $item->original_price }},-</span></td>
                            <td><a class="btn btn-primary pull-right btn-success"
                                   href="{{ route('product.addToCart',['id' => $item->id] ) }}"
                                   role="button">Kjøp</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h6>No products in storage</h6>
            @endif
        </div>
    </div>

@endsection
