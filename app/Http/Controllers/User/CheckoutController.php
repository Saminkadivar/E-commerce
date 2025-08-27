<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.products.index')->with('error', 'Your cart is empty.');
        }

        return view('user.checkout', compact('cart'));
    }

 
public function store(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Cart is empty!');
    }

    DB::beginTransaction();
    try {
        // Create Order
        $order = Order::create([
            'user_id'          => auth()->id(),
            'shipping_address' => $request->shipping_address,
            'status'           => 'pending',
            'payment_ref'      => $request->payment_ref,
            'total_amount'     => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        ]);

        foreach ($cart as $id => $item) {
            $product = Product::findOrFail($id);

            // Reduce stock
            if ($product->stock < $item['quantity']) {
                DB::rollBack();
                return redirect()->back()->with('error', "Not enough stock for {$product->name}");
            }
            $product->decrement('stock', $item['quantity']);

            // Save Order Items
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'vendor_id'  => $product->vendor_id,
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal'   => $item['price'] * $item['quantity'],
            ]);
        }

        DB::commit();

        // Clear cart after order
        session()->forget('cart');

        return redirect()->route('user.orders.index')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: '.$e->getMessage());
    }
}


    public function success(Order $order)
    {
        return view('user.checkout-success', compact('order'));
    }


    public function placeOrder(Request $request)
{
    $cart = session()->get('cart', []);

    if (!$cart || empty($cart)) {
        return redirect()->route('user.cart.index')->with('error', 'Your cart is empty.');
    }

    foreach ($cart as $item) {
        $product = Product::find($item['product_id']);

        if (!$product || $product->stock < $item['quantity']) {
            return redirect()->back()->with('error', "Stock not available for {$item['name']}.");
        }

        // Reduce stock
        $product->stock -= $item['quantity'];
        $product->save();
    }

    // Clear cart after order
    session()->forget('cart');

    return redirect()->route('user.orders.index')->with('success', 'Order placed successfully!');
}

}
