<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ReportController extends Controller
{
    
    public function index(Request $request)
    {
        $vendorId = Auth::id();

        // Filters: daily / monthly
        $filter = $request->get('filter', 'daily'); 

        if ($filter === 'daily') {
            $date = Carbon::today();
            $orderItems = OrderItem::with('product')
                ->where('vendor_id', $vendorId)
                ->whereDate('created_at', $date)
                ->get();
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            $orderItems = OrderItem::with('product')
                ->where('vendor_id', $vendorId)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->get();
        }

        $totalSales = $orderItems->sum(fn($item) => $item->unit_price * $item->quantity);
        $totalProductsSold = $orderItems->sum('quantity');

        $platformChargeRate = 0.10; 
        $charges = $totalSales * $platformChargeRate;

        $netPayout = $totalSales - $charges;

        return view('vendor.reports', compact(
            'orderItems',
            'totalSales',
            'totalProductsSold',
            'charges',
            'netPayout',
            'filter'
        ));
    }
}
