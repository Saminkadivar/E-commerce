<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $vendorId = Auth::id();

        $orderItems = OrderItem::with(['order.user', 'product'])
            ->where('vendor_id', $vendorId)
            ->latest()
            ->get();
      
        $orders = $orderItems->groupBy('id');

        return view('vendor.orders.index', compact('orders'));
    }


   public function updateStatus(Request $request, $id)
    {
    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
    ]);

    $vendorId = Auth::id();

    $orderItem = OrderItem::where('vendor_id', $vendorId)->findOrFail($id);

    $orderItem->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Order item status updated successfully.');
}

}
