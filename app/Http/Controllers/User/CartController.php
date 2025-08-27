<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function index()
{
    $cart = session()->get('cart', []);

    foreach ($cart as $id => &$item) {
        $product = Product::find($id);

        if ($product) {
            $item['available_stock'] = $product->stock;

            if ($item['quantity'] > $product->stock) {
                $item['error'] = "Only {$product->stock} units available in stock.";
            }
        } else {
            $item['available_stock'] = 0;
            $item['error'] = "This product is no longer available.";
        }
    }

    return view('user.cart', compact('cart'));
}


// public function add(Request $request, $id)
//     {
//         // $cart = session()->get('cart', []);

//         // $cart[$product->id] = [
//         //     'name' => $product->name,
//         //     'price' => $product->price,
//         //     'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
//         //     'image' => $product->image_path,
//         // ];

//         // session()->put('cart', $cart);
//         $product = Product::findOrFail($id);
//     $quantity = $request->input('quantity', 1);

//     $cart = session()->get('cart', []);

//     if (isset($cart[$id])) {
//         // If already in cart → increase quantity
//         $cart[$id]['quantity'] += $quantity;
//     } else {
//         // Add new product to cart
//         $cart[$id] = [
//             'product_id' => $product->id,
//             'name' => $product->name,
//             'price' => $product->price,
//             'image' => $product->image_path,
            
//             'quantity' => $quantity,
//         ];
//     }


    // session()->put('cart', $cart);


    //     return redirect()->route('user.cart.index')->with('success', 'Product added to cart!');
    // }
public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $quantity = (int) $request->input('quantity', 1);

    if ($product->stock < $quantity) {
        return redirect()->back()->with('error', "Only {$product->stock} units available in stock.");
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $newQty = $cart[$id]['quantity'] + $quantity;

        if ($newQty > $product->stock) {
            return redirect()->back()->with('error', "You cannot add more than {$product->stock} units.");
        }

        $cart[$id]['quantity'] = $newQty;
    } else {
        $cart[$id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image_path,
            'quantity' => $quantity,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('user.cart.index')->with('success', 'Product added to cart!');
}

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->route('user.cart.index')->with('success', 'Product removed from cart!');
    }

 
    public function update(Product $product)
    {
    $cart = session()->get('cart', []);
    $quantity = (int) request()->quantity;

    if ($quantity < 1) {
        return redirect()->back()->with('error', 'Quantity must be at least 1.');
    }

    if ($quantity > $product->stock) {
        
        return redirect()->back()->with('error', "Only {$product->stock} units available.");
    }

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] = $quantity;
        session()->put('cart', $cart);
        return redirect()->route('user.cart.index')->with('success', 'Cart updated successfully!');
    }

    return redirect()->back()->with('error', 'Product not found in cart.');
}

}