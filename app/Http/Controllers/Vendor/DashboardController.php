<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendorId = Auth::id();

        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        $totalOrders   = OrderItem::where('vendor_id', $vendorId)->count();
        $totalSales    = OrderItem::where('vendor_id', $vendorId)->sum('subtotal');
        
        $platformChargePercent = 10; 
        $platformCharges = ($totalSales * $platformChargePercent) / 100;
        $netPayout = $totalSales - $platformCharges;

        $recentOrders = OrderItem::with('product', 'order.user')
            ->where('vendor_id', $vendorId)
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalSales',
            'platformCharges',
            'netPayout',
            'recentOrders'
        ));
    }
}
