@extends('layouts.app')

@section('title', 'Handlekurv')

@section('content')
    @if(Session::has('cart'))

        <div class="row">

            <div class="col-md-12">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['title'] }}</strong>
                            <span class="label label-success">Kr {{ $product['price'] }},-</span>
                            <a href="{{ route('cart.reduce', ['id' => $product['item']['id']]) }}">Fjern</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-12 text-right pr-3 mt-2 text-uppercase">
                <a href="{{ route('cart.remove', ['id' => $product['item']['id']]) }}">Tøm Handlekurv</a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 text-right mt-5">
                <strong>Mva: Kr {{ $totalPrice }},-</strong>
                <h3>
                    <strong>Totalt: Kr {{ $totalPrice }},-</strong>
                </h3>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-block btn-success font-weight-bold text-uppercase">Til betaling</a>
            </div>
        </div>

    @else
        <div class="row">
            <div class="col-sm-6 col-md6 col-md-offset-3 col-sm-offset-3">
                <h2>Handlekurven din er tom !</h2>
            </div>
        </div>
    @endif

@endsection
