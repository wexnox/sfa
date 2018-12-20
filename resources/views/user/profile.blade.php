@extends('layouts.app')
@section('title', 'Profil')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Bruker Profil</h1>
            {{--TODO: Legge til brukerprofil--}}
            <i class="fas fa-address-book"></i>
            <hr>
            <h2>My Orders</h2>
            @foreach($orders as $order)
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="list-group">
                       
                            <li class="list-group-item">
                                <span class="badge">$ {{ $item['price'] }}</span>
                                {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                            </li>
                        
                    </ul>
                </div>
                <div class="panel-footer">
                    <strong>Total Price: Kr{{ $order->cart->totalPrice }}</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
