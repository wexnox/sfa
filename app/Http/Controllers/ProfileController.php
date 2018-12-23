<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
//        TODO: Note this next line breaks it,
//        $orders = Order::where('user_id', $id)->get();

        return view('user.profile', compact('orders'));
    }
}
