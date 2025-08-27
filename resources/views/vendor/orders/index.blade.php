@extends('vendor.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📦 My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            No orders found for your products.
        </div>
    @else
        @foreach($orders as $orderId => $items)
            @php 
                $order = $items->first()->order; 
            @endphp

  
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between">
                   Order #{{ $orderId }} by {{ $items->first()->order->user->name }}
                   <span>Status: <strong>{{ ucfirst($items->first()->status) }}</strong></span>
                </div>
                <div class="card-body">
                    <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ ucfirst($item->status) }}</td>
                        <td>
                           


                            <form action="{{ route('vendor.orders.updateStatus', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')   {{-- <-- This is the key fix --}}
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                                        <option value="{{ $status }}" {{ $item->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach

    @endif
</div>
@endsection
