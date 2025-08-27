@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📊 Admin Dashboard</h2>
        <span class="text-muted">Welcome back, {{ Auth::user()->name ?? 'Admin' }} 👋</span>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-center">
                <h6 class="text-muted">Total Users</h6>
                <h3 class="fw-bold text-primary">{{ \App\Models\User::where('role','user')->count() }}</h3>
                <small><a href="{{ route('admin.users.index') }}" class="text-decoration-none">Manage Users →</a></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-center">
                <h6 class="text-muted">Total Vendors</h6>
                <h3 class="fw-bold text-success">{{ \App\Models\User::where('role','vendor')->count() }}</h3>
                <small><a href="{{ route('admin.vendors.index') }}" class="text-decoration-none">Manage Vendors →</a></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-center">
                <h6 class="text-muted">Total Products</h6>
                <h3 class="fw-bold text-warning">{{ \App\Models\Product::count() }}</h3>
                <small><a href="{{ route('admin.products.index') }}" class="text-decoration-none">Manage Products →</a></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-center">
                <h6 class="text-muted">Total Categories</h6>
                <h3 class="fw-bold text-danger">{{ \App\Models\Category::count() }}</h3>
                <small><a href="{{ route('admin.categories.index') }}" class="text-decoration-none">Manage Categories →</a></small>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="card shadow-sm border-0 rounded-3 mt-5">
        <div class="card-body">
            <h5 class="fw-bold mb-3">⚡ Quick Actions</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary w-100">👤 Manage Users</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-outline-success w-100">🏪 Manage Vendors</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-warning w-100">📂 Manage Categories</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger w-100">📦 Manage Products</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection 