@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Vendor Sales Report ({{ ucfirst($period) }})</h2>

    <form method="GET" action="{{ route('admin.reports.sales') }}" class="mb-3">
        <select name="period" class="form-select w-auto d-inline" onchange="this.form.submit()">
            <option value="daily" {{ $period=='daily'?'selected':'' }}>Daily</option>
            <option value="monthly" {{ $period=='monthly'?'selected':'' }}>Monthly</option>
        </select>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Vendor</th>
                <th>Date</th>
                <th>Total Products Sold</th>
                <th>Total Sales</th>
                <th>Charges (10%)</th>
                <th>Net Payout</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->vendor?->name ?? 'Unknown Vendor' }}</td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->total_products }}</td>
                    <td>₹{{ number_format($report->total_sales, 2) }}</td>
                    <td>₹{{ number_format($report->charges, 2) }}</td>
                    <td class="fw-bold text-success">₹{{ number_format($report->net_payout, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No sales data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
