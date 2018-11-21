<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function Index()
    {
        $products = Product::with(['category'])->paginate(6);
        $categories = Category::get();

        return view('index', compact('products', 'categories'));
    }
}
