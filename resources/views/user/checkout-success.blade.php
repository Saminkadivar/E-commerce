@extends('user.layouts.structure')

@section('content')
<div class="container my-5 text-center">
    <h2>🎉 Thank You!</h2>
    <p>Your order <strong>#{{ $order->id }}</strong> has been placed successfully.</p>
    <p>Status: <span class="badge bg-info">{{ ucfirst($order->status) }}</span></p>
    <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection
