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
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function getCheckout()
    {
        if (!session::has('cart')) {
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);

        $products = $cart->items;
        $total = $cart->totalPrice;
        $tax = $total * 25 / 100;

        return view('shop.checkout', compact('products', 'total', 'tax'));
    }

    //Stripe betaling
    public function postCheckout(Request $request)
    {
        $user = Auth::user();

        if (!Session::has('cart')) {
            return redirect()->route('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);

        Stripe::setApiKey('sk_test_MrslyqQJmMdewtvbysC41uMy');

        try {
            $charge = Charge::create([
                'amount'      => $cart->totalPrice * 100,
                'currency'    => 'usd',
                'source'      => $request->input('stripeToken'),
                'description' => 'Example charge',
            ]);
            $order             = new Order();
            $order->cart       = serialize($cart);
            $order->address    = $request->input('address');
            $order->name       = $request->input('name');
            $order->payment_id = $charge->id;

            $user->orders()->save($order);

            Mail::to($user)->send(new OrderSuccess($order, $charge));
        } catch (Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('index')->with('success', 'Successfully purchased products');
    }
}
