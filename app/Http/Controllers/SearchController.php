<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
     {
        $q = $request->input('q');
        $products = Product::where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->get();

        if (!is_null($products)) {
            return view ('partials.search', compact('products', 'q'));
        }
            
        return 'Beklager, ' . $q . ' Ga ingen treff. ';
    }
    
}
