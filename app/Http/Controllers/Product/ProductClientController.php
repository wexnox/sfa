<?php

namespace App\Http\Controllers\Product;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use View;

class ProductClientController extends Controller
{
    /** Shopping Cart **/
    //Routing::URI = /, Name product.index
    public function getIndex()
    {
        $products = Product::paginate(9);
        $categories = Category::all();
        return view('shop.index')
            ->with(['products' => $products])
            ->with(['categories' => $categories]);
    }

    public function index($id)
    {
//        $items = Category::where('id', $id)->with('product')->get(); // Original

//        $value = Product::paginate(2);
//        $items = Category::where('id', $id)->with('product')->get();
//        $items = Category::where('id', $id)->with('product')->get();
        $items = Category::where('id', $id)->paginate(2);
//        $products = Product::paginate(2);

//        return view('products.index', compact('items','value')); // Orginal
        return view('products.index', compact('items', 'value'));
//            ->with(['products' => $products]);
//            ->with(['categories' => $categories]);
    }

    public function show($id)
    {
        // get the product
        $product = Product::findOrFail($id);
        $categories = Category::all();

        //show the view and pass the product to it
        return View('products.show')
            ->with('product', $product)
            ->with('categories', $categories);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.index');
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getCart()
    {
        if (!session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if (!session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    //Stripe betaling
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey("sk_test_MrslyqQJmMdewtvbysC41uMy");

        try {
            $charge = Charge::create(array(
                'amount' => $cart->totalPrice * 100,
                'currency' => 'usd',
                'source' => $request->input('stripeToken'),
                'description' => 'Example charge',
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch (Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products');
    }
}
