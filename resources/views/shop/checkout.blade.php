@extends ('layouts.app')
@section('title', 'Checkout')
@section('content')

    <div class="row">

        <div id="card-errors" role="alert"></div>

        <div class="col-md-6">

            <form action="{{ route('checkout') }}" method="post" id="payment-form">
                @csrf
                {{-- TODO: Legge til fult navn--}}
                <div class="form-group">
                    <label for="name">Fult navn</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
                4242424242424242
                <div class="form-group">
                    <label for="email">Epost</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>

                {{--TODO: melding på sms eller epost ved leverings oppdatering etc--}}
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-stripe"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-discover"></i>
                <div id="card-element">
                </div>
                <i class="fab fa-ethereum"></i>
                <i class="fab fa-bitcoin"></i>
                <button class="btn btn-block btn-success text-uppercase">Betal</button>

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

    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>

@endsection
