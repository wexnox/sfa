<?php

namespace App\Http\Controllers\Client;

use Auth;
use Mail;
use View;
use Exception;
use Validator;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use Stripe\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkout()
    {
        if (!session::has('cart')) {
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $products = $cart->items;
        $total = $cart->totalPrice;
        $tax = $total * 25 / 100;

        return view('shop.checkout', compact('products', 'total', 'tax'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        $currentCart = Session::get('cart');
        $cart = new Cart($currentCart);

        try {
            Stripe::setApiKey('sk_test_MrslyqQJmMdewtvbysC41uMy');

            $customer = Customer::create(array(
                'email' => $request->email,
                'source' => $request->stripeToken
            ));
//dd($request)->all;
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $cart->totalPrice,
                'currency' => 'NOK',
                'description' => 'Netthandel',
            ]);
//            dd($request)->all;
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

//            dd($request)->all;
            Auth::user()->orders()->save($order);
//            TODO: Need to fix OrderSuccesss
//            Mail::to($user)->send(new OrderSuccess($order, $charge));
            Session::forget('cart');
            return redirect()->route('/')->with('success', 'Successfully purchased products');

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
