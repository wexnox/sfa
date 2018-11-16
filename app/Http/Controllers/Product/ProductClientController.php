<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductClientController extends Controller
{
    public function getIndex (){
        $products = Product::all();

        return view ('shop.index')
            ->with (['products' => $products]);
    }
}
