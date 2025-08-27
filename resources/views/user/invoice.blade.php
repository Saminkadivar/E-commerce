@extends('user.layouts.structure')

@section('content')
<div class="container">
    <h2>Invoice #{{ $order->id }}</h2>
    <p>User: {{ $order->user->name }}</p>
    <p>Total: ₹{{ $order->total_amount }}</p>
    <p>Status: {{ ucfirst($order->status) }}</p>

    <h4>Items</h4>
    <ul>
        @foreach($order->items as $item)
        <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ₹{{ $item->unit_price * $item->quantity }}</li>
        @endforeach
    </ul>
</div>
@endsection
