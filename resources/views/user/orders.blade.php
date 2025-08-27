@extends('user.layouts.structure')

@section('content')
<div class="container">
    <h2>My Orders</h2>
    @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Order #{{ $order->id }}</h5>
                <p>Total: ₹{{ $order->total_amount }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <a href="{{ route('user.orders.invoice', $order->id) }}" class="btn btn-info">View Invoice</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
