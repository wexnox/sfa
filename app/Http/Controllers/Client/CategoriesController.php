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

//        $items = Category::where('id', $id)->with('product')->get();
        $items = Category::where('id', $id)->with('product')->paginate(2);

        return view('categories.index', compact('items', 'value'));
    }

}
