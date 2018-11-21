<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoriesController extends Controller
{

    public function index($id)
    {

//        $products = Product::all();
        $categories = Category::where('id', $id)->with('product')->get();
//        dd( $categories);
//        $products = Product::all();
//        return view('categories.index', compact('items', 'values', ['products' => $products]));
        return view('categories.index', compact('categories', 'values'));

    }

}
