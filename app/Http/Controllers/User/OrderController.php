<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('user.products.index')->with('error', 'Your cart is empty!');
        }
        return view('user.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'status' => 'pending',
        ]);

        // Save order items
        foreach ($cart as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
  
    
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('user.orders', compact('orders'));
    }

    public function invoice(Order $order)
    {
        return view('user.invoice', compact('order'));
    }
    
}
