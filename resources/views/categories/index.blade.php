@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Bilde</th>
                        <th>Tittel</th>
                        <th>Beskrivelse</th>
                        <th>Lager</th>
                        <th>Pris</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $product)
                        <tr>
                            <td><img id="showProduct" class="img-responsive" src="{{ $product->imagePath }}" alt="{{ $product->title }}"></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            @if(is_bool($product->in_stock) <= 1)
                                <td>På Lager: {{ $product->status }}</td>
                            @else
                                <td>Ikke på lager</td>
                            @endif
                            <td>Kr {{ $product->discount_price }},- <span
                                    class="text-small">Kr {{ $product->original_price }},-</span></td>
                            <td><a class="btn btn-primary pull-right btn-success"
                                   href="{{ route('product.addToCart',['id' => $product->id] ) }}"
                                   role="button">Kjøp</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    </div>

@endsection
