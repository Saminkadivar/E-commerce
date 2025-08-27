@extends('user.layouts.structure')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Products</h2>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0 hover-shadow transition product-card">
                <!-- Product Image -->
                <a href="{{ route('shop.products.show', $product->id) }}">
                    <img src="{{ asset('storage/'.$product->image_path) }}" 
                         class="card-img-top rounded-top" 
                         alt="{{ $product->name }}" 
                         style="height:220px; object-fit:cover;">
                </a>

                <!-- Product Details -->
                <div class="card-body">
                    <h6 class="card-title text-truncate">{{ $product->name }}</h6>
                    <p class="text-muted small mb-1">₹{{ number_format($product->price, 2) }}</p>
                    <p class="text-truncate small">{{ Str::limit($product->description, 50) }}</p>
                </div>

                <!-- Buttons -->
                <div class="card-footer bg-white dark-bg border-0 d-flex justify-content-between">
                    <a href="{{ route('shop.products.show', $product->id) }}" 
                       class="btn btn-sm btn-outline-primary dark-outline">
                        View
                    </a>
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary dark-btn">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No products found.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
        transform: translateY(-3px);
        transition: all 0.3s ease-in-out;
    }

    .transition {
        transition: all 0.3s ease-in-out;
    }

    body.dark-mode .product-card {
        background-color: #1b1b1b;
        color: #fff;
    }

    body.dark-mode .product-card .card-body .text-muted {
        color: #ccc !important;
    }

    body.dark-mode .product-card .card-footer {
        background-color: #222 !important;
    }

    /* Buttons */
    body.dark-mode .product-card .btn-primary.dark-btn {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
    body.dark-mode .product-card .btn-outline-primary.dark-outline {
        border-color: #0d6efd;
        color: #0d6efd;
    }
    body.dark-mode .product-card .btn-outline-primary.dark-outline:hover {
        background-color: #0d6efd;
        color: #fff;
    }
</style>
@endsection
