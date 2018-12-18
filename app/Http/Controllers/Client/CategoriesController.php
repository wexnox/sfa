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
        $categories   = Category::with('product')->where('id', $id)->get();
        $productCount = Product::where('category_id', $id)->count();
        $categoryName = $categories->first();

        return view('categories.index', compact('categories', 'categoryName', 'productCount'));
    }
}
