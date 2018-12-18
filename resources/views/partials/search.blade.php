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
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                        <td>{{$product->title}} </td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->discount_price}}</td>
                    </a>
                    <td><a href="{{ route('cart.add',['id' => $product->id] ) }}"
                           class="btn btn-sm btn-primary float-right">KJØP</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
