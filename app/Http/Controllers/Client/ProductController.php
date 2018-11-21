<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use View;

class ProductController extends Controller
{

    public function getIndex()
    {
        $products = Product::with(['category'])->paginate(6);
        $categories = Category::get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function index($id)
    {
        $categories = Category::where('id', $id)->with('product')->get();
//        $products = Product::paginate(2);
        return view('products.index', compact('categories', 'product'));
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

}
