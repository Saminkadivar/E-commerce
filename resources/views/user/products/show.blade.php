@extends('user.layouts.structure')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-3">
            <img src="{{ asset('storage/'.$product->image_path) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $product->name }}">
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <h4 class="text-success">₹{{ number_format($product->price, 2) }}</h4>
            <p class="text-muted">{{ $product->description }}</p>

            @if($product->stock > 0)
                <!-- Add to Cart Form -->
                <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3 d-flex align-items-center">
                        <label for="quantity" class="me-2 fw-bold">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" 
                               min="1" max="{{ $product->stock }}" class="form-control w-25">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @else
                <!-- Out of Stock Message -->
                <div class="alert alert-danger mt-3 fw-bold">
                    ❌ This product is currently not available.
                </div>
            @endif

            <!-- Show Cart Count -->
            <div class="mt-3">
                <a href="{{ route('user.cart.index') }}" class="btn btn-outline-primary">
                    🛒 View Cart 
                    <span class="badge bg-danger ms-1">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
