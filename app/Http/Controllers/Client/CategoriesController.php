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


        $items = Category::where('id', $id)->with('product')->get();
//        dd( $categories);
//        $products = Product::all();
        return view('categories.index', compact('items', 'value'));
//        return view('categories.index', compact('categories', 'values'));

    }

}
