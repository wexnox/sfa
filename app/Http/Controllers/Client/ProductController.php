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
    public function show($id)
    {

        $product    = Product::findOrFail($id);
        $categories = Category::all();

        return View('products.show')
            ->with('product', $product)
            ->with('categories', $categories);
    }
}
