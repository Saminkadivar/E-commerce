@extends('user.layouts.structure')

@section('content')
<div class="container my-5">
    <h2>Checkout</h2>

    <form action="{{ route('user.checkout.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <textarea name="shipping_address" id="shipping_address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment_ref" class="form-control" required>
                <option value="cod">Cash on Delivery</option>
                <option value="stripe">Stripe</option>
                <option value="razorpay">Razorpay</option>
            </select>
        </div>

        <h4>Your Order</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th width="120">Quantity</th>
                    <th width="120">Price</th>
                    <th width="120">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>₹{{ number_format($item['price'], 2) }}</td>
                        <td>₹{{ number_format($total, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                    <td><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
