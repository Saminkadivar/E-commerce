@extends('user.layouts.structure')

@section('title', 'Welcome to E-commerce')
@section('content')
<div class="container ">
    <div id="heroCarousel" class="carousel slide mb-5 shadow-lg rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/slider/slider2.jpg') }}" class="d-block w-100" alt="Sale Banner">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/slider/slider1.jpg') }}" class="d-block w-100" alt="Electronics">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/slider/slider5.jpg') }}" class="d-block w-100" alt="Fashion">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/slider/slider4.avif') }}" class="d-block w-100" alt="New Collection">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Shop by Category</h3>
        <a href="{{ route('shop.products.index') }}" class="text-decoration-none">View All →</a>
    </div>
    <div class="row g-3 mb-5">
        @foreach($categories as $category)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('shop.products.index', ['name' => $category->id]) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 category-card">
                        <div class="card-body text-center p-2">
                            <p class="fw-bold text-dark mb-0">{{ $category->name }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Products --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Featured Products</h3>
        <a href="{{ route('shop.products.index') }}" class="text-decoration-none">Browse More →</a>
    </div>
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <img src="{{ asset('storage/'.$product->image_path) ?? 'https://via.placeholder.com/300x200' }}" 
                         class="card-img-top rounded-top" 
                         alt="{{ $product->name }}">

                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold">{{ $product->name }}</h6>
                        <p class="small text-muted">{{ Str::limit($product->description, 50) }}</p>
                        <p class="fw-bold text-success mb-2">₹{{ number_format($product->price, 2) }}</p>

                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('shop.products.show', $product->id) }}" 
                               class="btn btn-sm btn-primary">View</a>
                            <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@push('styles')
<style>
    .category-card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }
    .product-card:hover {
        transform: scale(1.02);
        transition: 0.3s;
    }
</style>
@endpush
@endsection
