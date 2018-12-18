@extends ('layouts.app')
@section('title', 'Checkout')
@section('content')

<div class="row">

    <div class="col-md-6">

        <form action="{{ route('checkout') }}" method="post" id="checkout-form">
            @csrf

            <div class="form-group">
                <label for="name">Fult navn</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card-name">Kortholders navn</label>
                <input type="text" id="card-name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card-number">Kort nummer</label>
                <i class="fab fa-cc-stripe"></i>
                <input type="number" id="card-number" class="form-control" placeholder="4242 4242 4242 4242" value="4242 4242 4242 4242" required>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="card-expiry-month">Utløps måned</label>
                        <input type="text" id="card-expiry-month" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="card-expiry-year">Utløps År</label>
                        <input type="text" id="card-expiry-year" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="card-cvc">CVC</label>
                        <input type="text" id="card-cvc" class="form-control" required>
                    </div>                
                </div>

            </div>

            <button type="submit" class="btn btn-block btn-success text-uppercase">Betal</button>

        </form>

    </div>

    <div class="col-md-5 ml-5 text-right bg-white p-3">

        <h1 class="font-weight-bold">ORDRE DETALJER</h1>
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Antall</th>
                        <th>Pris</th>
                    </tr>
                </thead>
            
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product['item']['title'] }}</td>
                        <td>{{ $product['qty'] }}</td>                        
                        <td class="label label-success">Kr {{ $product['price'] }},-</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
        <hr>
        <p>MVA: Kr {{ $tax ?? '0' }},-</p>
        <p>Frakt: Kr {{ $shipment ?? '0' }},-</p>
        <hr>
        <h3>Total: <b>Kr {{ $total ?? '0'}}</b>,-</h3>

    </div>

</div>

@endsection

@section('scripts')

    <script src="https://js.stripe.com/v2/"></script>
    <script src="{{ URL::to('js/checkout.js') }}"></script>

@endsection
