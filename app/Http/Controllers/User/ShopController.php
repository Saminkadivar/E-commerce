<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
   public function index(Request $request)
{
       $query = Product::query();


    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }


    $products = $query->paginate(12);

    return view('user.products.index', compact('products'));
}


    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        return view('user.products.show', compact('product'));
    }
}
