@extends('layouts.app')
@section('content')

<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Bilde</th>
            <th>Tittel</th>
            <th>Beskrivelse</th>
            <th>Lager</th>
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
                <td>Kr {{ $product->discount_price }},-</td>
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>

@endsection
