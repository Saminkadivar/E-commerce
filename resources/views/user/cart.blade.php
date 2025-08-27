@extends('user.layouts.structure')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">🛒 Your Shopping Cart</h2>

    @if(empty($cart))
        <div class="alert alert-info p-4 rounded shadow-sm">
            <h5 class="mb-2">Your cart is empty!</h5>
            <p class="mb-3">Looks like you haven’t added anything yet.</p>
            <a href="{{ route('shop.products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach($cart as $id => $item)
                                    @php $lineTotal = $item['price'] * $item['quantity']; @endphp
                                    @php $grandTotal += $lineTotal; @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                             
                                                <img src="{{ asset('storage/' . $item['image'] ?? 'https://via.placeholder.com/80' )}}" 
                                                     alt="{{ $item['name'] }}" class="rounded me-3" width="70">
                                                <div>
                                                    <h6 class="mb-1">{{ $item['name'] }}</h6>
                                                    <p class="small text-muted mb-0">Product ID: {{ $id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('user.cart.update', $id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" class="form-control form-control-sm text-center" style="width: 60px;">
                                                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                            </form>
                                        </td>
                                        <td class="text-center">₹{{ number_format($item['price'], 2) }}</td>
                                        <td class="text-center fw-bold">₹{{ number_format($lineTotal, 2) }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('user.cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger">Remove</button>
                                            </form>
                                        </td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Cart Summary --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3 fw-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <a href="{{ route('user.checkout.index') }}" class="btn btn-primary w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
