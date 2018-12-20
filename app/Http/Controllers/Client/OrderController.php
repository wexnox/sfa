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
        $cart    = new Cart($oldCart);

        $products = $cart->items;
        $total    = $cart->totalPrice;
        $tax      = $total * 25 / 100;

        return view('shop.checkout', compact('products', 'total', 'tax'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        Stripe::setApiKey('sk_test_MrslyqQJmMdewtvbysC41uMy');
        $currentCart = Session::get('cart');
        $cart        = new Cart($currentCart);
        
        try {

            $charge = Charge::create(array(
                'amount' => $cart->totalPrice,
                'currency' => 'NOK',
                'source' => $request->input('stripeToken'),
                'description' => 'Netthandel',
            ));

            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

//            $order = Order::create([
//                'cart'       => serialize($cart),
//                'name'       => $request->input('name'),
//                'payment_id' => $charge->id
//            ]);
            Auth::user()->orders()->save($order);
//            Mail::to($user)->send(new OrderSuccess($order, $charge));
            Session::forget('cart');
        
            return redirect()->route('/')->with('success', 'Successfully purchased products');
        
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
