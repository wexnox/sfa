@extends('layouts.app')

@section('content')
    <div class="container">
        <p><b>{{ $q }}</b> ga følgene resultat:</p>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Tittel</th>
                <th>Beskrivelse</th>
                <th>Pris</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->discount_price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
