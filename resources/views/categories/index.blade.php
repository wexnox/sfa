@extends('layouts.app')

@section('content')

<div class="container">

    <div class="col-md-12 text-uppercase mb-3">
        Kategori: <span class="font-weight-bold">{{ $categoryName->name }} ({{ $productCount }})</span>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Bilde</th>
                <th>Tittel</th>
                <th>Beskrivelse</th>
                <th>Status</th>
                <th>Pris</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                @foreach($category->product as $product)
                <tr>
                    <td><img class="img-responsive" style="height:100px;" src="{{ $product->imagePath }}"></td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>På Lager: {{ $product->status }}</td>
                    <td class="font-weight-bold">Kr {{ $product->discount_price }},-</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
