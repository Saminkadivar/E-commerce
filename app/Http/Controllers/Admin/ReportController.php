<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $period = $request->get('period', 'daily'); 

        $query = OrderItem::with('vendor')
            ->selectRaw('vendor_id, DATE(created_at) as date, SUM(subtotal) as total_sales, SUM(quantity) as total_products')
            ->groupBy('vendor_id', 'date');

        if ($period == 'monthly') {
            $query = OrderItem::with('vendor')
                ->selectRaw('vendor_id, DATE_FORMAT(created_at, "%Y-%m") as date, SUM(subtotal) as total_sales, SUM(quantity) as total_products')
                ->groupBy('vendor_id', 'date');
        }

        $reports = $query->get();

        // Example: Deduct platform charges = 10%
        $platformChargePercent = 10;

        $reports->transform(function ($item) use ($platformChargePercent) {
            $item->charges = ($item->total_sales * $platformChargePercent) / 100;
            $item->net_payout = $item->total_sales - $item->charges;
            return $item;
        });

        return view('admin.reports.sales', compact('reports', 'period'));
    }
}
