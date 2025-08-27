@extends('vendor.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Sales Report ({{ ucfirst($filter) }})</h2>

    <div class="mb-3">
        <form method="GET" action="">
            <select name="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                <option value="daily" {{ $filter=='daily' ? 'selected' : '' }}>Daily</option>
                <option value="monthly" {{ $filter=='monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </form>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Sale Price</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->unit_price, 2) }}</td>
                    <td>₹{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="card p-3 mt-3">
        <p><strong>Total Products Sold:</strong> {{ $totalProductsSold }}</p>
        <p><strong>Total Sales:</strong> ₹{{ number_format($totalSales, 2) }}</p>
        <p><strong>Platform Charges (10%):</strong> ₹{{ number_format($charges, 2) }}</p>
        <p><strong>Net Payout:</strong> ₹{{ number_format($netPayout, 2) }}</p>
    </div>
</div>
@endsection

